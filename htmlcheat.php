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

        //PASS A VARIABLE TO ANOTHER PAGE 
        <a href="page.php?var_name=<?=$var?>" >


        //UPDATE 
        <?php require('errors.php'); ?>
        <?php 
            $resultz = mysqli_query($db,"SELECT * FROM users WHERE id='$uid'");
            $rowz= mysqli_fetch_array($resultz);
        ?>
        <form class="form" action="htmlcheat.php" method="post">
        <div class="form-group">
            <div class="col-xs-6">
                <label for="first_name"><h4>First name</h4></label>
                <input type="text" class="form-control" name="fname" id="first_name" value="<?php echo $rowz['firstName']; ?>">
            </div>
            </div>
            <div class="form-group">
                
                <div class="col-xs-6">
                    <label for="last_name"><h4>Last name</h4></label>
                    <input type="text" class="form-control" name="lname" id="last_name" value="<?php echo $rowz['lastName']; ?>">
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="uname" value="<?=$uname?>" style="opacity: 0;" />
                <input type="text" name="uid" value="<?=$uid?>" style="opacity: 0;" />
                <input type="text" name="uemail" value="<?=$uemail?>" style="opacity: 0;" />
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <br>
                    <button class="btn btn-lg btn-success" type="submit" name="Add_prof"><i class="glyphicon glyphicon-ok-sign"></i> UPDATE PROFILE</button>
                </div>
            </div>
        </form>
    </div>


    </body>
</html>