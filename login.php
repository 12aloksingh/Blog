<?php session_start(); ?>
<html>
<head>
	<title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">
        <div class="row">
        <div><a class="btn btn-primary" href="index.php" role="button">Home</a></div> <br />
<?php
include("connection.php");

if(isset($_POST['login'])) {
	$username =$_POST['username'];
	$password =$_POST['password'];

	if($username == "" || $password == "") {
		echo "Either username or password field is empty.";
		echo "<br/>";
		echo "<a href='login.php'>Go back</a>";
	} else {
		$sql = "select * from `users` where username='$username' and password=md5('$password')";
        $result=mysqli_query($con, $sql);
        if($result){
            $num=mysqli_num_rows($result);
            if($num>0){
                $row=mysqli_fetch_assoc($result);
                $validuser = $row['username'];
                $_SESSION['valid'] = $validuser;
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                if(isset($_SESSION['valid'])){
                header('Location: index.php');
                }
            }
            else{
                echo "Invalid username or password.";
                echo "<br/>";
                echo "<a href='login.php'>Go back</a>";
            }
        }
           
	}
} else {
?>
	
    
            <div class="mx-auto col-10 col-md-8 col-lg-6">
            <h1 class="text-center my-3 text-dark">Login</h1>
                <form name="form1" method="post" action="">
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                   </div>

                    <button class="btn btn-dark w-100" type="submit" name="login">Login</button>

                </form>
            </div>
        </div>
    </div>

<?php
}
?>
</body>
</html>