<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<title>Register</title>
</head>

<body>
<?php
include("connection.php");

if(isset($_POST['register'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username == "" || $password == "" || $name == "" || $email == "") {
		echo "All fields should be filled. Either one or many fields are empty.";
		echo "<br/>";
		echo "<a href='register.php'>Go back</a>";
	} else {
        $sql="INSERT INTO `users`(`name`, `email`, `username`, `password`) VALUES ('$name', '$email', '$username', md5('$password'))";
        $result=mysqli_query($con, $sql);
		if($result){
		echo "Registration successfully";
		echo "<br/>";
		echo "<button class='btn btn-warning'> <a class='text-secondary link' href='login.php'>Login</a></button>";
        }
        else{
            die(mysqli_error());
        }
	}
} else {
?>

    <div class="container">
        <div class="row">
        <div><a class="btn btn-primary" href="index.php" role="button">Home</a></div> <br />
            <div class="mx-auto col-10 col-md-8 col-lg-6">
            <h1 class="text-center my-3 text-dark">Register</h1>
                <form name="form1" method="post" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control border-danger" id="name" placeholder="Enter Your Full Name" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control border-danger" id="email" placeholder="Enter Your Email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control border-danger" id="username" placeholder="Username" name="username">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control border-danger" id="password" placeholder="Password" name="password">
                   </div>

                    <button class="btn btn-success w-100 hover" type="submit" name="register">Register</button>

                </form>
            </div>
        </div>
    </div>

	
<?php
}
?>
</body>
</html>