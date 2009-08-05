#!/bin/bash
echo "First argument should be the amount of iterations.\n";
echo "A reasonable value is for example 1000: ~42 seconds -> lousy Lenovo laptop\n";
if [ -n "$1" ]
then LOOPS=$1
else exit
fi

START=`date +"%s"`

for n in $(seq 1 "${LOOPS}") ; do
php ./load_file.php
done
let TOTAL=`date +"%s"`-${START}

echo ${TOTAL}
