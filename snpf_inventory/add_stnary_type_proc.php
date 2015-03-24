<?php

    include "functions.php";
    include "connect.php";

    if (!loggedin()){
		header('Location: index.php');
	}

	if (isset($_POST['clear'])) {
		$_SESSION['typeName'] =  $_POST ['typeName'];
		$_SESSION['typeDesc'] = $_POST ['typeDesc'];

		clearSTPAddFields();
		clearStnaryTypeAddErrors();
		header('Location: add_stnary_type.php');
	}
    
    if (isset($_POST['addSTP'])) {
    	
		$_SESSION['typeName'] =  $_POST ['typeName'];
		$_SESSION['typeDesc'] = $_POST ['typeDesc'];


		clearStnaryTypeAddErrors();
		     
		if ($_SESSION['typeName'] == null){
		    $_SESSION['typeNameErrorA'] = "Error ! Select stationary type Name";
	        header ('Location: add_stnary_type.php');
		    exit();
		}
		
		if ($_SESSION['typeDesc'] == null) {
		    $_SESSION['typeDescErrorA'] = "Error ! Enter Stationary Description";
	        header ('Location: add_stnary_type.php');
		    exit();
		}
		
		$query = 'SELECT * FROM stationary_type WHERE type_name = "'.$_SESSION['typeName'].'"';
		$query_run = mysql_query ($query);
		$NumRows = mysql_num_rows($query_run);


		if ($NumRows == 1) {
			$_SESSION ['addSTPFailure'] = 'Stationary Type Name already added';
			
			header ('Location: add_stnary_type.php');
			exit();

		} else {
			$query = 'INSERT INTO stationary_type(type_name, type_desc) VALUES("'.$_SESSION['typeName'].'","'.$_SESSION['typeDesc'].'")';
			$query_run = mysql_query ($query);

			if ($query_run){
		        $_SESSION ['addSTPSuccess'] = 'Stationary Type successfuly added';
			    clearSTPAddFields();
		        header('Location: add_stnary_type.php');	
			} else {
			    $_SESSION ['addSTPFailure'] = 'Cannot run query';
			    clearSTPAddFields();
				header ('Location: add_stnary_type.php');
				exit();
			}
		} // end else */
    } // end first if
?>