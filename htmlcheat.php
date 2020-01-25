<?php 
    include('server.php'); //including an external file with  some code to be used s
	//session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first"; //incase this page needs user to be first logged in
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy(); //destroy the session when one logs out
		unset($_SESSION['username']);
		header("location: login.php");
	}
?>

<!-- add something with an image -->
<html>
    <body>
        <div class="container" id="addsomething">
            <div style="padding: 6px 12px; border: 1px solid #ccc;">
                <h3> SOMETHING SOMETHING</h3> 
                <p> some other useful information </p>   
                
                <form method="post" action="htmlcheat.php" enctype="multipart/form-data">
                <!-- incase there're errors encountered, thwy'll be displayed here -->
                <?php include('errors.php'); ?> 


                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image">
                </div>
                
                <div class="form-group">
                    <label for="exampleDescription">description</label>
                    <input type="text" class="form-control" name="description" placeholder="add a brief description" ></textarea>
                </div>
                <!-- ......
                   ADD SOME OTHER FIELDS
                ....... -->

                <button type="submit" class="btn btn-success" name="add_something" style="width:100%;"><b>add somethings</b></button>

                </form>

            </div>
        </div>






    </body>
</html>