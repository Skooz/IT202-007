<!DOCTYPE html>
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function checkPasswords(){
	if(isset($_POST['password']) && isset($_POST['confirm'])){
		if($_POST['password'] == $_POST['confirm']){
			echo "<br>Passwords match!<br>";
		}
		else{
			echo "<br>Passwords did not match!<br>";
		}
	}
}
?>

<html>
<head>
<script>
function validate(){
	var form = document.forms[0];
	var password = form.password.value;
	var conf = form.confirm.value;
 
	console.log(password);
	console.log(conf);
 
	let pv = document.getElementById("validation.password");
	let succeeded = true;
 
	if(password == conf){
		pv.style.display = "none";
		form.confirm.className= "noerror";	
	}
	else{
		pv.style.display = "block";
		pv.innerText = "Passwords don't match";
		//form.confirm.focus();
		form.confirm.className = "error";
		//form.confirm.style = "border: 1px solid red;";
		succeeded = false;
	}
 
	var email = form.email.value;
	var ev = document.getElementById("validation.email");
 
	if(email.indexOf('@') > -1){
		ev.style.display = "none";
	}
	else{
		ev.style.display = "block";
		ev.innerText = "Please input a valid E-Mail";
		succeeded = false;
	}
	debugger;

	//To get element by name
	var sel = form.dd;
	//To get by ID
	//sel = document.getElementById("mySelectId");

	//sample to show debugger use
	//succeeded = false;
	//wrongItem.value = "";
 
	if(sel.selectedIndex == 0){
		alert("Please select a value");
		succeeded = false;
	}
	console.log(sel.options[sel.selectedIndex].value);
	return succeeded;	
}
</script>
<style>
input { border: 1px solid black; }
.error {border: 1px solid red;}
.noerror {border: 1px solid black;}
</style>
</head>
<body>
<div style="margin-left: 50%; margin-right:50%;">

<form method="POST" action="#" onsubmit="return validate();">
<input name="name" type="text" placeholder="Enter your name"/>

<input name="email" type="email" placeholder="name@example.com"/>
<span id="validation.email" style="display:none;"></span>

<input type="password" name="password" placeholder="Enter a password"/>
<input type="password" name="confirm" placeholder="Re-Enter password"/>
<span style="display:none;" id="validation.password"></span>

<select name="dd" id="mySelectId">
	<option value="-1">Select One</option>
	<option value="0">Cool</option>
	<option value="1">Not Cool</option>
</select>
<input type="submit" value="Submit!"/>
</form>
</div>
</body>
</html>
<?php checkPasswords();?>
<?php
if(isset($_POST)){
	echo "<br><pre>" . var_export($_POST, true) . "</pre><br>";
}
?>