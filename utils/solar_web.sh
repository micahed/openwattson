#!/bin/sh

today=`date +%Y_%m_%d_%A --date=yesterday`
scriptDir=`basedir $0`
if [ $# -eq 1 ]; then
	today=$1
fi
basedir="/home/nas/myweb/power/"
logfile="/home/nas/wattson/wattson/wattson_log-${today}.txt"
filename="${basedir}Power_${today}.html"
gen="Generated_${today}.png"
solar="Solar_${today}.png"
diff="Diff_${today}.png"

#echo $filename
#echo $gen
#echo $solar

$scriptDir/wattsonplot.sh $logfile ${basedir}$gen ${basedir}$solar ${basedir}$diff
$scriptDir/currentWattsonAsHTML.sh $filename $gen $solar $diff

#/sbin/reboot
