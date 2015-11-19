<?php
	//Start session
	session_start();

	//Include database connection details
	require_once('connection.php');

	//Array to store validation errors
	$errmsg_arr = array();

	//Validation error flag
	$errflag = false;

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}


	$time = date("Y-m-d h:i:sa");

	//Sanitize the POST values
	$username = clean($_POST['username']);
	$password = clean($_POST['password']);

	//Input Validations
	if($username == '') {
		$errmsg_arr[] = 'Username missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}

	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}



	//grabs current year
	$qry2="SELECT * FROM setup";
	$result2=mysql_query($qry2);
	$setup = mysql_fetch_assoc($result2);
	$_SESSION['year'] = $setup['currentyear'];
	$_SESSION['district'] = $setup['districtname'];
	$_SESSION['template'] = $setup['template'];
        $_SESSION['contact'] = $setup['contact'];

	//Create query
	$qry="SELECT * FROM login WHERE username='$username' AND pass='$password'";
	$result=mysql_query($qry);


	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) > 0) {
			//Login Successful
			session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			$_SESSION['id'] = $member['id'];
			$_SESSION['username'] = $member['username'];
			$_SESSION['loginfname'] = $member['firstname'];
			$_SESSION['loginlname'] = $member['lastname'];
			$_SESSION['level'] = $member['level'];
			session_write_close();
			
			if ($member['level'] == '1')   //registrar
			{
				header("location: registrar.php");
			} elseif ($member['level'] == '2')    //parent
			{
				header("location: parent.php")
			}elseif ($member['level'] == '3')     //front desk
				header("location: entry.php")
			}
			exit();
		}else {
			//Login failed
			$errmsg_arr[] = 'Username and password not found';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: index.php");
				exit();
			}
		}
	}else {
		die("Query failed");
	}
?>
