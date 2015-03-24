<?php

    include "functions.php";
    include "connect.php";

    if (!loggedin()){
		header('Location: index.php');
	}

	if (isset($_POST['clear'])) {
		$_SESSION['printerName'] =  $_POST ['printerName'];
		$_SESSION['printerModel'] = $_POST ['printerModel'];
		$_SESSION['pSerielNo'] = $_POST ['pSerielNo'];
		$_SESSION['printerDesc'] = $_POST ['printerDesc'];

		clearPAddFields();
		clearPrinterAddErrors();
		header('Location: printer_list_loc.php');
	}
    
    if (isset($_POST['addP'])) {
		$_SESSION['printerName'] =  $_POST ['printerName'];
		$_SESSION['printerModel'] = $_POST ['printerModel'];
		$_SESSION['pSerielNo'] = $_POST ['pSerielNo'];
		$_SESSION['printerComp'] = "none";
		$_SESSION['printerDesc'] = $_POST ['printerDesc'];
		$_SESSION['printerStatus'] = "pool";

		clearPrinterAddErrors();
		        
		if ($_SESSION['printerName'] == null){
		    $_SESSION['printerNameErrorA'] = "Error ! Enter Printer name";
	        header ('Location: printer_list_loc.php');
		    exit();
		}
		
		if ($_SESSION['printerModel'] == null) {
		    $_SESSION['printerMdlErrorA'] = "Error ! Enter Printer Model";
	        header ('Location: printer_list_loc.php');
		    exit();
		}
		
		if ($_SESSION['pSerielNo'] == null) {
		    $_SESSION['pSerielNoErrorA'] = "Error ! Enter Printer Seriel Number";
	        header ('Location: printer_list_loc.php');
		    exit();
		}
		
		if ($_SESSION['printerDesc'] == null) {
		    $_SESSION['printerDescErrorA'] = "Error ! Enter Printer Description";
	        header ('Location: printer_list_loc.php');
		    exit();
		}

		$query = 'SELECT * FROM printers WHERE p_serialno = "'.$_SESSION['pSerielNo'].'"';
		$query_run = mysql_query ($query);
		$queryNumRows = mysql_num_rows($query_run);

		if ($queryNumRows == 1) {
			$_SESSION ['addPFailure'] = 'Printer already added';
			header ('Location: printer_list_loc.php');
			exit();

		} else {
			$query = 'INSERT INTO loc_printers VALUES("'.$_SESSION['pSerielNo'].'","'.$_SESSION['printerModel'].'","'.$_SESSION['printerName'].'","'.$_SESSION['printerComp'].'","'.$_SESSION['printerDesc'].'","'.$_SESSION['printerStatus'].'")';
			$query_run = mysql_query ($query);

			if ($query_run){
		        $_SESSION ['addPSuccess'] = 'Printer successfuly added';
			    clearPAddFields();
		        header('Location: printer_list_loc.php');	
			} else {
			    $_SESSION ['addPFailure'] = 'Cannot run query';
				header ('Location: printer_list_loc.php');
				exit();
			}
		} // end else
    } // end first if 
?>