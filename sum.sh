sum=0; while read num ; do sum=$(($sum + $num)); done < ~/sum.txt ; echo $sum
