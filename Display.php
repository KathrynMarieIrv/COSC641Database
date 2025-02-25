<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="CSS/WebsiteStyle.CSS">
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
Departments View Page</h1>
<body>
<!--Navigation-->
<div id="nav">
<a href="Index.php">Home</a>
<a href="Display.php">Departments</a>
<a href="Stores.php">Stores</a>
<a href="Add.php">Database Additions</a>

<table width ='100%' border='1'>

<th><a href="Display.php?sort=dept_id">Department ID:</a></th>
<th><a href="Display.php?sort=dept_name">Department Name:</a></th>



<?php
//make a DB connection
$DBConnect = mysqli_connect("INSERT", "admin", "INSERT", "sbd_icms");


//if there isnt a DB connection, you need to let the admin know

if($DBConnect == false)
	print"Unable to connect to the database:" .mysqli_errno();
	else {
		//set up the table name 
		$TableName = "department";		
		//this is a wild card selection for everything in the DB
		$SQLstring = "Select * from $TableName";

$QueryResult = mysqli_query($DBConnect, "SELECT COUNT(*) AS `dept_id` FROM `department`");
$Row = mysqli_fetch_array($QueryResult);
$count = $Row['dept_id'];
print"<h1>Departments: $count</h1>";

		$QueryResult = mysqli_query($DBConnect, $SQLstring);
		//check to see if ther are records in table?
		if(mysqli_num_rows($QueryResult)>0)
		{//output all of the results in a dynamic table 
	
	
		while($Row = mysqli_fetch_assoc($QueryResult))
		{
			//this is the dynamic part of our table
	
			print"<tr><td><a href='View.php?ID={$Row['dept_id']}' target='_blank'>{$Row['dept_id']}</a></td><td>{$Row['dept_name']}</td></tr>";
			
			
		}//end while statement
		
		
		}//end num row test
		
		else
			print"There are no results to display";
		
		mysqli_free_result($QueryResult);
	
		//close the else for connection
		}
		
	
	mysqli_close($DBConnect);

		
	
?>
</body>
</html>