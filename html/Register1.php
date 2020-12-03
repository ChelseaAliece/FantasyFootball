<?php
session_start();
#only if submit button is clicked
if(isset($_POST['Register'])){
$Username=$_POST['Username'];
$Password=$_POST['Password'];
$database="Fantasyfootball";
# ensure empty values cannot be entered
if(empty($Username) || (strlen($Username) < 5) ||empty($Password) ||(strlen($Password) < 5)){
    echo "One of the following conditions not met: <br> 1. User name  or password cannot be empty or <br> 2. username or password cannot be less than 5 characters";
}
else{
#echo "Attempting to connect to dbms\n";
$Connection=mysqli_connect("127.0.0.1","root","storm123!") or die("Database connection failed. Please check your connection");
#echo "Connected to Mariadb\n";
mysqli_select_db($Connection, $database) or die("Database not found");
#echo "Connected to database $database\n";


$fetchingdata="select Username, Password from UserRegistration where Username='$Username' and Password ='$Password'";
$query_output=mysqli_query($Connection, $fetchingdata);
$query_data=mysqli_fetch_array($query_output);
#echo $query_data["Username"];
#echo $query_data["Password"];
if($query_data["Username"]==$Username)
{
echo "User already exists, please use a different username";
#echo "<script>document.getElementById('msg').value=.echo </script>";
}
else
{
# user does not exist, so we can create a new user
   $insertion_query = "insert into UserRegistration(Username,Password) values('$Username', '$Password')";
   $insertion_output = mysqli_query($Connection, $insertion_query);
   if(mysqli_error($Connection)){
     echo "Error in insertion. Check query";
   }
    else{
     echo "Username successfully inserted";
     $_SESSION['Username'] = $Username;
     $_SESSION['Password'] = $Password;
#echo "<script>document.getElementById('msg').value=.echo </script>";
     header("location: UserDetails.php"); 
   }

}
mysqli_close($Connection);
}
}
?>

<!DOCTYPE html>
<head>
<title>User Registration</title>
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

<p>User Registration</p>
<form action="" method="POST">
<div class="content">
<p>
<label>Username<font color="red">*</font>:</label>
 <input type="text" id="Username" name="Username" placeholder = "Username" >
</p>
<p>
<label>Password<font color="red">*</font>:</label> 
 <input type="password" id ="Password" name="Password" placeholder = "Password">
</p>
<p>
<input type="submit"  name="Register" value="Submit">
</p>
</form>
</div>
</body>
</html>


