<select id = "opts" onchange = "showForm()">
<option value = "0">Select Option</option>
<option value = "1">Option 1</option>
<option value = "2">Option 2</option>
</select>

<div id = "f1" style="display:none">
<form name= "form1">
<select id = "opts" onchange = "showForm()">
<option value = "0">Select Option</option>
<option value = "1">Option 5</option>
<option value = "2">Option 6</option>
</select>
</form>
</div>

<div id = "f2" style="display:none">
<form name= "form2">
<select id = "opts" onchange = "showForm()">
<option value = "0">Select Option</option>
<option value = "1">Option 3</option>
<option value = "2">Option 4</option>
</select>
</form>
</div>

<script type = "text/javascript">
function showForm(){
var selopt = document.getElementById("opts").value;
if (selopt == 1) {
document.getElementById("f1").style.display="block";
document.getElementById("f2").style.display="none";
}
if (selopt == 2) {
document.getElementById("f2").style.display="block";
document.getElementById("f1").style.display="none";
}
}

</script>
