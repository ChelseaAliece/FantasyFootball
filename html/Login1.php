<!DOCTYPE html>
<head>
<title>User Login</title>
<style>
body {
margin-top:10%;
background-image: url("307818.jpg");
background-size:cover;
text-align:center;
}

</style>
</head>
<body>
<p>Login</p>
<form action="" method="POST">
<p>
<label>Username <font color="red">*</font>:</label>
 <input type="text" id="Username" name="Username" placeholder = "Username">
</p>
<p>
<label>Password <font color="red">*</font>:</label>
 <input type="password" id ="Password" name="Password" placeholder = "Password">
</p>
<p>
<input type="submit"  name="Signin" value="Signin">
</p>
</form>


<?php
#only if submit button is clicked
session_start();
if(isset($_POST['Signin'])){
$Username=$_POST['Username'];
$Password=$_POST['Password'];
$database="Fantasyfootball";
# ensure empty values cannot be entered
if(empty($Username) || (strlen($Username) < 5) ||empty($Password) ||(strlen($Password) < 5)){
    echo "One of the following conditions not met: <br> 1. User name  or password cannot be empty or <br> 2. username or password cannot be less than 5 characters";
}
else{
#echo "Attempting to connect to dbms\n";
$Connection=mysqli_connect("localhost","root","deepthi123") or die("Database connection failed. Please check your connection");
#echo "Connected to Mariadb\n";
mysqli_select_db($Connection, $database) or die("Database not found");
#echo "Connected to database $database\n";
$fetchingdata="select Username, Password from UserRegistration where Username='$Username' and Password ='$Password'";
$query_output=mysqli_query($Connection, $fetchingdata);
$query_data=mysqli_fetch_array($query_output);
if(mysqli_num_rows($query_output) == 1){
#echo $query_data["Username"];
#echo $query_data["Password"];
$_SESSION['Username']=$Username;
header("location:Welcome1.php"); 
}
else{
echo "Invalid user name or password";
}
mysqli_close($Connection);
}
}
?>
</body>
</html>




