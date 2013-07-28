<?php
abstract class Absclass{
	abstract protected function getValue();
	abstract protected function prefixValue($prefix);
	public function printvalue(){
	print $this->getValue() . "\n";
	}	
}
class concreteclass extends Absclass{
	public function getValue(){
	return "ConcreteClass1";
	}
	public function prefixValue($prefix){
	return "{$prefix}ConcreteClass1";
	}
}

class ConcreteClass2 extends Absclass
{
    public function getValue() {
        return "ConcreteClass2";
    }

    public function prefixValue($prefix) {
        return "{$prefix}ConcreteClass2";
    }
}

$class1=new concreteclass();
$class1->getValue();
$class1->printValue();
echo $class1->prefixValue("Inside ") .  "\n";

$class2 = new ConcreteClass2;
$class2->printValue();
echo $class2->prefixValue('FOO_') ."\n";
?>
