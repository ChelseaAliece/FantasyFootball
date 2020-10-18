<!DOCTYPE html>
<head>
	<title>Welcome to Fantasy football</title>
</head>
<body>
<form action="" method="POST" > 
	<div class="split left">
	<table>
	<tr><td><p> You can draft the players here </p></td></tr>
	<tr><td><a href="Draft1.php">Draft</a></td>
</p></td></tr>
	<tr><td><p>To view your profile information</p></td></tr>
	<tr><td><a href="RetrieveUser.php">Click here</a></td></tr>
 <tr><td><p>After drafting your team, you can retrieve their details here</p></td></tr>
        <tr><td><a href="RetrieveTeam.php">Click here</a></td></tr>

<tr><td><p>Week by week scoring of the leaderboard</p></td></tr>
        <tr><td><a href="Scoring.php">Click here</a></td></tr>

	</table>
	</div>
</form>
<!--	<div class="split right">
	<p> The list of players </p>-->
<?php
#session_start();
# check if user is logged in
/*if(!isset($_SESSION['Úsername'])){
     header("Location: Login.php");
}*/
/*
$database="Fantasyfootball";
//$Username=$_SESSION['Username'];
//get username and data from session

#echo "Attempting to connect to dbms\n";
$Connection=mysqli_connect("localhost","root","deepthi123") or die("Database connection failed. Please check your connection");
#echo "Connected to Mariadb\n";
mysqli_select_db($Connection, $database) or die("Database not found");
#echo "Connected to database $database\n";


# now select data from that table 
$selection_query = "select * from PlayerInformation"; 

$output = mysqli_query($Connection, $selection_query);
   if(mysqli_error($Connection)){
     echo "Error in data extraction. Check query";
   }
    else{
	    $query_data=mysqli_fetch_array($output);
	    while($query_data=mysqli_fetch_array($output)){
	    $Player = $query_data['Player'];
	    $Team = $query_data['Team'];
	    $Position = $query_data['Position'];
	    echo "<table> <tr>
				<td> $Player </td> 
		    		<td>$Team</td>
		    	        <td>$Position</td></tr>
		    </table>";
	    }
 
    }
 */
?>
</div>

</body>
</html>

