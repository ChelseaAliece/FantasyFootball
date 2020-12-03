<?php
#only if submit button is clicked
session_start();
# check if user is logged in
/*if(!isset($_SESSION['Úsername'])){
     header("Location: Login.php");
}*/

$database="fantasyfootball";
$Connection = mysqli_init();

#echo "Attempting to connect to dbms\n";
mysqli_real_connect($Connection, 'ganttca.mysql.database.azure.com', 'ganttca@ganttca', 'Storm123!', 'fantasyfootball', 3306, MYSQLI_CLIENT_SSL);
if (mysqli_connect_errno($Connection)) {
       die('Failed to connect to MySQL: '.mysqli_connect_error());
 }
// $Connection=mysqli_connect("127.0.0.1","root","storm123!") or die("Database connection failed. Please check your connection");
#echo "Connected to Mariadb\n";
mysqli_select_db($Connection, $database) or die("Database not found");
#echo "Connected to database $database\n";

# current user
$joinquery="SELECT S.Username as Uname, Sum(T.Week1) as W1,Sum(T.Week2) as W2,Sum(T.Week3) as W3,Sum(T.Week4) as W4,Sum(T.Week5) as W5,Sum(T.Week6) as W6,Sum(T.Week7) as W7,Sum(T.Week8) as W8,Sum(T.Week9) as W9,Sum(T.Week10) as W10,Sum(T.Week11) as W11,Sum(T.Week12) as W12,Sum(T.Week13) as W13,Sum(T.Week14) as W14,Sum(T.Week15) as W15,Sum(T.Week16) as W16,Sum(T.Week17) as W17  FROM `Teams` T, selectedplayers S, playerinformation P WHERE T.Team=P.Team and S.Player=P.Player GROUP BY S.Username";
$output=mysqli_query($Connection, $joinquery);
   if(mysqli_error($Connection)){
     echo "Error in data extraction. Check query";
   }
   else{
	  # echo "Your team information<br/>";
	    $query_data=mysqli_fetch_array($output);
	    echo "<table class=\"anytable\">
     		    <tr>
                    <th> User/Fantasy Team</th>
                    <th>W1</th>
		    <th>W2</th>
<th>W3</th>
		    <th>W4</th>
		    <th>W5</th>
		    <th>W6</th>
		<th>W7</th>
		<th>W8</th>
<th>W9</th>
<th>W10</th>
<th>W11</th>
<th>W12</th>
<th>W13</th>
<th>W14</th>
<th>W15</th>
<th>W16</th>
<th>W17</th>
                </tr>";
   while($query_data=mysqli_fetch_array($output))
     {
           $Uname = $query_data['Uname'];
            $W1 = $query_data['W1'];
	   $W2 = $query_data['W2'];
$W3 = $query_data['W3'];
$W4 = $query_data['W4'];
$W5 = $query_data['W5'];
$W6 = $query_data['W6'];
$W7 = $query_data['W7'];
$W8 = $query_data['W8'];
$W9 = $query_data['W9'];
$W10 = $query_data['W10'];
$W11 = $query_data['W11'];
$W12 = $query_data['W12'];
$W13 = $query_data['W13'];
$W14 = $query_data['W14'];
$W15 = $query_data['W15'];
$W16 = $query_data['W16'];
$W17 = $query_data['W17'];
echo "
<td> $Uname</td>
                    <td>$W1</td>
                    <td>$W2</td>
		    <td>$W3</td>
		    <td>$W4</td>
		    <td>$W5</td>
		    <td>$W6</td>
		<td>$W7</td>
		<td>$W8</td>
<td>$W9</td>
<td>$W10</td>
<td>$W11</td>
<td>$W12</td>
<td>$W13</td>
<td>$W14</td>
<td>$W15</td>
<td>$W16</td>
<td>$W17</td>";
echo "</tr>";
}
 echo "</table><br/><br/>";
   }

?>

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
<title>Leaderboard</title>
</head>
<body>
<p>Fantasy Football Leaderboard For Each Week</p>
</body>
</html>

