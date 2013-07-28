<?php

class Myclass 
{
	public $public="Public";
	private $private ="Private";
	protected $protected ="Protected";

	function Callall(){
	
	print $this->public . "\n";
	print $this->private . "\n";
	print $this->protected . "\n";
	}
}

$obj= new Myclass();
$obj->Callall();

/**
 * Define MyClass2
 */
class MyClass2 extends MyClass
{
    // We can redeclare the public and protected method, but not private
    protected $protected = 'Protected2';

    function printHello()
    {
        echo $this->public . "\n";
        echo $this->protected . "\n";
        echo $this->private . "\n";
    }
}

$obj2 = new MyClass2();
echo $obj2->public . "\n"; // Works
echo $obj2->private . "\n"; // Undefined
//echo $obj2->protected . "\n"; // Fatal Error
$obj2->printHello(); // Shows Public, Protected2, Undefined
?>
