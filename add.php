<?php session_start();



?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
include("connection.php");

if(isset($_POST['save'])) {	
	$title =mysqli_real_escape_string($con, $_POST['title']);
	$content =mysqli_real_escape_string($con, $_POST['content']);
    $fname=$_SESSION['name'];
	$userId = $_SESSION['id'];
		
	if(empty($title) || empty($content)) {
				
		if(empty($title)) {
			echo "<font color='red'>Title field is empty.</font><br/>";
		}
		
		if(empty($content)) {
			echo "<font color='red'>Content field is empty.</font><br/>";
		}
		
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		
		$sql="INSERT INTO `article_table`(`title`, `content`, `user_id`, `name`) VALUES ('$title', '$content', '$userId', '$fname')";
        $result=mysqli_query($con, $sql);
        if($result){
            echo "<font color='green'>Article Created Successfully.";
		    echo "<br/><a href='view.php'>View Article</a>";
            $author = $_SESSION['valid'];

            $_SESSION['notification']="Article Created Successfully.";

            $sql="SELECT `username` FROM `users` WHERE username != '$author' ";
            $result=mysqli_query($con, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row=mysqli_fetch_assoc($result)){
                    $recipient = $row['username'];
                    $notificationmessage = "New article created by $author ";
                    sendNotification($recipient, $notificationmessage);
                }
            }
           header('Location: index.php');
            exit();
        }
        else{
            $_SESSION['notification'] = "Error: " . mysqli_error($con);
        }
		
	}
}
function sendNotification($recipient, $message){
    global $con;

    $sql="INSERT INTO `notifications`(`recipient`, `message`) VALUES ('$recipient', '$message')";
    $result=mysqli_query($con, $sql);

    if($result){
        return true;
    }
    else{
        return false;
    }
}
?>





<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<title>Create Article</title>
</head>

<body>
	
    <div class="container">
        <div class="row">
            <div class="mx-auto col-10 col-md-8 col-lg-6">
            <button class="btn btn-info"><a class="text-dark link" href="index.php">Home</a></button>  <button class="btn btn-warning"><a class=" text-dark link" href="view.php">View Article</a></button> <button class="btn btn-danger"> <a class="text-info link" href="logout.php">Logout</a></button>
                <br/><br/>
                <h1 class="text-center my-3 text-dark">Create Article</h1>

                <form action="" method="post" name="form1">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Write Title of Article " name="title">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="15" cols="20" name="content"></textarea>
                    </div>
                    <button class="btn btn-success w-100" type="submit" name="save">Save</button>
                </form>
            
            </div>
        </div>
    </div>

	
</body>
</html>






