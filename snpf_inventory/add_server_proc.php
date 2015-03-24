<?php

    include "functions.php";
    include "connect.php";

    if (!loggedin()){
		header('Location: index.php');
	}

	if (isset($_POST['clear'])) {
		$_SESSION['serverName'] =  $_POST ['serverName'];
		$_SESSION['serverOS'] = $_POST ['serverOS'];
		$_SESSION['serverHw'] = $_POST ['serverHw'];
		$_SESSION['serverSeriel'] = $_POST ['serverSeriel'];
		$_SESSION['serverIp'] = $_POST ['serverIp'];
		$_SESSION['serverHdd'] = $_POST ['serverHdd'];
		$_SESSION['serverRam'] = $_POST ['serverRam'];
		$_SESSION['serverDesc'] = $_POST ['serverDesc'];

		clearSAddFields ();
		clearServerAddErrors();
		header('Location: add_server.php');
	}
    
    if (isset($_POST['addS'])) {
		$_SESSION['serverName'] =  $_POST ['serverName'];
		$_SESSION['serverOS'] = $_POST ['serverOS'];
		$_SESSION['serverHw'] = $_POST ['serverHw'];
		$_SESSION['serverSeriel'] = $_POST ['serverSeriel'];
		$_SESSION['serverIp'] = $_POST ['serverIp'];
		$_SESSION['serverHdd'] = $_POST ['serverHdd'];
		$_SESSION['serverRam'] = $_POST ['serverRam'];
		$_SESSION['serverDesc'] = $_POST ['serverDesc'];

		clearServerAddErrors();
		        
		if ($_SESSION['serverName'] == null){
		    $_SESSION['serverNameErrorA'] = "Error ! Enter Server name";
	        header ('Location: add_server.php');
		    exit();
		}

		if ($_SESSION['serverSeriel'] == null) {
		    $_SESSION['serverSerielErrorA'] = "Error ! Enter Server Seriel No";
	        header ('Location: add_server.php');
		    exit();
		}
		
		if ($_SESSION['serverOS'] == '--select--') {
		    $_SESSION['serverOSErrorA'] = "Error ! Enter Operating System";
	        header ('Location: add_server.php');
		    exit();
		}
		
		if ($_SESSION['serverHw'] == null) {
		    $_SESSION['serverHwErrorA'] = "Error ! Enter Server Hardware";
	        header ('Location: add_server.php');
		    exit();
		}

		if ($_SESSION['serverIp'] == null) {
		    $_SESSION['serverIpErrorA'] = "Error ! Enter Server IP";
	        header ('Location: add_server.php');
		    exit();
		}


		if ($_SESSION['serverHdd'] == null) {
		    $_SESSION['serverHddErrorA'] = "Error ! Enter Server Hard drive";
	        header ('Location: add_server.php');
		    exit();
		}

		if ($_SESSION['serverRam'] == null) {
		    $_SESSION['serverRamErrorA'] = "Error ! Enter Server Ram";
	        header ('Location: add_server.php');
		    exit();
		}

		if ($_SESSION['serverDesc'] == null) {
		    $_SESSION['serverDescErrorA'] = "Error ! Enter Server Description";
	        header ('Location: add_server.php');
		    exit();
		}

		$query = 'SELECT * FROM servers WHERE s_serial = "'.$_SESSION['serverSeriel'].'"';
		$query_run = mysql_query ($query);
		$queryNumRows = mysql_num_rows($query_run);

		if ($queryNumRows == 1) {
			$_SESSION ['addSFailure'] = 'Server already added';
			header ('Location: add_server.php');
			exit();

		} else {
			$query = 'INSERT INTO servers VALUES("'.$_SESSION['serverSeriel'].'","'.$_SESSION['serverName'].'","'.$_SESSION['serverOS'].'","'.$_SESSION['serverHw'].'","'.$_SESSION['serverIp'].'","'.$_SESSION['serverHdd'].'","'.$_SESSION['serverRam'].'","'.$_SESSION['serverDesc'].'")';
			$query_run = mysql_query ($query);

			if ($query_run){
		        $_SESSION ['addSSuccess'] = 'Server successfuly added';
			    clearServerAddErrors();
		        header('Location: add_server.php');	
			} else {
			    echo "Cannot run query";
			    $_SESSION ['addSFailure'] = 'Cannot run query';
				header ('Location: add_server.php');
				exit();
			}
		} // end else
    } // end first if 
?>