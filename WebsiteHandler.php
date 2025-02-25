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
Submission Page</h1>
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

if($DBConnect === false)
			print"Unable to connection to the database, error number:".mysqli_errno();
			else{
				
				//create the code to say what table we are going to use
				$TableName = "department";
				//now it is time to get the information from the $_POST array
				
				$DeptID = stripslashes($_POST['dept_id']);
				$DeptName = stripslashes($_POST['dept_name']);

		
				
				//now it is time to create the SQL statement
				$SQLstring = "insert into $TableName (dept_id, dept_name) 
				values ('$DeptID','$DeptName')";
				
				//this is the line of code that executes our SQL statement
				//$QueryResult =mysqli_query($SQLstring,$DBConnect);
				if(mysqli_query($DBConnect,$SQLstring))
					print"<br><br>Department Has Been Added<br>";
				else
					print"Error: " . $$SQLstring . "<br>" . mysqli_error($DBConnect);
				
			}//end inner else DB connect
			mysqli_close($DBConnect);
		
	//}//end outter have everything







?>
</body>
</html>