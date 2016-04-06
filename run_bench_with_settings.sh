#!/bin/bash

runs=100
runs_max=1000000
ds=2

while [ $runs -lt $runs_max ]
do
	eval "php runner.php -m $1 -r $2 -n $runs >> $3"
	runs=`expr $runs \* $ds`
done

exit 0