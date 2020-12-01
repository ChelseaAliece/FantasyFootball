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
<?php
session_start();
# check if user is logged in
/*if(!isset($_SESSION['Úsername'])){
     header("Location: Login.php");
}*/

$database="Fantasyfootball";
           $username = $_SESSION['Username'];
	   if(isset($_POST["Add"])){
		   #echo "You have chosen to add the following players:<br/>";
		   $qb_count = count($_POST["QB"]);
		   $rb_count = count($_POST["RB"]);
		   $wr_count = count($_POST["WR"]);
		   $te_count = count($_POST["TE"]);
		   $all_outputs = array_merge($_POST["QB"], $_POST["RB"], $_POST["WR"], $_POST["TE"]);
		   #echo "You have chosen QB:$qb_count, RB: $rb_count, WR: $wr_count, TE: $te_count";
                   if(($qb_count != 1) || ($rb_count != 2) || ($wr_count != 2) || ($te_count != 1)){
                           echo "<script>alert(\"You need to choose 1 QB, 2 RB, 2 WR and 1 TE\"); </script>";
		   }
		   else{
			   $Connection1=mysqli_connect("localhost","root","deepthi123") or die("Database connection failed. Please check your connection");
			   #echo "Connected to Mariadb\n";
			   mysqli_select_db($Connection1, $database) or die("Database not found");
			   foreach($all_outputs as $pname){
				   $insertion_query = "insert into SelectedPlayers(Username,Player) values('$username', '$pname')";
				   $insertion_output = mysqli_query($Connection1, $insertion_query);
				   if(mysqli_error($Connection1)){
					   echo "Error in insertion. Check query";
				   }
				   

			   }
			   header("location:RetrieveTeam.php");
		   } 
	   }


?>
</head>

<body>
<form action="" method="POST">
<p>Please click here to draft the players</p>


<?php		
#only if Draft button is clicked
$ptypes=array("QB", "RB", "WR", "TE");

#echo "Attempting to connect to dbms\n";
$Connection=mysqli_connect("localhost","root","deepthi123") or die("Database connection failed. Please check your connection");
#echo "Connected to Mariadb\n";
mysqli_select_db($Connection, $database) or die("Database not found");
#echo "Connected to database $database\n";
echo "Ënter your search phrase (name) here.";
echo "<input type = \"text\" id=\"searchText\"><br/>";

#echo "<button id=\"Search\" name=\"Search\">Click Here To Search</button><br/>"; 
#echo "<button id=\"Reset\" name=\"Reset\" onclick=\"window.location.reload();\">Click Here To Refresh</button><br/>"; 
foreach($ptypes as $ptype){
#extract from table
	$selection_query = "select * from PlayerInformation where Position='$ptype'";



$output = mysqli_query($Connection, $selection_query);
   if(mysqli_error($Connection)){
     echo "Error in data extraction. Check query";
   }
   else{
	   echo "<p>Player Type: $ptype</p>";
echo "<table id=\"$ptype\" data-name=\"anytable\" class=\"anytable\"> 
		<tr>
		    <th>Select the player</th>
		    <th> Player </th>
                    <th>Team</th>
		    <th>Position</th>
                     <th>Passing Yards</th>
                     <th>Passes Completed</th>
                     <th>Attempted Passes</th>
                     <th>Passes Percentage</th>
                     <th> Rushing Yards</th>
                    <th> Rushing Attempts</th>
                    <th>Targets</th>
                    <th>Receptions</th>
                    <th>Receiving Yards</th>
                     <th>Touch</th>
                     <th> Fantasy Points</th>
                </tr>";
   while($query_data=mysqli_fetch_array($output))
     {
 $player = $query_data['Player'];
 $Team = $query_data['Team'];
 $Position = $query_data['Position'];
 $PassingYDS=($query_data['PassingYDS']!=null)?$query_data['PassingYDS']:"-";
$CmpPasses=($query_data['CmpPasses']!=null)?$query_data['CmpPasses']:"-";
$AttemptedPasses=($query_data['AttemptedPasses']!=null)?$query_data['AttemptedPasses']:"-";
$PassesPercentage=($query_data['PassesPercentage']!=null)?$query_data['PassesPercentage']:"-";
$RushingYDS=($query_data['RushingYDS']!=null)?$query_data['RushingYDS']:"-";
$RushingAttempts=($query_data['RushingAttempts']!=null)?$query_data['RushingAttempts']:"-";
$Targets=($query_data['Targets']!=null)?$query_data['Targets']:"-";
$Reception=($query_data['Reception']!=null)?$query_data['Reception']:"-";
$ReceivingYards=($query_data['ReceivingYards']!=null)?$query_data['ReceivingYards']:"-";
$touch=($query_data['touch']!=null)?$query_data['touch']:"-";
$FantasyPoints=($query_data['FantasyPoints']!=null)?$query_data['FantasyPoints']:"-";

 
 $checkboxname=$ptype."[]";	    
echo "<tr><td><input type=\"checkbox\" name=\"$checkboxname\" value=\"$player\"></td>";
echo "
<td>$player</td>
<td>$Team</td>
<td>$Position</td>
<td>$PassingYDS</td>
<td>$CmpPasses</td>
<td>$AttemptedPasses</td>
<td>$PassesPercentage</td>
<td>$RushingYDS</td>
<td>$RushingAttempts</td>
<td>$Targets</td>
<td>$Reception</td>
<td>$ReceivingYards</td>
<td>$touch</td>
<td>$FantasyPoints</td>";


echo "</tr>";
}
 echo "</table><br>";
   }}
 echo "</table><br><input type=\"submit\" name=\"Add\" value=\"Add\">"

?>

</form>
<script type="text/javascript">
 
 document.getElementById("searchText").onkeyup = function(){
  player_tables = document.querySelectorAll("table[data-name=anytable]");
  search_query = document.getElementById("searchText").value.toLowerCase();
  if(search_query.length > 0){
	 //if(search_query.length > 5){ 
	 // console.log(search_query);
	  player_tables.forEach(function(sub_table){
		  row_collection = sub_table.getElementsByTagName("tr");
		  //console.log(row_collection.length);
		  for(var j = 0; j < row_collection.length; j++){
			  //console.log(j);
			  pname = row_collection[j].getElementsByTagName("td")[1];
			 if(pname){
				 pname_str = pname.innerHTML.toLowerCase();
				 console.log(pname_str);
			         if(pname_str.includes(search_query)){
                                       //matching
				      row_collection[j].style.display = "";      
				 }
				 else{
                                       //not matching
				      row_collection[j].style.display = "none";      
                                    
				 }
			 }
		  }
	  });  


  }
  else{
         //rest to original when emptysearch
	  player_tables.forEach(function(sub_table){
		  row_collection = sub_table.getElementsByTagName("tr");
		  //console.log(row_collection.length);
		  for(var j = 0; j < row_collection.length; j++){
			  //console.log(j);
			         if(row_collection[j].style.display=="none"){
                                       //matching
				      row_collection[j].style.display = "";      
		  }
		 
		  }
	  });  



  }
 }
	/*
document.getElementById("Reset").onclick = function(){
	console.log("reset selected");
	location.reload();		
}*/
</script>
</body>
</html>

