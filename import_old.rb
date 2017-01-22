#!/usr/bin/env ruby

require 'open3'
require 'pry'

custom_fields = {}

source = ARGF.read
source.sub!(/^<\?\n.*?\?>/m) do |match|
	lines = match.split("\n")
	if lines.length != 5 && lines.length != 6
		puts "Irregular file (#{lines.length} header lines)"
		exit
	end

	#binding.pry
	lines[1..-2].each do |line|
		if line =~ /^require_once/
			next
		elsif !line.match(/^define\('(TITLE|BANNER|NO_SIDEBAR)', (?:true|'([^']*)')\);$/)
			puts "Irregular file (failed to find defines)"
			exit
		end
		custom_fields[$1.downcase] = ($1 == 'NO_SIDEBAR' ? true : $2)
	end
	""
end

if !source.sub!(/^<\?\nrequire_once\(['"]files\/footer\.php['"]\);\n\?>$/m, '')
	puts "Irregular file (failed to find footer)"
	exit
end

#puts source, custom_fields

post_id, status = Open3.capture2e(
	"./wp-cli.phar",
	"--path=html",
 "post", "create",
	"--porcelain",
	"--post_type=page",
	"--post_title=#{custom_fields['title']}",
	"--post_status=publish",
	"--post_content=#{source}",
)

abort "failed to create post. Out = #{post_id}" unless status.success?

custom_fields.each do |field, value|
	next if field == 'title'
	system("./wp-cli.phar", "--path=html", "post", "meta", "set", post_id, field, value)
	abort "failed to set meta for post #{post_id}" unless $?.success?
end
