#!/usr/bin/env ruby

# Script to import old jewmich.com pages

require 'open3'
require 'pry'

def run_wpcli(*args)
	out, status = Open3.capture2e("./wp-cli.phar", "--path=html", *args)
	abort "failed to run #{args}.\nOut = #{out}" unless status.success?
	out.strip
end

def upload_media_if_not_exists(file_path)
	file_name = File.basename(file_path)
	# check if already uploaded
	media_id = run_wpcli("eval", 'global $wpdb; echo $wpdb->get_col("SELECT id FROM {$wpdb->posts} WHERE guid LIKE \"%' + file_name + '\"")[0];')
	if media_id.empty?
		# nope, need to upload it
		media_id = run_wpcli("media", "import", "--porcelain", file_path)
	end
	full_url = run_wpcli("eval", "echo wp_get_attachment_url(#{media_id});")
	site_url = run_wpcli("eval", "echo get_site_url();")
	full_url.sub(site_url, '')
end

def insert_page(file_path)
	page_name = File.basename(file_path).sub(/.php/, '')
	if File.dirname(file_path) == "files"
		page_name = "form-process-#{page_name}"
	end

	is_regular = true
	fields = {}
	source = IO.read(file_path)

	# remove header and record config params (TITLE, BANNER, NO_SIDEBAR)
	source.sub!(/^<\?\n.*?\?>/m) do |match|
		lines = match.split("\n")
		if lines.length != 5 && lines.length != 6
			is_regular = false
			puts "Irregular file (#{lines.length} header lines)"
		end

		lines[1..-2].each do |line|
			if line =~ /^require/
				next
			elsif !line.match(/^define\('(TITLE|BANNER|NO_SIDEBAR)', (?:true|'([^']*)')\);$/)
				is_regular = false
				next
			end
			fields[$1] = ($1 == 'NO_SIDEBAR') ? true : $2
		end
		""
	end

	if is_regular
		# remove footer
		if !source.sub!(/^<\?\nrequire(_once)?\(['"]files\/footer\.php['"]\);\n\?>$/m, '')
			abort "Irregular file (failed to find footer)"
		end

		# replace image references
		source.gsub!(/(?:pic|holpic|eventpic|links)\/[^\.\/]*\.(gif|jpg|png)/) do |match|
			image_file_path = File.dirname(file_path) + "/" + match
			if File.exists?(image_file_path) # need to check this as some files reference non-existent images
				upload_media_if_not_exists(image_file_path)
			else
				puts "Warning: image file does not exist: #{image_file_path}"
				match
			end
		end

		# replace generateUmSchoolYearDropDown() calls with shortcode
		source.gsub!(/<\?=\s*generateUmSchoolYearDropDown\(([^,]*)?,?(?:\s*'([^'\)]*)')?\)\s*\?>/) do
			string = "[um_school_year_dropdown"
			if $1 && $1 != "null"
				string += " value=#{$1}"
			end
			if $2 && $2 != 'null'
				string += " name=#{$2}"
			end
			string + "]"
		end

		# replace pluginpay success links with shortcode
		source.gsub!(/<input name="success-link" type="hidden" value="[^"]*successredirect\?type=([^\"]*)"\/>/, '[plugnpay_success_link type=\1]')

		# replace form post actions with proper page
		source.gsub!(/files\/(birthright|brazil|culinary|forms|forms_alt_email|highholiday|shabbat|trip)(?:.php)?/, 'form-process-\1')
	else
		source = "This page cannot be edited in Wordpress due to embedded PHP. To update it, edit the file #{Dir.pwd}/html/wp-content/themes/jewmich/page-#{page_name}.php"
	end

	title = fields['TITLE'] ? fields['TITLE'].sub(/( - )?Chabad House.*/, '') : ''

	post_args = [
		"--porcelain",
		"--post_type=page",
		"--post_title=" + title.empty? ? page_name : title,
		"--post_status=publish",
		"--post_content=#{source}",
	]
	if !is_regular
		post_args.push("--page_template=page-templates/page-#{page_name}.php")
	end
	post_id = run_wpcli("post", "create", *post_args)

	slug = run_wpcli('post', 'get', post_id, '--field=name')
	if slug != page_name
		run_wpcli("post", "meta", "set", post_id, "custom_permalink", page_name)
	end

	return post_id, fields
end

files = [
	'aboutus.php',
	'ask.php',
	'badpage.php',
	'birthright.php',
	'brazildep.php',
	'brazilfaq.php',
	'brazilinfo.php',
	'brazil.php',
	'camp.php',
	'candlelighting.php',
	'chaiclub.php',
	'charitybox.php',
	'chometz.php',
	'cong.php',
	'contact.php',
	'culinary.php',
	'donatemiles.php',
	'donate.php',
	'donateyourcar.php',
	'donation.php',
	'events.php',
	'forgotpassword.php',
	'graduation.php',
	'highholiday.php',
	'highholidayregister.php',
	'jli.php',
	'judiacstore.php',
	'jwc.php',
	'kiddushmain.php',
	'kiddush.php',
	'kiddushreserve.php',
	'kosher.php',
	'login.php',
	'logout.php',
	'map.php',
	'mezuzah.php',
	'mikvah.php',
	'myaccount.php',
	'mythandfact.php',
	'passovercom.php',
	'passover.php',
	'passoverum.php',
	'payment.php',
	'purimgift.php',
	'remove.php',
	'resetpassword.php',
	'shabbat.php',
	'shirt.php',
	'signup.php',
	'soup.php',
	'sponsorshabbat.php',
	'studentcenter.php',
	'studycenter.php',
	'success_birthright.php',
	'success.php',
	'successredirect.php',
	'success_shabbat.php',
	'tep.php',
	'visiting&living.php',
	'volunteer.php',
	'wishlist.php',
	'files/birthright.php',
	'files/brazil.php',
	'files/culinary.php',
	'files/forms.php',
	'files/forms_alt_email.php',
	'files/highholiday.php',
	'files/shabbat.php',
	'files/trip.php',
]

files.each do |file|
	file_path = "../jewmich.com/#{file}"
	post_id, fields = insert_page(file_path)

	if fields['BANNER']
		url = upload_media_if_not_exists(File.dirname(file_path) + "/" + fields['BANNER'])
		run_wpcli("post", "meta", "set", post_id, 'banner', url)
	end

	if fields['NO_SIDEBAR']
		run_wpcli("post", "meta", "set", post_id, 'no_sidebar', 'true')
	end
end
