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

<h1>SDB Design Database<br>
Search Results Page</h1>
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

if($DBConnect == false) {
	print"Unable to connect to the database:" .mysqli_errno();}
	else {
		//set up the table name 
		$TableName = "department";
		$query = ($_POST['query']);
		
		
		
			$SQLstring = "select * from department where dept_id like '%$query%'
							  union select * from department where dept_name like '%$query%'";
							  
			$QueryResult = mysqli_query($DBConnect, $SQLstring);
			
		//check to see if ther are records in table?
			if(mysqli_num_rows($QueryResult)>0) {
				
		print"<br><br><h4>Here is your search result:</h4><br><br>";

print "<table width ='100%' border='1'>
<tr><th>dept_id</th><th>dept_name</th></tr>"; 
		

while($Row = mysqli_fetch_assoc($QueryResult)){

			
		print"<tr><td><a href='View.php?ID={$Row['dept_id']}' target='_blank'>{$Row['dept_id']}</a></td><td>{$Row['dept_name']}</td></tr>";

}
} else {
	print "0 records";
}
	}
	print"</table>";
		mysqli_close($DBConnect);
		
?>
</body>
</html>