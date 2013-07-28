<?php
class Foo{
	public static $mystatic="Foo";
	public function mystatic(){
		return self::$mystatic . PHP_EOL;
	}
}

class Bar extends Foo {
	public function barstatic(){
		return parent::$mystatic . PHP_EOL;
	}
}

print Foo::$mystatic . "\n";

$foo = new Foo();
print $foo->mystatic() . "\n";
print $foo->mystatic . "\n";      // Undefined "Property" my_static 

print $foo::$mystatic . "\n";
$classname = 'Foo';
print $classname::$mystatic . "\n"; // As of PHP 5.3.0

print Bar::$mystatic . "\n";
$bar = new Bar();
print $bar->barStatic() . "\n";
?>
