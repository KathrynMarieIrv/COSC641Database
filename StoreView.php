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
ul {
  text-align: left;
}
img{
    max-height:300px;
    max-width:300px;
    height:auto;
    width:auto;
}
</style>
<style type="text/css">
    .fieldset-auto-width {
         display: inline-block;
    }
</style>
</head>

<h1>SBD Design Database<br>
Views</h1>
<body>
<!--Navigation-->
<div id="nav">
<a href="Index.php">Home</a>
<a href="Display.php">Departments</a>
<a href="Stores.php">Stores</a>
<a href="Add.php">Database Additions</a>
<?php
//make a DB connection
$DBConnect = mysqli_connect("INSERT", "admin", "INSERT", "sbd_icms");


//if there isnt a DB connection, you need to let the admin know

if($DBConnect == false)
	print"Unable to connect to the database:" .mysqli_errno();
	else {
		//set up the table name 
		$TableName = "store";	
		//this is a wild card selection for everything in the DB
		$ID = stripslashes($_GET['store_id']);
		$SQLstring = "Select * from $TableName WHERE ID = $ID";




		$QueryResult = mysqli_query($DBConnect, $SQLstring);
		//check to see if ther are records in table?
		if(mysqli_num_rows($QueryResult)>0)
		{//output all of the results in a dynamic table 
	
	
		$store = mysqli_fetch_assoc($QueryResult);
		
			
		
		
		}//end num row test
		
		else
			print"There are no results to display";
		
		mysqli_free_result($QueryResult);
	
		//close the else for connection
		}
		
	
	mysqli_close($DBConnect);		
		
?>

</html>