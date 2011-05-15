#!/usr/bin/ruby
# This program execute `svn up' in all sub-directory that
# contains .svn, very useful when mass updating all checkout
# repositories
#
# Author::	Xiaomao Chen
# License::	GNU General Public License version 3 and above

# Check if a `file' is in the `path' environmental variable
# Also check `pathext' if no extension was specified on
# Windows.
# 
def path_check(file)
	if RUBY_PLATFORM.downcase.include?("mingw") or RUBY_PLATFORM.downcase.include?("mswin")
		path = ENV['PATH'].split ';'
		ext = ENV['PATHEXT'].split ';'
		ext.push ''
		for i in path
			for j in ext
				if File.executable?"#{i}\\#{file}" + j
					return "#{i}\\#{file}" + j
				end
			end
		end
	else
		path = ENV['PATH'].split ':'
		for i in path
			if File.executable?"#{i}/#{file}"
				return "#{i}/#{file}"
			end
		end
	end
	return false
end

if not path_check('svn')
	puts 'Since this program is for Subversion, svn binary must be in your path!!'
	exit(2)
end

if ARGV.length == 1
	updir = ARGV[0]
else
	updir = '.'
end

for name in Dir.entries updir
	if not File::directory?(name)
	elsif name == '.' or name == '..'
	elsif File::directory?"#{name}/.svn"
		puts "---Directory \"#{name}\"---"
		Dir.chdir(name)
		system 'svn up'
		puts 'SVN returned ' + $?.to_i.to_s
		Dir.chdir('..')
		puts "---End of Directory \"#{name}\"---"
		puts
	else
		puts "Skipped directory \"#{name}\""
		puts
	end
end
