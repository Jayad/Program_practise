<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<title>Temperature Calculation</title>
</head>
<body>
<?php
$temperature=array(68, 70, 72, 58, 60, 79, 82, 73, 75, 77, 73, 58, 63, 79, 78,
68, 72, 73, 80, 79, 68, 72, 75, 77, 73, 78, 82, 85, 89, 83);
echo "Temperature of your city for last 30 days\n";
foreach($temperature as $temp)
echo $temp ."&deg\n";
echo "You know how much was in last " .count($temperature) ."days? \n";
echo "It was altogether " . array_sum($temperature) . "&deg\n";
echo "And on average=" . array_sum($temperature)/count($temperature) . "&deg\n";
sort($temperature);
$i=0;
echo "Temperatures sorted in Ascending order: lowest 5 temperatures of the month" . "\n";
foreach ($temperature as $value)
{
echo $value . "&deg ";
if($i++==5)break;
}
echo "\n" . "************************" . "\n";
echo "Temperatures sorted in Descending Order: Highest 5 temperatures of the month" . "\n";
rsort($temperature);
$i=0;
foreach ($temperature as $value)
{
echo $value . "&deg " ;
if($i++==5)break;
}
/* Another way to find out */
//Slice array for last 5 temp
// $warmest = array_slice($temp, -5, 5);
//Slice array for first 5 temp
//$coolest = array_slice($temp, 0, 5);
  
?>
</body>
</html>
