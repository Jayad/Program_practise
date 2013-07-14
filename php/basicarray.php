<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<script type="text/javascript">
function display(){
var selectoption = document.getElementById("opts").value;
console.log(selectoption);
if(selectoption =='Summer')
{
document.getElementById("opts").style.display="block";
document.getElementById("opt2").style.display="block";
}
else if (selectoption == 'winter') {
document.getElementById("opts").style.display="block";
document.getElementById("opt2").style.display="none";
document.getElementById("opt3").style.display="block";
}
else if (selectoption == 'monsoon'){
document.getElementById("opts").style.display="block";
document.getElementById("opt2").style.display="none";
document.getElementById("opt3").style.display="none";
document.getElementById("opt4").style.display="block";
}
}
</script>
<title>BasicArrayPhp</title>
</head>
<body>
<h2>Wheather Report</h2>
<?php 
$seasons=array('Summer','winter','monsoon');
$Summereffects=array('Hot','Mild Hot','very Hot');
$Wintereffects=array('cold','Mild Cold','very Cold');
$Monsooneffects=array('rain','Mild Rain', 'heavy Rain');
?>
<form action="test.php" method="post">
<h4>Your Selection</h4> 
<input type="text" name='detail' value="detail"> : Provide Input </>
<input type="submit" value="Submit"> </input>
<h4>Whether Menu</h4> 
<?php 
echo "<select id=\"opts\" onchange=\"display()\">";
foreach ($seasons as $s) echo "<option value=\"$s\">" .strtoupper($s). "</option>"; 
echo "</select>";
?>
<?php
echo "<div id=\"opt2\" style=\"display:none\" value=\"Effects\"><select id=\"opts\"  onchange=\"display()\">";
foreach ($Summereffects as $s) echo "<option value=\"$s\">" .strtoupper($s). "</option>"; 
echo "</select></div>";

echo "<div id=\"opt3\" style=\"display:none\"> <select id=\"opts\" onchange=\"display()\">";
foreach ($Wintereffects as $s) echo "<option value=\"$s\">" .strtoupper($s). "</option>"; 
echo "</select></div>";

echo "<div id=\"opt4\" style=\"display:none\"> <select id=\"opts\" onchange=\"display()\">";
foreach ($Monsooneffects as $s) echo "<option value=\"$s\">" .strtoupper($s). "</option>"; 
echo "</select></div>";
?>
</form>
</body>
</html>
