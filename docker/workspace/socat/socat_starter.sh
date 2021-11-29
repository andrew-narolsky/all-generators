#! /bin/sh
# source: daemon.sh
# Copyright Gerhard Rieger 2001
# Published under the GNU General Public License V.2, see file COPYING

# Note: this pid file mechanism is not robust!

# You will adapt these variables
TARGET=/root/socat/socat.sh
INPORT=14777
#
INOPTS="fork"
OUTOPTS=
PIDFILE=/var/run/socat-$INPORT.pid
OPTS="-d -d -lm"    # notice to stderr, then to syslog
SOCAT=/usr/bin/socat

if [ "$1" = "start" -o -z "$1" ]; then
    echo "SOCAT STARTING"
    $SOCAT $OPTS tcp-l:$INPORT,$INOPTS system:$TARGET,$OUTOPTS </dev/null &
    echo $! >$PIDFILE
elif [ "$1" = "stop" ]; then

    /bin/kill $(/bin/cat $PIDFILE)
fi
