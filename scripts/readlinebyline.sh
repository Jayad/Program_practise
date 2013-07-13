#!bin/bash

echo "Data for 80 IDs"
head -10 ~/wls_key_yids |tail -8 >> templist.txt

for temp in `cat templist.txt`
do
        echo $temp;
        /home/y/bin/udb-test -Rk login,wls,mbr_commchannel,activity $temp
done
