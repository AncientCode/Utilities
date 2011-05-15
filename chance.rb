#!/usr/bin/env ruby

argc = ARGV.length
debug = false
if argc != 2
	if argc == 3 and ARGV[2] == 'debug'
		debug = true
	else
		puts "
Dice Testing

#{$0} times dice
    times    Number of time to roll the dice
    dice     How many dice to roll

"
		exit(2)
	end
end

times = ARGV[0].to_i
num   = ARGV[1].to_i
chance = []
rnd = Random.new Time.now.to_i

if times == 0 or num == 0
	puts '"times" and "dice" mush be a integer!!!'
end

puts "Rolling Dice..."
for i in 1..(num*6)
	chance[i] = 0
end

for i in 1..times
	a = 0
	for i in 1..num
		a += rnd.rand(6) + 1
	end
	chance[a] += 1
end

for i in 1..(num*6)
	puts 'The number ' + i.to_s + ' was rolled ' + chance[i].to_s + ' times'
end

if debug
	sleep 80
end