<?php

class One{
	public function printclass($string){
		echo "One::" . $string . PHP_EOL;
	}
	public function printphp()
	{
		echo "One:printphp()" .  PHP_EOL;	
	}
}

class Two extends One{
	public function printclass($string){
		echo "Two::" . $string . PHP_EOL;
	}
}

$one= new One();
$two= new Two();
$one->printclass("check1");
$one->printphp();
$two->printclass("check2");
$two->printphp();
?>
