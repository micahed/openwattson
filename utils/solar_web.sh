#!/bin/sh

today=`date +%Y_%m_%d_%A --date=yesterday`
scriptDir=`getconf scriptdir`
if [ $# -eq 1 ]; then
	today=$1
fi

basedir=`getconf HTMLdir`
logdir=`getconf logdir`
logfile="${logdir}/wattson_log-${today}.txt"
filename="${basedir}Power_${today}.html"
gen="Generated_${today}.png"
solar="Solar_${today}.png"
diff="Diff_${today}.png"


$scriptDir/wattsonplot.sh $logfile ${basedir}$gen ${basedir}$solar ${basedir}$diff
$scriptDir/currentWattsonAsHTML.sh $filename $gen $solar $diff

