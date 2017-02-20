#!/usr/bin/env ruby

# Script to import old jewmich.com pages

require 'open3'
require 'pathname'
#require 'pry'

def run_wpcli(*args)
	stdin, stdout, stderr = Open3.open3("./wp-cli.phar", "--path=html", *args)
	stdin.close
	abort "failed to run #{args}.\nErr = #{stderr.read}\nOut = #{stdout.read}" unless $?.success?
	stdout.read.strip
end

def upload_media_if_not_exists(file_path)
	post_name = File.basename(file_path).sub(/\..*$/, '')

	# check if already uploaded
	media_id = run_wpcli("eval", 'echo $GLOBALS["wpdb"]->get_col("
		SELECT id
		FROM {$GLOBALS["wpdb"]->posts}
		WHERE post_type = \"attachment\"
		AND post_name IN (\"' + post_name + '\", \"media-' + post_name + '\")
	")[0];')
	if media_id.empty?
		# nope, need to upload it
		puts "\tUploading media #{file_path}"
		media_id = run_wpcli("media", "import", "--porcelain", file_path)
		# prepend "media-" to prevent slug collisions
		run_wpcli("post", "update", media_id, "--post_name=media-#{post_name}")
	end
	full_url = run_wpcli("eval", "echo wp_get_attachment_url(#{media_id});")
	site_url = run_wpcli("eval", "echo get_site_url();")
	full_url.sub(site_url, '')
end

def insert_page(file_path)
	page_name = File.basename(file_path).sub(/.php/, '')
	if File.basename(File.dirname(file_path)) == "files"
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
			puts "\tIrregular file (#{lines.length} header lines)"
		end

		lines[1..-2].each do |line|
			if line =~ /^require/
				next
			elsif !line.match(/^define\('(TITLE|BANNER|NO_SIDEBAR)', (?:true|'(.*)')\);$/)
				puts "\tFailed to match header line against define: #{line}"
				is_regular = false
				next
			end
			fields[$1] = ($1 == 'NO_SIDEBAR') ? true : $2
		end
		""
	end

	# remove footer
	if is_regular && !source.sub!(/^<\?\nrequire(_once)?\(['"]files\/footer\.php['"]\);\n\?>$/m, '')
		puts "\tIrregular file (failed to find footer)"
		is_regular = false
	end

	if is_regular
		# replace image references
		source.gsub!(/(?:pic|holpic|eventpic|links)\/[^\.\/]*\.(gif|jpg|png)/) do |match|
			image_file_path = File.dirname(file_path) + "/" + match
			if File.exists?(image_file_path) # need to check this as some files reference non-existent images
				upload_media_if_not_exists(image_file_path)
			else
				puts "\tWarning: image file does not exist: #{image_file_path}"
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
		source = "This page cannot be edited in Wordpress due to embedded PHP. To update it, you will need to manually edit the page template, which is located at #{Dir.pwd}/html/wp-content/themes/jewmich/page-#{page_name}.php on the server"
	end

	title = fields['TITLE'] ? fields['TITLE'].sub(/(\s*-\s*)?Chabad House.*/, '') : ''

	post_args = [
		"--porcelain",
		"--post_type=page",
		"--post_title=" + (title.empty? ? page_name : title),
		"--post_status=publish",
		"--post_content=#{source}",
		"--post_name=#{page_name}",
	]
	if !is_regular
		post_args.push("--page_template=page-templates/page-#{page_name}.php")
	end
	post_id = run_wpcli("post", "create", *post_args)

	return post_id, fields
end

files = [
	'aboutus.php',
	'ask.php',
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
	file_path = Pathname.new("../jewmich.com/#{file}").realpath
	puts "Importing #{file_path}"
	post_id, fields = insert_page(file_path)

	if fields['BANNER']
		url = upload_media_if_not_exists(File.dirname(file_path) + "/" + fields['BANNER'])
		run_wpcli("post", "meta", "set", post_id, 'banner', url)
	end

	if fields['NO_SIDEBAR']
		run_wpcli("post", "meta", "set", post_id, 'no_sidebar', 'true')
	end
end
