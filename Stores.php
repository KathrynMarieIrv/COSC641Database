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
Stores View Page</h1>
<body>
<!--Navigation-->
<div id="nav">
<a href="Index.php">Home</a>
<a href="Display.php">Departments</a>
<a href="Stores.php">Stores</a>
<a href="Add.php">Database Additions</a>

<table width ='100%' border='1'>



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
		$SQLstring = "Select * from $TableName";

//$QueryResult = mysqli_query($DBConnect, "SELECT COUNT(*) AS `store_id` FROM 'store'");
//$Row = mysqli_fetch_array($QueryResult);
//$count = $Row['store_id'];
//print"<h1>Stores: $count</h1>";

		$QueryResult = mysqli_query($DBConnect, $SQLstring);
		//check to see if ther are records in table?
		
        if (mysqli_num_rows($QueryResult) > 0) {
            // Output results in a dynamic table
           print "<table border='1' style='margin: 0 auto; text-align: center;'>";
           print "<tr><th>Store ID</th><th>Location ID</th><th>Store Name</th><th>Store Email</th><th>Store Phone</th></tr>";
    
            while ($Row = mysqli_fetch_assoc($QueryResult)) {
                print "<tr>
                        <td><a href='Stores.php?ID={$Row['store_id']}' target='_blank'>{$Row['store_id']}</a></td>
                        <td>{$Row['loc_id']}</td>
                        <td>{$Row['store_name']}</td>
                        <td>{$Row['store_email']}</td>
                        <td>{$Row['store_phone']}</td>
                       </tr>";
            }
    
            print "</table>";
        } else {
            print "There are no results to display.";
        }
		
		mysqli_free_result($QueryResult);
	
		//close the else for connection
		} 
		
	
	mysqli_close($DBConnect);

		
	
?>
</body>
</html>