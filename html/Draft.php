<!DOCTYPE html>
<head>
<?php
session_start();
	   if(isset($_POST["Add"])){
		#echo "You have chosen to add the following players:<br/>";
		if(!empty($_POST['checkbox'])){
		# if(isset($_POST['checkbox'])&&is_array($_POST['checkbox'])){
	   ##insert into selectionplayers
			$text = "You have chosen the following players:";
			foreach($_POST['checkbox'] as $player){

				echo "$player";
				array_push($_SESSION['players'], $player);
				
			}
			$max=sizeof($_SESSION['players']);
for($i=0; $i<$max; $i++) {

while (list ($key, $val) = each ($_SESSION['players'][$i])) {
echo "$key -> $val ,";
} // inner array while loop
echo "<br>";
} // outer array for loop
			#$player = implode(",", $_POST['checkbox']);
                        #echo "<script type=\"text/javascript\">window.onload = function() { document.getElementById(\"rightdiv\").innerHTML = \"' . $text . '\"; }</script>";
		}
		else{
		         echo "No option selected bitch";
		}

	  } 


?>
</head>

<body>
<div id = "leftdiv" name = "leftdiv">
<form action="" method="POST">
<p>Please click here to draft the players</p>

<label for="ptype">Choose a player type and click the button below to view(by default, we will show all players):</label>

<select name="ptype" id="ptype">
  <option value="QB">QB</option>
  <option value="RB">RB</option>
  <option value="WR">WR</option>
  <option value="TE">TE</option>
 <option value="All" selected="selected">All</option>

</select>
<input type="submit"  name="Filter" value="Filter">
</p>

<?php		
#only if Draft button is clicked
if(isset($_POST['Filter'])){
$_SESSION['players'] = array();
$database="Fantasyfootball";
$Player=$_GET['Player'];
$team=$_GET['Team'];
$position=$_GET['Position'];
$ptype=$_POST['ptype'];
#echo "Attempting to connect to dbms\n";
$Connection=mysqli_connect("localhost","root","deepthi123") or die("Database connection failed. Please check your connection");
#echo "Connected to Mariadb\n";
mysqli_select_db($Connection, $database) or die("Database not found");
#echo "Connected to database $database\n";

#extract from table
if($ptype=="All"){
$selection_query = "select * from PlayerInformation"; 
}
else {
	$selection_query = "select * from PlayerInformation where Position='$ptype'";
}


$output = mysqli_query($Connection, $selection_query);
   if(mysqli_error($Connection)){
     echo "Error in data extraction. Check query";
   }
   else{
echo "<table> 
		<tr>
		    <th>Select the player</th>
		    <th> Player </th>
                    <th>Team</th>
                    <th>Position</th>
                </tr>";
   while($query_data=mysqli_fetch_array($output))
     {
 $player = $query_data['Player'];
	    $Team = $query_data['Team'];
	    $Position = $query_data['Position'];
echo "<tr><td><input type=\"checkbox\" name=\"checkbox[]\" value=\"$player\"></td>";
echo "
<td>$player</td>
<td>$Team</td>
<td>$Position</td>";

echo "</tr>";
}
 echo "</table><br><input type=\"submit\" name=\"Add\" value=\"Add\">";
     }}
?>

</form>
</div>
<div id="righdiv" name="rightdiv">
<p> Your selected team will be shown here. Once you have finalized your team, click on finalize button to save to database</p>
</div>
</body>
</html>

