
<?php
final class BaseClass {
   public function test() {
       echo "BaseClass::test() called\n";
   }

   // Here it doesn't matter if you specify the function as final or not
   final public function moreTesting() {
       echo "BaseClass::moreTesting() called\n";
   }
}

class ChildClass extends BaseClass {
}
//Since if the class itself is final, it doesnt allow child class to inherit
// Results in Fatal error: Class ChildClass may not inherit from final class (BaseClass)
?>


