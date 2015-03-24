<?php

    include "functions.php";
    include "connect.php";

    if (!loggedin()){
		header('Location: index.php');
	}

	if (isset($_POST['clear'])) {
		$_SESSION['tSerielNo'] =  $_POST ['tSerielNo'];
		$_SESSION['tModel'] = $_POST ['tModel'];
		$_SESSION['tColor'] = $_POST ['tColor'];
		$_SESSION['tDesc'] = $_POST ['tDesc'];
		$_SESSION['tPrinter'] = $_POST ['tPrinter'];
		$_SESSION['tPurchDate'] = date('Y-n-j');

		clearTAddFields ();
		clearTonnerAddErrors();
		header('Location: add_tonner.php');
	}
    
    if (isset($_POST['addT'])) {
		$_SESSION['tSerielNo'] =  $_POST ['tSerielNo'];
		$_SESSION['tModel'] = $_POST ['tModel'];
		$_SESSION['tColor'] = $_POST ['tColor'];
		$_SESSION['tDesc'] = $_POST ['tDesc'];
		$_SESSION['tPrinter'] = $_POST ['tPrinter'];
		$_SESSION['tPurchDate'] = $today = date('Y-n-j');
		$_SESSION['tInstDate'] = "NA";
		$_SESSION['tRanOutDate'] = "NA";
		$_SESSION['tStatus'] = "pool";
		$_SESSION['tAssigndP'] = "None";

		clearTonnerAddErrors();
		        
		if ($_SESSION['tSerielNo'] == null){
		    $_SESSION['tSerielNoErrorA'] = "Error ! Enter Tonner Seriel No";
	        header ('Location: add_tonner.php');
		    exit();
		}
		
		if ($_SESSION['tModel'] == null) {
		    $_SESSION['tModelErrorA'] = "Error ! Enter Tonner Model";
	        header ('Location: add_tonner.php');
		    exit();
		}

		if ($_SESSION['tColor'] == null) {
		    $_SESSION['tColorErrorA'] = "Error ! Select Tonner Color";
	        header ('Location: add_tonner.php');
		    exit();
		}
		
		if ($_SESSION['tDesc'] == null) {
		    $_SESSION['tDescErrorA'] = "Error ! Enter Tonner Description";
	        header ('Location: add_tonner.php');
		    exit();
		}

		if ($_SESSION['tPrinter'] == "--select--") {
		    $_SESSION['tPrinterErrorA'] = "Error ! Select Tonner Printer";
	        header ('Location: add_tonner.php');
		    exit();
		}
		
		if ($_SESSION['tPurchDate'] == null) {
		    $_SESSION['tPurchDateErrorA'] = "Error ! Enter Tonner Purchase Date";
	        header ('Location: add_tonner.php');
		    exit();
		}

		$query = 'SELECT * FROM tonners WHERE t_serialno = "'.$_SESSION['tSerielNo'].'"';
		$query_run = mysql_query ($query);
		$queryNumRows = mysql_num_rows($query_run);

		if ($queryNumRows == 1) {
			$_SESSION ['addTFailure'] = 'Tonner already added';
			header ('Location: add_tonner.php');
			exit();

		} else {
			$query = 'INSERT INTO tonners VALUES("'.$_SESSION['tSerielNo'].'","'.$_SESSION['tModel'].'","'.$_SESSION['tColor'].'","'.$_SESSION['tDesc'].'","'.$_SESSION['tPrinter'].'","'.$_SESSION['tPurchDate'].'",
				"'.$_SESSION['tInstDate'].'","'.$_SESSION['tRanOutDate'].'","'.$_SESSION['tStatus'].'","'.$_SESSION['tAssigndP'].'")';
			$query_run = mysql_query ($query);

			if ($query_run){
		        $_SESSION ['addTSuccess'] = 'Tonner successfuly added';
			    clearTAddFields();
		        header('Location: add_tonner.php');	
			} else {
			    $_SESSION ['addTFailure'] = 'Cannot run query';
				header ('Location: add_tonner.php');
				exit();
			}
		} // end else
    } // end first if 
?>