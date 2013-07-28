<?php

class Myclass{
	function __construct(){
	print "Inside Myclass Construct \n";
	$this->name="Myclass";
	}
	function __destruct(){
	print "Inside Destructor \n";
	print "Destroying " . $this->name . "\n";
	}
}

$obj= new Myclass();
?>
