<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php

include("connection.php");
$id=$_GET['updateid'];

if(isset($_POST['update']))
{	
	$title = $_POST['title'];
	$content = $_POST['content'];
	
	if(empty($title) || empty($content)) {
				
		if(empty($title)) {
			echo "<font color='red'>Title field is empty.</font><br/>";
		}
		
		if(empty($content)) {
			echo "<font color='red'>Content field is empty.</font><br/>";
		}
				
	} else {	
		$sql = "update `article_table` set updated_at=CURRENT_TIMESTAMP, id=$id, title='$title', content='$content' where id=$id";

    $result=mysqli_query($con, $sql);
    if($result){
        header("Location: view.php");

    }
		
		
	}
}
?>
<?php

$sql="select * from `article_table` where id=$id";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_assoc($result);
$title=$row['title'];
$content=$row['content'];

?>
<html>
<head>	
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<title>Update Article</title>
</head>

<body>
<div class="container">
        <div class="row">
            <div class="mx-auto col-10 col-md-8 col-lg-6">
                <button class="btn btn-info"><a class="text-dark link" href="index.php">Home</a></button>  <button class="btn btn-warning"><a class=" text-dark link" href="view.php">View Article</a></button> <button class="btn btn-danger"> <a class="text-info link" href="logout.php">Logout</a></button>
                <br/><br/>
                <h1 class="text-center my-3 text-dark">Update Article</h1>

                <form action="" method="post" name="form1">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" value=<?php echo  $title; ?> placeholder="Write Title of Article " name="title">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="15" cols="20" name="content">
                            <?php echo $content; ?>
                        </textarea>
                    </div>
                    <button class="btn btn-success w-100" type="submit" name="update">Update</button>
                </form>
            
            </div>
        </div>
    </div>
	
	
	
</body>
</html>