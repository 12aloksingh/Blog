<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Homepage</title>
</head>
<body>
    <div class="container border border-primary border-3 rounded-2">
        <div class="row text-center my-3 py-3">
            <h1 class="text-center text-primary-emphasis">WELCOME TO MY PAGE!</h1>

            <?php
                if(isset($_SESSION['valid'])){
                    include('connection.php');

                    $loggedinuser = $_SESSION['valid'];

                    $sql= "select * from notifications where recipient = '$loggedinuser' ";
                    $result= mysqli_query($con, $sql);
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<div> " .$row['message']."</div>";
                        }
                        $clr= "delete from notifications where recipient = '$loggedinuser' ";
                        $result= mysqli_query($con, $clr);
                    }
            ?>

                    <h5>Welcome <?php echo $_SESSION['name'] ?></h5><br/>
                    <br/>
                    <h3><a class="btn btn-success" role="button" href="view.php">To view or edit articles</a></h3>
                    <h3><a class="btn btn-secondary" role="button" href="add.php">Create Article</a></h3> 

                 <div><?php
                }else{
                    echo " Welcome guest Login to create article.<br/><br/>";
                    echo "<b>Already Have Account <button class='btn btn-info'> <a class='text-light link' href='login.php'>Login</a></button></b>";
                    echo "<b>Do Not Have Account <button class='btn btn-success'> <a class='text-light link' href='register.php'>Register</a></button></b>";
                }
                ?>
                </div>

                <?php
                    include("connection.php");

                    $sql="SELECT * FROM `article_table` ";
                    $result=mysqli_query($con, $sql);

                ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID no.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                        </tr>
                    </thead>

                    <tbody>
                
                <?php
                    
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $id=$row['id'];
                            $name=$row['name'];
                            $title=$row['title'];
                            $content=$row['content'];
                        
                            echo ' <tr>
                            <th scope="row">'.$id.'</th>
                            <th scope="row">'.$name.'</th>
                            <td>'.$title.'</td>
                            <td>'.$content.'</td>
                        </tr>';
                    
                        }
                    }
                ?>

                    </tbody>
                </table>

                <?php
                    if(isset($_SESSION['valid'])){
                        include('connection.php');
                ?>
                    <div><button class="btn btn-danger w-20" ><a class="link text-info" href='logout.php'>Logout</a></button></div>
                    
                    <?php
                    }else{
                        echo"";
                    }
                    ?>




        </div>
    </div>
    
</body>
</html>