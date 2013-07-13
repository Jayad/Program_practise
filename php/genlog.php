<?php
class displayLog {
	$registration=false;
?>
<html>
<head>
<title>Log Search Command Generator</title>
<link rel="stylesheet" type="text/css" href="genlog.css">
</head>
<script>
    function  message(element) {
        alert("You clicked the " + element + " element!") ;
    }
    
    function check_text(field) {
        if (field.value == "") {
            alert ("Blank Value ?? ") ;
            document.formLogSearch.field.focus() ;

        }
    }

</script>    

<body>
<form name="formLogSearch">
<div id="content">
<table border="1">  
<tr>
    <td>Search String</td>
    <td><input id="grepstring" type="text" name="grepstring" value="" onblur="check_text(this);" /></td>
</tr>
<tr>
    <td>Host Type</td>
    <td>
        <select name="hostgroup">
            <option value="login" selected="selected">Login</option>
	<?php if ($registration): echo "" ?>
            <option value="reg">Registration</option>
	<?php endif; ?>
            <option value="openid">OpenID</option>
            <option value="custom">Custom</option>
        </select>
    </td>
</tr>
<tr>
    <td>Log Type</td>
    <td>
        <input type="checkbox" name="us_stat"checked="true" >/home/y/logs/yapache/us/statistics<br>
        <input type="checkbox" name="stat">/home/y/logs/yapache/statistics<br>
        <input type="checkbox" name="us_error">/home/y/logs/yapache/us/error<br>
        <input type="checkbox" name="error">/home/y/logs/yapache/error<br>
        <input type="checkbox" name="us_access">/home/y/logs/yapache/us/access<br>
        <input type="checkbox" name="access">/home/y/logs/yapache/access<br>
    </td>
</tr>
<tr>
        <td>Date</td>
        <td><input type="date" name=logdate" onClick=message(this.type)></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" name="submit" onClick=message(this.name)></td>
<tr>
</table>
</div>
</form>
</body>
</html>
<?php
}?>
