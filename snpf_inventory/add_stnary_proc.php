<?php

    include "functions.php";
    include "connect.php";

    if (!loggedin()){
		header('Location: index.php');
	}

	if (isset($_POST['clear'])) {
		$_SESSION['stnary_type'] =  $_POST ['stnary_type'];
		$_SESSION['stnary_off'] = $_POST ['stnary_off'];
		$_SESSION['stnary_qnty'] = $_POST ['stnary_qnty'];
		$_SESSION['stnary_datein'] = date('Y-n-j');

		clearSTAddFields();
		clearStnaryAddErrors();
		header('Location: add_stnary.php');
	}
    
    if (isset($_POST['addST'])) {
    	
		$_SESSION['stnary_type'] =  $_POST ['stnary_type'];
		$_SESSION['stnary_off'] = $_POST ['stnary_off'];
		$_SESSION['stnary_qnty'] = $_POST ['stnary_qnty'];
		$_SESSION['qnty_used'] = 0;
		$_SESSION['order_level'] = 0;
		$_SESSION['stnary_datein'] = date('Y-n-j');

		clearStnaryAddErrors();
		     
		if ($_SESSION['stnary_type'] == '--select--'){
		    $_SESSION['stnary_typeErrorA'] = "Error ! Select stanary type";
	        header ('Location: add_stnary.php');
		    exit();
		}
		
		if ($_SESSION['stnary_off'] == null) {
		    $_SESSION['itemtypeErrorA'] = "Error ! Enter Stationary Officer";
	        header ('Location: add_stnary.php');
		    exit();
		}
		
		if ($_SESSION['stnary_qnty'] == null) {
		    $_SESSION['stnary_qntyErrorA'] = "Error ! Enter Stationary quantity";
	        header ('Location: add_stnary.php');
		    exit();
		}
	

		$query = 'SELECT * FROM stationary WHERE stnary_type = "'.$_SESSION['stnary_type'].'"';
		$query_run = mysql_query ($query);
		$NumRows = mysql_num_rows($query_run);


		if ($NumRows == 1) {
			$_SESSION ['addSTNFailure'] = 'Stationary Item already added';
			
			header ('Location: add_stnary.php');
			exit();

		} else {
			$query = 'INSERT INTO stationary(stnary_type,quantity, qnty_used,order_level,officer,date_modified) VALUES("'.$_SESSION['stnary_type'].'","'.$_SESSION['stnary_qnty'].'","'.$_SESSION['qnty_used'].'","'.$_SESSION['order_level'].'","'.$_SESSION['stnary_off'].'","'.$_SESSION['stnary_datein'].'")';
			$query_run = mysql_query ($query);

			if ($query_run){
		        $_SESSION ['addSTNSuccess'] = 'Stationary successfuly added';
			    clearSTAddFields();
		        header('Location: add_stnary.php');	
			} else {
			    $_SESSION ['addSTNFailure'] = 'Cannot run query';
			    clearSTAddFields();
				header ('Location: add_stnary.php');
				exit();
			}
		} // end else
    } // end first if 
?>