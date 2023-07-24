<?php session_start(); ?>



<?php


?>

<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<title>View</title>
</head>

<body>
    <div class="container">
        <div class="row">
        <div><a class="btn btn-primary" role="button" href="index.php">Home</a></div> 
        <br/><br/>
        
        
            
            <?php
            include("connection.php");

            $sql="SELECT * FROM `article_table`  WHERE user_id=".$_SESSION['id']." ";
            $result=mysqli_query($con, $sql);
            
                
                if(mysqli_num_rows($result)){
                    echo "<h2>Articles created by";
                    echo "<table class='table'>
                    <thead>
                        <tr>
                            <th scope='col'>ID no.</th>
                            <th scope='col'>Name</th>
                            <th scope='col'>Title</th>
                            <th scope='col'>Content</th>
                            <th scope='col'>operations</th>
                        </tr>
                    </thead>
        
                    <tbody>";
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
                        <td>
                          <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light link">Update</a></button>
                          <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light link">Delete</a></button>
                        </td>
                    </tr>';
                    ?>
                <?php
                    }
                }else{
                    echo"<div>There is no article found</div>";
                    echo "<h3><a class='btn btn-secondary' role='button' href='add.php'>Create New Article</a></h3>";
                }
                ?>

            </tbody>
       
        </table>
        </div>
    </div>
	 
</body>
</html>
