<?php
//Create array.
$browsers=array(
    "Firefox",
    "Chrome",
    "Internet Explorer",
    "Safari",
    "Opera",
    "Other"
  );
 
class Select{
  //Property
  private $name;   //String variable.
  private $value;  //Array variable.
   
  //Methods
  //The string set by this method will be the name of the select field.
  public function setName($name){
     $this->name = $name;
  }
   
  public function getName(){
     return $this->name;
  }
   
  //This method provides the values used for the options
  //in the select field and checks to be sure the value is an array.
  public function setValue($value){
     if (!is_array($value)){
        die ("Error: value is not an array.");
     }
     $this->value = $value;
   }
   
  public function getValue(){
     return $this->value;
  }
   
  //This method creates the actual select options. It is private,
  //since there is no need for it outside the operations of the class.
  private function makeOptions($value){
     foreach($value as $v){
        echo "<option value=\"$v\">" .ucfirst($v). "</option>\n";
      }
  }
 
  //This method puts it all together to create the select field.
  public function makeSelect(){
     echo "<select name=\"" .$this->getName(). "\">\n";
     //Create options.
     $this->makeOptions($this->getValue());
     echo "</select>" ;
  }
}//end class
 
?>
 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<title>Class Select - Browsers</title>
</head>
 
<body>
<h2>User Registration - Browser<br /></h2>
 
<?php
//If form not submitted, display form.
  if(!isset($_POST['submit'])){
?>
   
<form method="post" action="yourfile.php">
<p>Name:<br />
<input type="text" name="name" size="60" />  </p>
<p>Username:<br />
<input type="text" name="username" size="60" /></p>
<p>Email:<br />
<input type="text" name="email" size="60" /></p>
<p>Browser:
 
 
<?php
//Instantiate object.
$browser = new Select();
//Set properties.
$browser->setName('browser');
$browser->setValue($browsers);
//The object has the data it needs from the preceding commands.
//Tell it to make the select field.
$browser->makeSelect();
?>
</p>
<input type="submit" name="submit" value="Go" />
 
</form>
 
<?php
  //If form submitted, process input.
  }else{
    //Could include code to send data to database here.
    //Retrieve user responses.
    $name=$_POST['name'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    //The following variable has an altered name to avoid confusion.
    $selBrowser=$_POST['browser'];
    //Confirm responses to user.
    echo "The following data has been saved for $name: <br />";
    echo "Username: $username<br />";
    echo "Email: $email<br />";
    echo "Browser: $selBrowser<br />";
   
}
?>
 
</body>
</html>
