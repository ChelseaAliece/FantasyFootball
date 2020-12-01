<!DOCTYPE html>
<head>
<style>
.anytable{
width: 100%;
border: 0.5px solid black;
font-size:12px;
border-collapse: collapse;
}
.anytable th{
padding: 10px;
text-align: center;
border: 0.5px solid black;
border-collapse: collapse;
}
.anytable td{
padding: 10px;
text-align: center;
border: 0.5px solid black;
border-collapse: collapse;
}
.anytable tr:hover{
background-color: #f5f5f5;
}

</style>
<title>Team Information</title>
</head>
<body>
<form action="" method="POST">
<p>Enter the user id of the user whose team you wish to review</p>
<p>
<label>Userid</label>
 <input type="text" id="Username" name="Username" >
</p>
<p>
<input type="submit"  name="Retrieve" value="Retrieve">
</p>
<p><a href="Scoring.php">Click here to view the leaderboard</a></p>
</form>


<?php
#only if submit button is clicked
session_start();
# check if user is logged in
/*if(!isset($_SESSION['Úsername'])){
     header("Location: Login.php");
}*/

$database="Fantasyfootball";
$Username=$_SESSION["Username"];

#echo "Attempting to connect to dbms\n";
$Connection=mysqli_connect("localhost","root","deepthi123") or die("Database connection failed. Please check your connection");
#echo "Connected to Mariadb\n";
mysqli_select_db($Connection, $database) or die("Database not found");
#echo "Connected to database $database\n";

# current user
$joinquery="select p.Player as Player, p.Team as Team, p.position as Position from SelectedPlayers s, PlayerInformation p where s.Username='$Username' and s.Player = p.Player";
$output=mysqli_query($Connection, $joinquery);
   if(mysqli_error($Connection)){
     echo "Error in data extraction. Check query";
   }
   else{
	   echo "Your team information<br/>";
	    $query_data=mysqli_fetch_array($query_output);
	    echo "<table class=\"anytable\">
     		    <tr>
                    <th> Player </th>
                    <th>Team</th>
                    <th>Position</th>
                </tr>";
   while($query_data=mysqli_fetch_array($output))
     {
           $player = $query_data['Player'];
            $Team = $query_data['Team'];
            $Position = $query_data['Position'];
echo "
<td>$player</td>
<td>$Team</td>
<td>$Position</td>";

echo "</tr>";
}
 echo "</table><br/><br/>";
   }
   if(isset($_POST['Retrieve'])){
           
	   $other = $_POST['Username'];
	   
	   echo "Team Details of User: $other:<br/>";
	   $joinquery="select p.Player as Player, p.Team as Team, p.position as Position from SelectedPlayers s, PlayerInformation p where s.Username='$other' and s.Player = p.Player";
$output=mysqli_query($Connection, $joinquery);
   if(mysqli_error($Connection)){
     echo "Error in data extraction. Check query";
   }
    else{
	    $query_data=mysqli_fetch_array($query_output);
	    echo "<table class=\"anytable\">
     		    <tr>
                    <th> Player </th>
                    <th>Team</th>
                    <th>Position</th>
                </tr>";
   while($query_data=mysqli_fetch_array($output))
     {
           $player = $query_data['Player'];
            $Team = $query_data['Team'];
            $Position = $query_data['Position'];
echo "
<td>$player</td>
<td>$Team</td>
<td>$Position</td>";

echo "</tr>";
}
 echo "</table>";

   
   }
                     
 
    }

?>

</body>
</html>

