<?php

    include "functions.php";
    include "connect.php";

    if (!loggedin()){
		header('Location: index.php');
	}

	if (isset($_POST['clear'])) {
		$_SESSION['userName'] =  $_POST ['userName'];
		$_SESSION['firstName'] = $_POST ['firstName'];
		$_SESSION['lastName'] = $_POST ['lastName'];
		$_SESSION['officeNo'] = $_POST ['officeNo'];
		$_SESSION['ulocation'] = $_POST ['ulocation'];
		$_SESSION['uAccess'] = $_POST ['uAccess'];
		$_SESSION['udivision'] = $_POST ['udivision'];
		$_SESSION['ufloor'] = $_POST ['ufloor'];

		clearUserAddFields();
		clearUserAddErrors();
		header('Location: add_user.php');
	}
    
    if (isset($_POST['addU'])) {
		$_SESSION['userName'] =  $_POST ['userName'];
		$_SESSION['userPass'] = "snpf2015";
		$_SESSION['firstName'] = $_POST ['firstName'];
		$_SESSION['lastName'] = $_POST ['lastName'];
		$_SESSION['officeNo'] = $_POST ['officeNo'];
		$_SESSION['ulocation'] = $_POST ['ulocation'];
		$_SESSION['uAccess'] = $_POST ['uAccess'];
		$_SESSION['udivision'] = $_POST ['udivision'];
		$_SESSION['ufloor'] = $_POST ['ufloor'];

		clearUserAddErrors();
		        
		if ($_SESSION['userName'] == null){
		    $_SESSION['userNameErrorA'] = "Error ! Enter user name";
	        header ('Location: add_user.php');
		    exit();
		}

		
		if ($_SESSION['userPass'] == null) {
		    $_SESSION['passwordErrorA'] = "Error ! Enter password";
	        header ('Location: add_user.php');
		    exit();
		}

		
		if ($_SESSION['firstName'] == null) {
		    $_SESSION['firstNameErrorA'] = "Error ! Enter firstname";
	        header ('Location: add_user.php');
		    exit();
		}
	
		if ($_SESSION['lastName'] == null) {
		    $_SESSION['lastNameErrorA'] = "Error ! Enter lastname";
	        header ('Location: add_user.php');
		    exit();
		}
		
		if ($_SESSION['officeNo'] == null) {
		    $_SESSION['officeNoErrorA'] = "Error ! Enter officeno";
	        header ('Location: add_user.php');
		    exit();
		}
			
		if (!is_numeric($_SESSION['officeNo'])) {
		    $_SESSION['officeNoErrorA'] = "Error ! officeno should be a number";
	        header ('Location: add_user.php');
		    exit();
		}

		if ($_SESSION['ulocation'] == "--select--") {
		    $_SESSION['ulocationErrorA'] = "Error ! Select User location";
	        header ('Location: add_user.php');
		    exit();
		}

		if ($_SESSION['uAccess'] == "--select--") {
		    $_SESSION['uAccessErrorA'] = "Error ! Select User access right";
	        header ('Location: add_user.php');
		    exit();
		}

		if ($_SESSION['udivision'] == "--select--") {
		    $_SESSION['udivisionErrorA'] = "Error ! Select User Division";
	        header ('Location: add_user.php');
		    exit();
		}

		if ($_SESSION['ufloor'] == "--select--") {
		    $_SESSION['ufloorErrorA'] = "Error ! Select User Floor";
	        header ('Location: add_user.php');
		    exit();
		}


		$query = 'SELECT * FROM users WHERE user_name = "'.$_SESSION['username'].'"';
		$query_run = mysql_query ($query);
		$queryNumRows = mysql_num_rows($query_run);

		if ($queryNumRows == 1) {
			$_SESSION ['addUFailure'] = 'User already added';
			header ('Location: add_user.php');
			exit();

		} else {

			$query = 'INSERT INTO users VALUES("'.$_SESSION['userName'].'","'.$_SESSION['userPass'].'",
				"'.$_SESSION['firstName'].'","'.$_SESSION['lastName'].'","'.$_SESSION['officeNo'].'","'.$_SESSION['uAccess'].'"
				,"'.$_SESSION['ulocation'].'","'.$_SESSION['udivision'].'","'.$_SESSION['ufloor'].'")';
			$query_run = mysql_query ($query);

			if ($query_run){
		        $_SESSION ['addUSuccess'] = 'User successfuly added';
			    clearUserAddFields();
		        header('Location: add_user.php');	
			} else {
			    $_SESSION ['addUFailure'] = 'Can not run query';
				header ('Location: add_user.php');
			}
		} // end else
    } // end first if 
?>