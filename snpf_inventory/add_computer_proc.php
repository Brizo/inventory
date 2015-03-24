<?php

    include "functions.php";
    include "connect.php";

    if (!loggedin()){
		header('Location: index.php');
	}

	if (isset($_POST['clear'])) {
		$_SESSION['compName'] =  $_POST ['compName'];
		$_SESSION['compType'] = $_POST ['compType'];
		$_SESSION['compOs'] = $_POST ['compOs'];
		$_SESSION['monType'] = $_POST ['monType'];
		$_SESSION['compHdd'] = $_POST ['compHdd'];
		$_SESSION['compRam'] = $_POST ['compRam'];
		$_SESSION['compIp'] = $_POST ['compIp'];
		$_SESSION['compSno'] = $_POST ['compSno'];
		$_SESSION['compUser'] = $_POST ['compUser'];

		clearCAddfields ();
		header('Location: add_computer.php');
	}
    
    if (isset($_POST['addC'])) {
		$_SESSION['compName'] =  $_POST ['compName'];
		$_SESSION['compType'] = $_POST ['compType'];
		$_SESSION['compOs'] = $_POST ['compOs'];
		$_SESSION['monType'] = $_POST ['monType'];
		$_SESSION['monSerial'] = $_POST ['monSerial'];
		$_SESSION['compIp'] = $_POST ['compIp'];
		$_SESSION['compSno'] = $_POST ['compSno'];
		$_SESSION['compUser'] = $_POST ['compUser'];
		$_SESSION['compStatus'] = "Pool";

		clearCompAddErrors();
		        
		if ($_SESSION['compName'] == null){
		    $_SESSION['compNameErrorA'] = "Error ! Enter Computer name";
	        header ('Location: add_computer.php');
		    exit();
		}

		if ($_SESSION['compType'] == '--select--') {
		    $_SESSION['compTypeErrorA'] = "Error ! Enter Computer Type";
	        header ('Location: add_computer.php');
		    exit();
		}
		
		if ($_SESSION['compOs'] == null) {
		    $_SESSION['compOsErrorA'] = "Error ! Enter Operating System";
	        header ('Location: add_computer.php');
		    exit();
		}
		
		if ($_SESSION['monType'] == null) {
		    $_SESSION['monTypeErrorA'] = "Error ! Enter Computer Monitor Type";
	        header ('Location: add_computer.php');
		    exit();
		}

		if ($_SESSION['monSerial'] == null) {
		    $_SESSION['monSerialErrorA'] = "Error ! Enter Computer Monitor Serial";
	        header ('Location: add_computer.php');
		    exit();
		}

		if ($_SESSION['compIp'] == null) {
		    $_SESSION['compIpErrorA'] = "Error ! Enter Computer IP";
	        header ('Location: add_computer.php');
		    exit();
		}

		if ($_SESSION['compSno'] == null) {
		    $_SESSION['compSnoErrorA'] = "Error ! Enter Computer Seriel NO";
	        header ('Location: add_computer.php');
		    exit();
		}

		if ($_SESSION['compUser'] == "--select--") {
		    $_SESSION['compUserErrorA'] = "Error ! Select Computer User";
	        header ('Location: add_user.php');
		    exit();
		}

		$query = 'SELECT * FROM computers WHERE comp_sn = "'.$_SESSION['compSno'].'"';
		$query_run = mysql_query ($query);
		$queryNumRows = mysql_num_rows($query_run);

		if ($queryNumRows == 1) {
			$_SESSION ['addCFailure'] = 'Computer already added';
			header ('Location: add_computer.php');
			exit();

		} else {
			$query = 'INSERT INTO computers VALUES("'.$_SESSION['compSno'].'","'.$_SESSION['compName'].'",
				"'.$_SESSION['compType'].'","'.$_SESSION['compOs'].'","'.$_SESSION['monType'].'","'.$_SESSION['monSerial'].'"
				,"'.$_SESSION['compIp'].'","'.$_SESSION['compUser'].'","'.$_SESSION['compStatus'].'")';
			$query_run = mysql_query ($query);

			if ($query_run){
		        $_SESSION ['addCSuccess'] = 'Computer successfuly added';
			    clearCAddFields();
		        header('Location: add_computer.php');	
			} else {
			    echo "Cannot run query";
			}
		} // end else
    } // end first if 
?>