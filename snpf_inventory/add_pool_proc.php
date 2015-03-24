<?php

    include "functions.php";
    include "connect.php";

    if (!loggedin()){
		header('Location: index.php');
	}

	if (isset($_POST['clear'])) {
		$_SESSION['itemserial'] =  $_POST ['itemserial'];
		$_SESSION['itemtype'] = $_POST ['itemtype'];
		$_SESSION['itembrand'] = $_POST ['itembrand'];
		$_SESSION['itemassetno'] = $_POST ['itemassetno'];

		clearPLAddFields();
		clearPoolAddErrors();
		header('Location: add_pool.php');
	}
    
    if (isset($_POST['addPL'])) {
    	
		$_SESSION['itemserial'] =  $_POST ['itemserial'];
		$_SESSION['itemtype'] = $_POST ['itemtype'];
		$_SESSION['itembrand'] = $_POST ['itembrand'];
		$_SESSION['itemassetno'] = $_POST ['itemassetno'];

		clearPoolAddErrors();
		     
		if ($_SESSION['itemserial'] == null){
		    $_SESSION['itemserialErrorA'] = "Error ! Enter Item serial";
	        header ('Location: add_pool.php');
		    exit();
		}
		
		if ($_SESSION['itemtype'] == '--select--') {
		    $_SESSION['itemtypeErrorA'] = "Error ! Enter Item Type";
	        header ('Location: add_pool.php');
		    exit();
		}
		
		if ($_SESSION['itembrand'] == null) {
		    $_SESSION['pSerielNoErrorA'] = "Error ! Enter Item brand name";
	        header ('Location: add_pool.php');
		    exit();
		}
		
		if ($_SESSION['itemassetno'] == null) {
		    $_SESSION['itemassetnoErrorA'] = "Error ! Enter Item assert no";
	        header ('Location: add_pool.php');
		    exit();
		}

		$query = 'SELECT * FROM pool_items WHERE serialno = "'.$_SESSION['itemserial'].'"';
		$query_run = mysql_query ($query);
		$NumRows = mysql_num_rows($query_run);


		if ($NumRows == 1) {
			$_SESSION ['addPLFailure'] = 'Pool Item already added';
			echo $_SESSION['itemserial'];
			echo "Brian";
			header ('Location: add_pool.php');
			exit();

		} else {
			$query = 'INSERT INTO pool_items VALUES("'.$_SESSION['itemserial'].'","'.$_SESSION['itemtype'].'","'.$_SESSION['itembrand'].'","'.$_SESSION['itemassetno'].'")';
			$query_run = mysql_query ($query);

			if ($query_run){
		        $_SESSION ['addPLSuccess'] = 'Pool successfuly added';
			    clearPLAddFields();
		        header('Location: add_pool.php');	
			} else {
			    $_SESSION ['addPLFailure'] = 'Cannot run query';
			    clearPLAddFields();
				header ('Location: add_pool.php');
				exit();
			}
		} // end else
    } // end first if 
?>