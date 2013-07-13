#!bin/bash
#$bc 7 + 5
#date_formatted=$(date +%m_%d_%y-%H.%M.%S)
#cp -iv $1 $2.$date_formatted
env #enviornment
echo $PATH #executable paths
echo $PWD #current working directory
echo "Simple Script"
ls > myfiles
echo $date 
$date >> myfiles
echo $LOGNAME

no=10;
echo $no;

if [ "foo" == "foo" ]; then
	echo "Expressions are same"
else 
	echo "Expressions are not same"
fi


for i in $(ls); do
	echo item: $i
done

COUNTER=0
while [ $COUNTER -lt 10 ]; do
	echo "Counter is" $COUNTER
	let COUNTER=COUNTER+1;
done


COUNTER=20
until [ $COUNTER -lt 10 ]; do
	echo "COUNTER" $COUNTER
	let COUNTER-=1
done
