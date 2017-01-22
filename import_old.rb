#!/usr/bin/env ruby

# Script to import old jewmich.com pages

require 'open3'
require 'pry'

fields = {}

source = IO.read(ARGV[0])
source.sub!(/^<\?\n.*?\?>/m) do |match|
	lines = match.split("\n")
	if lines.length != 5 && lines.length != 6
		abort "Irregular file (#{lines.length} header lines)"
	end

	#binding.pry
	lines[1..-2].each do |line|
		if line =~ /^require_once/
			next
		elsif !line.match(/^define\('(TITLE|BANNER|NO_SIDEBAR)', (?:true|'([^']*)')\);$/)
			abort "Irregular file (failed to find defines)"
		end
		fields[$1.downcase] = ($1 == 'NO_SIDEBAR' ? true : $2)
	end
	""
end

if !source.sub!(/^<\?\nrequire_once\(['"]files\/footer\.php['"]\);\n\?>$/m, '')
	abort "Irregular file (failed to find footer)"
end


title = fields['title'].sub(/( - )?Chabad House.*/, '')
title = File.basename(ARGV[0]).sub(/.php/, '') if title.empty?

post_id, status = Open3.capture2e(
	"./wp-cli.phar",
	"--path=html",
	"post", "create",
	"--porcelain",
	"--post_type=page",
	"--post_title=#{title}",
	"--post_status=publish",
	"--post_content=#{source}",
)

abort "failed to create post. Out = #{post_id}" unless status.success?

fields.each do |field, value|
	next if field == 'title'
	system("./wp-cli.phar", "--path=html", "post", "meta", "set", post_id, field, value)
	abort "failed to set meta for post #{post_id}" unless $?.success?
end
