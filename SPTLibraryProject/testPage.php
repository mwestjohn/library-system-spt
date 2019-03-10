<?php
error_reporting(0);
$fname = $_POST['fn'];
$age = $_POST['a'];
$course = $_POST['crs'];
 
 
 if ($_POST['clear'])
{
 $fname="";
 $age="";
 $course="";
 $message1="";
 $message2="";
}
 if ($_POST['send']) 
 {
$message1 = "Hello " .$fname;
$message2 = "Your are $age years old and your course is $course.";
	}
?>
<html>
 <style>
 body {
 font-family:arial;
 font-size:12;
 }
</style>
<title> BUILT IN FUNCTIONS</title>
<form action = "" method = "POST">
<body>
<table border = 3>
<tr>
<td> Name: </td>
<td> <input type = text name = fn value = "<?php echo $fname;?>" size="50" autofocus>
</tr>
<tr>
<td> Age: </td>
<td> <input type = text name = a value = "<?php echo $age;?>" size="3">
</tr>
<tr>
<td> Course: </td>
<td> <input type = text name = crs value = "<?php echo $course;?>" size="50" >
</tr>
<tr>
<td colspan = 3>
<input type = "submit" name="send" value = "Ok" title="Click here to display values.">
<input type = "submit" name="clear" value = "Clear" title="Click here to clear text boxes.">
</td>
</tr>
</table>
</form>
 <?php
 echo "<br><br>";
echo "<font face='arial' size='4'>";
echo $message1;
echo "<br>";
echo $message2;
echo "</font>";
 ?>	 
</body>
</html>