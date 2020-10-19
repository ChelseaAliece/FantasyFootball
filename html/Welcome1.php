<!DOCTYPE html>
<head>
	<title>Welcome to Fantasy football</title>
<style>
body {
margin-top:10%;
margin-left: 35%;
background-image: url("temp1.jpg");
background-size:cover;
text-align:center;
}
.btn {
  letter-spacing: 0.1em;
  cursor: pointer;
  font-size: 14px;
  font-weight: 400;
  line-height: 45px;
  max-width: 160px;
  position: relative;
  text-decoration: none;
  text-transform: uppercase;
text-color:white;
  width: 100%;
}
.btn:hover {
  text-decoration: none;
}

/*btn_background*/
.effect04 {
  --uismLinkDisplay: var(--smLinkDisplay, inline-flex);
  display: var(--uismLinkDisplay);
  color: #000;
  outline: solid  2px #000;
  position: relative;
  transition-duration: 0.4s;
  overflow: hidden;
}

.effect04::before,
.effect04 span{
    margin: 0 auto;
	transition-timing-function: cubic-bezier(0.86, 0, 0.07, 1);
	transition-duration: 0.4s;
}

.effect04:hover{

  background-color: #000;
}

.effect04:hover span{
  -webkit-transform: translateY(-400%) scale(-0.1,20);
          transform: translateY(-400%) scale(-0.1,20);
}

.effect04::before{
  content: attr(data-sm-link-text);
	color: #FFF;
  position: absolute;
  left: 0;
  right: 0;
  margin: auto;
  -webkit-transform: translateY(500%) scale(-0.1,20);
          transform: translateY(500%) scale(-0.1,20);
}

.effect04:hover::before{
  letter-spacing: 0.05em;
  -webkit-transform: translateY(0) scale(1,1);
          transform: translateY(0) scale(1,1);
}

</style>

</head>
<body>
<form action="" method="POST" > 
	<div class="split left">
	<table>
	<tr><td><p style="font-size:160%;"> You can draft the players here </p></td></tr>
	<tr><td><a href="Draft1.php" class="btn effect04" data-sm-link-text="CLICK"><span>DRAFT</span></a></td>
</p></td></tr>
	<tr><td><p style="font-size:160%;">To view your profile information</p></td></tr>
	<tr><td><a href="RetrieveUser.php" class="btn effect04" data-sm-link-text="CLICK"><span>Player Info</span></a></td></tr>
 <tr><td><p style="font-size:160%;">Get Player Details Here</p></td></tr>
        <tr><td><a href="RetrieveTeam.php" class="btn effect04" data-sm-link-text="CLICK"><span>View Details</span></a></td></tr>

<tr><td><p style="font-size:160%;">Week by week scoring of the leaderboard</p></td></tr>
        <tr><td><a href="Scoring.php" class="btn effect04" data-sm-link-text="CLICK"><span>Leaderboards</span></a></td></tr>

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


