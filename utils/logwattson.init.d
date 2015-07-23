#!/bin/sh
# chkconfig: 235 99 10
# description: Start or stop the Webmin server
#
### BEGIN INIT INFO
# Provides: Wattsonlogger
# Required-Start: 
# Required-Stop: 
# Default-Start: 2 3 5
# Default-Stop: 0 1 6
# Description: Start or stop the Wattson solar monitor logger
### END INIT INFO

maindir=/home/pi/openwattson-master/utils

start=./runlogwattson.sh
pidFile=$maindir/pidfile
oldpid=`cat $pidFile`
stop="kill $oldpid"
#stop="/usr/bin/pkill runlogwattson.sh"
lockfile=/var/lock/subsys/openwattson
name='OpenWattson'

cd $maindir
#ls

case "$1" in
'start')
	$start >/dev/null 2>&1 </dev/null & pid=$!
	RETVAL=$?
	if [ "$RETVAL" = "0" ]; then
		touch $lockfile >/dev/null 2>&1
	fi
	echo $pid > $pidFile
	;;
'stop')
	$stop
	RETVAL=$?
	if [ "$RETVAL" = "0" ]; then
		rm -f $lockfile
	fi
	;;
'restart')
	$stop ; $start
	RETVAL=$?
	;;
*)
	echo "Usage: $0 { start | stop | restart }"
	RETVAL=1
	;;
esac
exit $RETVAL

