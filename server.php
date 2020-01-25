<?php 
    //setting time to a default time zone 
    date_default_timezone_set("Africa/Nairobi");

    //starting a session 
	session_start();

	// server variable declaration 
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'dbname');

	
	// LOGIN ADMIN
	if (isset($_POST['login_admin'])) {
        // Accepting Variabes from the from  the forms
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

        //server side validation to ensure there are mo blank posts 
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }

		if (count($errors) == 0) {
            //encryptnig the password to ensure the result can be compared with the already encrypted password in the db
            $password = md5($password);
            //select record from the table 
			$query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
                // if there exists a record, set the session user variable 
				$_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in"; // a sucess message after login if needed 
                
                //redirect to a page 
				header('location: index.php');
			}else {

                //incase no record is found push the error 
				array_push($errors, "Wrong username/password combination");
			}
		}
	}


	//ADD AGENT
	if (isset($_POST['register_something'])) {
		$uname = mysqli_real_escape_string($db, $_POST['uname']);
        // . 
        // .
        // ... RECEIVE SOME INPUT 
        
        $cdate = date("Y-m-d");     // Curent date 
        $ctime = date("h:i:s");     // current time 
		
		// check if phone number is legit
		function validate_phone_number($phone)
		{
			// Allow +, - and . in phone number
			$filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
			// Remove "-" from number
			$phone_to_check = str_replace("-", "", $filtered_phone_number);
			// Check the lenght of number
			// This can be customized if you want phone number from a specific country
			if (strlen($phone_to_check) < 9 || strlen($phone_to_check) > 14) {
			return false;
			} else {
			return true;
			}
		}
		//VALIDATE PHONE NUMBER 
		if (validate_phone_number($phone) !=true) { array_push($errors, "Invalid phone number"); }
        if (empty($uname)) { array_push($errors, "Username is required"); }
        // .
        // .
        // ..

        //check if the passwords match 
		if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match"); }
	
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO agents (username, tel, password, dateCreated, timecreated )
							VALUES('$uname','$phone','$password','$cdate','$ctime')";
			$result = mysqli_query($db, $query);
			if($result)
				echo "<script type='text/javascript'>alert('record Added successfully!')</script>"; //post a popup 
			else
				echo "<script type'text/javascript'>alert('Something Went Wrong!!')</script>";
			
			header('location:somepage.php'); //redirect to a page
			
		}

	}

    if (isset($_POST['add_image'])) {
        $image = $_FILES['image']['name']; //receive image from a form
        //$image_text = mysqli_real_escape_string($db, $_POST['image_text']);
        $target = "Foldername/".basename($image); // name of the folder where the images will be saved

        if (count($errors) == 0) {
			$sql = "INSERT INTO tablename (image ) 
								VALUES ('$image')";
			// execute query
			if(mysqli_query($db, $sql)){
			    header('location: somepage.php');
			}
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			    $msg = "Image uploaded successfully";
			}else{
			    $msg = "Failed to upload image"; //or just push it as an error
			}
		}
    }
?>