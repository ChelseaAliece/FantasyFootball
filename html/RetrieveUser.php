<!DOCTYPE html>
<head>
<title>User Registration</title>
</head>
<body>
<p>Please enter your user id and password to retrieve your information</p>
<form action="" method="POST">
<p>
<label>Username</label>
 <input type="text" id="Username" name="Username" >
</p>
<p>
<label>Password</label>
 <input type="password" id ="Password" name="Password">
</p>
<p>
<input type="submit"  name="Submit" value="Submit">
</p>
</form>


<?php
#only if submit button is clicked
if(isset($_POST['Submit'])){

echo "Here are the details saved for you <br>";
$database="userregistration";
$Username=$_POST['Username'];
$Password=$_POST['Password'];
//get username and data from session

#echo "Attempting to connect to dbms\n";
$Connection=mysqli_connect("localhost","root","deepthi123") or die("Database connection failed. Please check your connection");
#echo "Connected to Mariadb\n";
mysqli_select_db($Connection, $database) or die("Database not found");
#echo "Connected to database $database\n";

# check if user exists
$fetchingdata="select Username, Password from UserRegistration where Username='$Username' and Password ='$Password'";
$query_output=mysqli_query($Connection, $fetchingdata);
$query_data=mysqli_fetch_array($query_output);
if($query_data["Username"]==$Username && $query_data["Password"]==$Password)
{
# nowextract from  that table 
$selection_query = "select * from UserDetails where Username='$Username'"; 

$output = mysqli_query($Connection, $selection_query);
   if(mysqli_error($Connection)){
     echo "Error in data extraction. Check query";
   }
    else{
	    $query_data=mysqli_fetch_array($output);
	    $fname = $query_data['Firstname'];
	    $lname = $query_data['Lastname'];
	    $email = $query_data['Email'];
	    echo "<table> <tr> <td> User Name: </td> <td> $Username </td> </tr>
		    <tr><td>First Name:</td><td>$fname</td></tr>
		    <tr><td>Last Name:</td><td>$lname</td></tr>
		    <tr><td>Email:</td><td>$email</td></tr></table>";
                     
 
    }

}
else{
echo "Invalid username and/or password. Please try again";
}
}
?>

</body>
</html>

