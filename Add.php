<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="CSS/WebsiteStyle.css">
<head>
<title>SBD Design Database</title>
<meta http-equiv="content-type" content ="text/html; charset=iso-8859-1" />

<style>
body {
    margin:50px 0px; padding:0px;
    text-align:center;
    align:center;
}
</style>
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style>
</head>


<h1>SBD Design Database<br>
Database Additions</h1>
<body>
<!--Navigation-->
<div id="nav">
<a href="Index.php">Home</a>
<a href="Display.php">Departments</a>
<a href="Stores.php">Stores</a>
<a href="Add.php">Database Additions</a>

<form action="websitehandler.php" method="POST">

<h4>Management View<br>



  <fieldset class="fieldset-auto-width">
<div class="form-style1">
<h4>Add a New Department:</h4>
	<br>
	<b>Department ID:</b>
	<input type="text" name="dept_id">
	<br>
	<b>Department Name:</b>
	<input type="text" name="dept_name">
	<br>
	<br>
	</fieldset>
<br><br>

<br><br>
<div class="form-style2">
<input type="submit" value="Submit"/>
</div>

			
        </div>
		<br/>
</fieldset>

  <fieldset class="fieldset-auto-width">
<div class="form-style1">
<h4>Add a New Store:</h4>
	<br>
	<b>Store ID:</b>
	<input type="text" name="store_id">
	<br>
	<b>Store Location:</b>
	<input type="text" name="loc_id">
	<br>
	<b>Store Name:</b>
	<input type="text" name="store_name">
	<br>
	<b>Store Email:</b>
	<input type="text" name="store_email">
	<br>
	<b>Store Phone:</b>
	<input type="text" name="store_phone">
	<br>
	</fieldset>
<br><br>

<br><br>
<div class="form-style2">
<input type="submit" value="Submit"/>
</div>

			
        </div>
		<br/>
</fieldset>

</form>

</html>