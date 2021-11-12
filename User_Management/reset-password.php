<?php
include('includes/config.php');
if(isset($_POST['submit']))
{
$emailId = $_POST['email'];
$token = $_POST['token'];
$password = $_POST['password'];
$query2 = mysqli_query($con,"SELECT * FROM `users` WHERE md5(email)='".$emailId."' and `id`='".$token."'");
if (mysqli_num_rows($query2) > 0) {
mysqli_query($con,"UPDATE users set  password='" . $password . "' WHERE md5(email)='" . $emailId . "' AND id='".$token."'");
echo '<p>Congratulations! Your password has been updated successfully.</p>';
}else{
echo "<p>Something goes wrong. Please try again</p>";
}
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Reset Password In PHP MySQL</title>
<!-- CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="card">
<div class="card-header text-center">
Reset Password 
</div>
<div class="card-body">
<?php
if($_GET['key'])
{
$email = $_GET['key'];
$query = mysqli_query($con,"SELECT * FROM `users` WHERE md5(email) = '".$email."'");
if (mysqli_num_rows($query) > 0) {
$row= mysqli_fetch_array($query); ?>
<form method="post">
<input type="hidden" name="email" value="<?php echo $email;?>">
<input type="hidden" name="token" value="<?php echo $row['id'];?>">
<div class="form-group">
<label for="exampleInputEmail1">Password</label>
<input type="password" name='password' class="form-control">
</div>                
<div class="form-group">
<label for="exampleInputEmail1">Confirm Password</label>
<input type="password" name='cpassword' class="form-control">
</div>
<input type="submit" name="submit" class="btn btn-primary">
<br/>
<a style="float:right" href="login.php">Return to Login</a>
</form>
<?php  } else{
    
echo '<p>This forget password link has been expired</p>';
}
}
?>
</div>
</div>
</div>
</body>
</html>