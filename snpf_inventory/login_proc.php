<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

    if (!loggedin()){
		header('Location: index.php');
	}
    
    session_unset();
        
    if (isset($_POST['submit']) && $_POST['submit'] == 'Login') {
		$_SESSION['user_name'] =  $_POST ['user_name'];
		$_SESSION['user_pass'] = $_POST ['user_pass'];
		$password = md5($user_pass);

		$query = 'SELECT * FROM users WHERE user_name="'.$_SESSION['user_name'].'" AND user_pass="'.$_SESSION['user_pass'].'"';
		$query_run = mysql_query ($query);

		if ($query_run){
		    $query_num_rows = mysql_num_rows($query_run);
		    if ($query_num_rows == 1){ 
		    	$row = mysql_fetch_assoc($query_run);
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['user_firstName'] = $row['user_firstName'];
				$_SESSION['user_lastName'] = $row['user_lastName'];
				$_SESSION['user_officeNo'] = $row['user_officeNo'];
				$_SESSION['user_accessRight'] = $row['user_accessRight']; 
				$adminRefArray = array("http://127.0.0.1/snpf_inventory/update",
									   "http://127.0.0.1/snpf_inventory/remove",
									   "http://127.0.0.1/snpf_inventory/admini",
									   "http://127.0.0.1/snpf_inventory/assign",
									   "http://localhost/snpf_inventory/update",
									   "http://localhost/snpf_inventory/remove",
									   "http://localhost/snpf_inventory/admini",
									   "http://localhost/snpf_inventory/assign");
				$_SESSION['adminRef'] = $adminRefArray;
				header('Location: main.php');	
		    } else {
	            $_SESSION['invalidCred'] = "Error ! Wrong username/password";
	            header ('Location: index.php');
	            exit();
		    }
		} else {
		    echo "Cannot run query";
		}
    } // end first if 
?>