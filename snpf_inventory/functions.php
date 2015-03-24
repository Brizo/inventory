<?php
    ob_start();
	session_start();
	include "connect.php";
	
	function loggedin(){
	  	if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])){
	    	return true; 
	 	} else {
	   		return false;
	 	}
	}

	/*function genCsv($query, $list) {
		$filename = 'reports/'.strtotime("now").'.csv';

		$fp = fopen($filename, "w"); 

		$sql = mysql_query($query);
		$row = mysql_fetch_assoc($sql);

		$separator = "";
		$comma = "";

		foreach ($row as $name => $value) {
			$separator .= $comma . '' .str_replace('','""',$name);
			$comma = ",";
		}

		$separator .= "\n";
		fputs($fp,$separator);

		echo $query;
	}*/

	function clearUserAddErrors() {
		$_SESSION['userNameErrorA'] = "";
		$_SESSION['passwordErrorA'] = "";
		$_SESSION['firstNameErrorA'] = "";
		$_SESSION['lastNameErrorA'] = "";
		$_SESSION['officeNoErrorA'] = "";
		$_SESSION['ulocationErrorA'] = "";
		$_SESSION['udivisionErrorA'] = "";
		$_SESSION['uAccessErrorA'] = "";
		$_SESSION['ufloorErrorA'] = "";
		$_SESSION['addUFailure'] = "";
		$_SESSION['addUSuccess'] = "";
	}

	function clearPoolAddErrors() {
		$_SESSION['itemserialErrorA'] = "";
		$_SESSION['itemtypeErrorA'] = "";
		$_SESSION['itembrandErrorA'] = "";
		$_SESSION['itemassetnoErrorA'] = "";
		$_SESSION['addPLFailure'] = "";
		$_SESSION['addPLSuccess'] = "";
	}


	function clearPLAddFields() {
		$_SESSION['itemserial'] = "";
		$_SESSION['itemtype'] = "";
		$_SESSION['itembrand'] = "";
		$_SESSION['itemassetno'] = "";
	}

	function clearStnaryAddErrors() {
		$_SESSION['stnary_typeErrorA'] = "";
		$_SESSION['stnary_offErrorA'] = "";
		$_SESSION['stnary_qntyErrorA'] = "";
		$_SESSION['stnary_dateinnoErrorA'] = "";
		$_SESSION['addSTNFailure'] = "";
		$_SESSION['addSTNSuccess'] = "";
	}

	function clearSTAddFields() {
		$_SESSION['stnary_type'] = "";
		$_SESSION['stnary_off'] = "";
		$_SESSION['stnary_qnty'] = "";
		$_SESSION['stnary_datein'] = "";
	}

	function clearStnaryTypeAddErrors() {
		$_SESSION['typeNameErrorA'] = "";
		$_SESSION['typeDescErrorA'] = "";
		$_SESSION['addSTPFailure'] = "";
		$_SESSION['addSTPSuccess'] = "";
	}
	function clearSTPAddFields() {
		$_SESSION['typeName'] = "";
		$_SESSION['typeDesc'] = "";
	}

	function clearUserAddFields () {
		$_SESSION['userName'] = "";
		$_SESSION['userPass'] = "";
		$_SESSION['firstName'] = "";
		$_SESSION['lastName'] = "";
		$_SESSION['officeNo'] = "";
		$_SESSION['ulocation'] = "";
		$_SESSION['uAccess'] = "";
		$_SESSION['udivision'] = "";
		$_SESSION['ufloor'] = "";
	}

	function clearPAddFields () {
		$_SESSION['printerName'] = "";
		$_SESSION['printerModel'] = "";
		$_SESSION['pSerielNo'] = "";
		$_SESSION['printerDesc'] = "";
	}

	function clearPrinterAddErrors() {
		$_SESSION['printerNameErrorA'] = "";
		$_SESSION['printerMdlErrorA'] = "";
		$_SESSION['pSerielNoErrorA'] = "";
		$_SESSION['printerUserErrorA'] = "";
		$_SESSION['printerDescErrorA'] = "";
		$_SESSION['addPFailure'] = "";
		$_SESSION['addPSuccess'] = "";
	}

	function clearPSAddFields () {
		$_SESSION['printerSrl'] = "";
		$_SESSION['printerMdl'] = "";
		$_SESSION['printerIp'] = "";
		$_SESSION['printerLoc'] = "";
		$_SESSION['printerFlr'] = "";
		$_SESSION['printerSup'] = "";
	}

	function clearLPrinterAddErrors() {
		$_SESSION['printerSrlErrorA'] = "";
		$_SESSION['printerMdlErrorA'] = "";
		$_SESSION['printerIpErrorA'] = "";
		$_SESSION['printerLocErrorA'] = "";
		$_SESSION['printerFlrErrorA'] = "";
		$_SESSION['printerSupErrorA'] = "";
		$_SESSION['addPSFailure'] = "";
		$_SESSION['addPSSuccess'] = "";
	}

	function clearSAddFields () {
		$_SESSION['serverName'] =  "";
		$_SESSION['serverOS'] = "";
		$_SESSION['serverHw'] = "";
		$_SESSION['serverSeriel'] = "";
		$_SESSION['serverIp'] = "";
		$_SESSION['serverHdd'] = "";
		$_SESSION['serverRam'] = "";
		$_SESSION['serverDesc'] = "";
	}

	function clearServerAddErrors() {
		$_SESSION['serverNameErrorA'] = "";
		$_SESSION['serverOSErrorA'] = "";
		$_SESSION['serverHwErrorA'] = "";
		$_SESSION['serverSerielErrorA'] = "";
		$_SESSION['serverIpErrorA'] = "";
		$_SESSION['serverHddErrorA'] = "";
		$_SESSION['serverRamErrorA'] = "";
		$_SESSION['serverDescErrorA'] = "";
		$_SESSION['addSFailure'] = "";
		$_SESSION['addSSuccess'] = "";
	}

	function clearCAddfields (){
		$_SESSION['compName'] = "";
		$_SESSION['compType'] = "";
		$_SESSION['compOs'] = "";
		$_SESSION['monType'] = "";
		$_SESSION['monSerial'] = "";
		$_SESSION['compIp'] = "";
		$_SESSION['compSno'] = "";
		$_SESSION['compUser'] = "";
	}

	function clearCompAddErrors () {
		$_SESSION['compNameErrorA'] =  "";
		$_SESSION['compTypeErrorA'] = "";
		$_SESSION['compOsErrorA'] = "";
		$_SESSION['monTypeErrorA'] = "";
		$_SESSION['monSerialErrorA'] = "";
		$_SESSION['compIpErrorA'] = "";
		$_SESSION['compSnoErrorA'] = "";
		$_SESSION['compUserErrorA'] = "";
		$_SESSION['addCFailure'] = "";
		$_SESSION['addCSuccess'] = "";
	}

	function clearTAddFields () {
		$_SESSION['tSerielNo'] = "";
		$_SESSION['tModel'] = "";
		$_SESSION['tColor'] = "";
		$_SESSION['tDesc'] = "";
		$_SESSION['tPrinter'] = "";
		$_SESSION['tPurchDate'] = "";
	}

	function clearTonnerAddErrors () {
		$_SESSION['tSerielNoErrorA'] = "";
		$_SESSION['tModelErrorA'] = "";
		$_SESSION['tDescErrorA'] = "";
		$_SESSION['ttColorErrorA'] = "";
		$_SESSION['tPrinterErrorA'] = "";
		$_SESSION['tPurchDateErrorA'] = "";
		$_SESSION['addTSuccess'] = "";
		$_SESSION['addTFailure'] = "";
	}

	function clearStnaryUpdateFields () {
		$_SESSION['quantity'] = '';
		$_SESSION['stnary_typeU'] = '';
		$_SESSION['qnty_usedU'] = '';
	}

	function clearStnaryUpdateErrors (){
		$_SESSION['qnty_updateErrorU'] = '';
		$_SESSION['actionErrorU'] = '';
		$_SESSION['updateSTNFailure'] = "";
		$_SESSION['updateSTNSuccess'] = "";
	}

	function clearRespMsgs() {
		$_SESSION['removeUSuccess'] = "";
      	$_SESSION['removeUFailure'] = "";
      	$_SESSION['updateUSuccess'] = "";
	    $_SESSION['updateUFailure'] = "";

	    $_SESSION['removeCSuccess'] = "";
      	$_SESSION['removeCFailure'] = "";
      	$_SESSION['updateCSuccess'] = "";
	    $_SESSION['updateCFailure'] = "";

	    $_SESSION['removeSSuccess'] = "";
      	$_SESSION['removeSFailure'] = "";
      	$_SESSION['updateSSuccess'] = "";
	    $_SESSION['updateSFailure'] = "";

	    $_SESSION['removePSuccess'] = "";
      	$_SESSION['removePFailure'] = "";
      	$_SESSION['updatePSuccess'] = "";
	    $_SESSION['updatePFailure'] = "";

	    $_SESSION['removeTSuccess'] = "";
      	$_SESSION['removeTFailure'] = "";
      	$_SESSION['updateTSuccess'] = "";
	    $_SESSION['updateTFailure'] = "";

	    $_SESSION['removePLSuccess'] = "";
      	$_SESSION['removePLFailure'] = "";
      	$_SESSION['updatePLSuccess'] = "";
	    $_SESSION['updatePLFailure'] = "";

	    $_SESSION['removePSSuccess'] = "";
      	$_SESSION['removePSFailure'] = "";
	    $_SESSION['updatePSFailure'] = "";
	    $_SESSION['updatePSSuccess'] = "";

	    $_SESSION['removeSTSuccess'] = "";
      	$_SESSION['removeSTFailure'] = "";
      	$_SESSION['updateSTSuccess'] = "";
	    $_SESSION['updateSTFailure'] = "";

	    $_SESSION['removeSTNSuccess'] = "";
      	$_SESSION['removeSTNFailure'] = "";
      	$_SESSION['updateSTNSuccess'] = "";
	    $_SESSION['updateSTNFailure'] = "";
	    $_SESSION['actionErrorA'] = "";
	}

	function clearallmgs () {
		clearRespMsgs();
	    clearUserAddErrors();
	    clearPrinterAddErrors();
	    clearLPrinterAddErrors();
	    clearServerAddErrors();
	    clearCompAddErrors ();
	    clearTonnerAddErrors ();
	    clearPoolAddErrors();
	    clearStnaryAddErrors();
	    clearStnaryTypeAddErrors();
	    clearStnaryUpdateErrors();
	    clearStnaryUpdateFields();
	}
?>