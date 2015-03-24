<?php

    include "functions.php";
    include "connect.php";

    if (!loggedin()){
		header('Location: index.php');
	}

	if (isset($_POST['clear'])) {
		$_SESSION['printerMdl'] = $_POST ['printerMdl'];
		$_SESSION['printerSrl'] = $_POST ['printerSrl'];
		$_SESSION['printerIp'] =  $_POST ['printerIp'];
		$_SESSION['printerLoc'] = $_POST ['printerLoc'];
		$_SESSION['printerFlr'] =  $_POST ['printerFlr'];
		$_SESSION['printerSup'] =  $_POST ['printerSup'];

		clearPSAddFields();
		clearLPrinterAddErrors();
		header('Location: leasd_add_printer.php');
	}
    
    if (isset($_POST['addPS'])) {
		
		$_SESSION['printerMdl'] = $_POST ['printerMdl'];
		$_SESSION['printerSrl'] = $_POST ['printerSrl'];
		$_SESSION['printerIp'] =  $_POST ['printerIp'];
		$_SESSION['printerLoc'] = $_POST ['printerLoc'];
		$_SESSION['printerFlr'] =  $_POST ['printerFlr'];
		$_SESSION['printerSup'] =  $_POST ['printerSup'];

		clearLPrinterAddErrors();
		        	
		if ($_SESSION['printerMdl'] == null) {
		    $_SESSION['printerMdlErrorA'] = "Error ! Enter Printer Model";
	        header ('Location: leasd_add_printer.php');
		    exit();
		}
		
		if ($_SESSION['printerSrl'] == null) {
		    $_SESSION['printerSrlErrorA'] = "Error ! Enter Printer Seriel Number";
	        header ('Location: leasd_add_printer.php');
		    exit();
		}
		
		if ($_SESSION['printerIp'] == null) {
		    $_SESSION['printerIpErrorA'] = "Error ! Enter Printer IP Adress";
	        header ('Location: leasd_add_printer.php');
		    exit();
		}

		if ($_SESSION['printerLoc'] == '--select--') {
		    $_SESSION['printerLocErrorA'] = "Error ! Select Printer Location";
	        header ('Location: leasd_add_printer.php');
		    exit();
		}

		if ($_SESSION['printerFlr'] == '--select--') {
		    $_SESSION['printerFlrErrorA'] = "Error ! Select Printer Floor";
	        header ('Location: leasd_add_printer.php');
		    exit();
		}

		if ($_SESSION['printerSup'] == '--select--') {
		    $_SESSION['printerSupErrorA'] = "Error ! Select Printer Supplier";
	        header ('Location: leasd_add_printer.php');
		    exit();
		}

		$query = 'SELECT * FROM leasd_printers WHERE p_serial = "'.$_SESSION['printerSrl'].'"';
		$query_run = mysql_query ($query);
		$queryNumRows = mysql_num_rows($query_run);

		if ($queryNumRows == 1) {
			$_SESSION ['addPSFailure'] = 'Printer already added';
			header ('Location: leasd_add_printer.php');
			exit();

		} else {
			$query = 'INSERT INTO leasd_printers VALUES("'.$_SESSION['printerSrl'].'","'.$_SESSION['printerMdl'].'","'.$_SESSION['printerIp'].'","'.$_SESSION['printerLoc'].'","'.$_SESSION['printerFlr'].'","'.$_SESSION['printerSup'].'")';
			$query_run = mysql_query ($query);

			if ($query_run){
		        $_SESSION ['addPSSuccess'] = 'Printer successfuly added';
			    clearPSAddFields();
		        header('Location: leasd_add_printer.php');	
			} else {
			    $_SESSION ['addPSFailure'] = 'Cannot run query';
				header ('Location: leasd_add_printer.php');
				exit();
			}
		} // end else
    } // end first if 
?>