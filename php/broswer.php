<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
<title>Broswer List</title>
</head>
<body>
<?php 
$browser=array("Firefox", "Chrome", "Internet Explorer", "Safari", "Opera", "Other");

Class Select {
	private $name;
	private $value;
	public function setName($name){$this->name= $name;}
	public function getName(){return $this->name;} 
//This method provides the values used for the options
  //in the select field and checks to be sure the value is an array. 
	public function setValue($value){
	if(!is_array($value) )
		die("Error: Value is not an array");
	$this->value=$value;
	} 
	public function getValue(){return $this->value;}
//This method creates the actual select options. It is private,
  //since there is no need for it outside the operations of the class.
	private function fetchOptions($browser) {
		foreach($browser as $brow) {echo "<option value=\"$brow\">" . $brow . "</option>";}
	}
	public function fetchSelect(){
		echo "<select name=\"".$this->getname(); "\">\n";
		$this->fetchOptions($this->getValue());
		echo "</select>";
	}
};
if(!isset($_POST['submit'])){
?>
<form name="Browser Survey" method="post" action="test.php">
<label>Name: </label><input type="text" value="name"></></br>
<label>UserName: </label><input type="text" value="username"></></br>
<label>Email Address: </label><input type="text" value="email"></></br>
<p>Browser:
<?php 
//Alternative is calling functions from Select class 
//echo "<select>";
//foreach($browser as $brow) echo "<option value=\"$brow\">" . $brow . "</option>"; 
//echo "</select>" ;
$browserobj= new Select();
$browserobj->setName('browser');
$browserobj->setValue($browser);
$browserobj->fetchSelect();
?>
</p>
<input type="submit" name="submit" value="Go" />
</form>
<?php } else
{
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
