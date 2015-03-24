<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

     if (!loggedin()){
        header('Location: index.php');
    }
   
   clearRespMsgs(); 

if (isset($_SESSION['t_serial'])) {
	$t_serial=$_SESSION['t_serial'];
}
if (isset($_SESSION['referer'])) {
	$referer=$_SESSION['referer'];
}

if (isset($_POST['cancel'])){
	header('Location: '.$referer);
	exit();
}
if (isset($_POST['assignT'])) {
	$tprinter = $_POST['tprinter'];
	$insdate = date('Y-n-j');

	$query1 = "SELECT * FROM loc_tonners 
			   WHERE t_model ='".$_SESSION['tonnerMA']."'
				AND t_color='".$_SESSION['tonnerColorA']."'AND t_status = 'assigned'";
	$run = mysql_query($query1);
	$rownum = mysql_num_rows($run);

	if ($rownum == 1) {
		while ($row1 = mysql_fetch_assoc($run)){
			extract($row1);
		}

		$old_tserial = $t_serialno;
		$date = date('Y-n-j');

		$query3="UPDATE tonners SET t_ranoutDate = '$date', t_status = 'ranout' WHERE t_serialno='$old_tserial'";
		mysql_query($query3);
	}
		
	// update data in mysql database
	$query="UPDATE tonners SET t_assignedP = '$tprinter', t_status = 'assigned', t_installeddate = '$insdate' WHERE t_serialno='$t_serial'";

	$result=mysql_query($query);

	if ($result){
		clearRespMsgs();
		$_SESSION ['updateTSuccess'] = 'Tonner successfuly assigned';	
		header('Location: tonner_list.php');
	}else{
		clearRespMsgs();
		$_SESSION ['updateTFailure'] = 'Update Problem encountered';
		header('Location: tonner_list.php');
	}
	


} 
//--------------------------------------------FORM----------------------------------------

//create session and store wireless ip address name
$_SESSION['t_serial'] = $_GET['id'];
$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

// Get wireless ip information
$query2 = "SELECT *  FROM tonners WHERE t_serialno ='". $_SESSION['t_serial']."'";
$result2 = mysql_query($query2);


// Display ip information 
while ($row = mysql_fetch_assoc($result2)){
	extract($row);

	$_SESSION['tonnerMA'] =  $t_model;
	$_SESSION['tonnerColorA'] = $t_color;
	$_SESSION['tonnerStatusA'] = $t_status;
	

}

?>
<body>
    <div id="container">
        <?php require "banner.php"; ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">ADMINISTRATION : Tonners
                    	<a role="submit" class="btn btn-default" href="administration.php">Back</a>
                    </div>
                    <div class="panel-body">
                        <div class='row-fluid'>
			    			<div class="col-sm-6 col-sm-offset-3">
			    				<h2><center>ASSIGN TONNER TO PRINTER</center></h2>
			    				<hr>
			   
							    <form class = "form-horizontal" role="form" id="assign_tonner" action="assign_tonner.php" method="post">
									<div class="form-group">	
										<label for="tprinter" class="col-sm-4 control-label">Printer</label>
										<div class="col-sm-8">
											<select class="form-control" id="tprinter" name="tprinter">
												<option <?php if ($_SESSION['tprinter']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM loc_printers WHERE p_status NOT LIKE 'pool'";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['tprinter']==$row['p_serialno'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['p_serialno'].'">'.$row['p_serialno'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['tprinterErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['tprinterErrorA']."</div>";
												}
												?>
											
										</div>
									</div>
						
									<button type="submit" class="btn btn-primary" name="assignT" ><span class="glyphicon glyphicon-edit"></span>Assign</button>
									<a href="tonner_list.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-step-backward"></span>Back</a>
							    </form>
			    			</div>
              			</div><!-- close row -->
                    </div> <!-- close panel-body -->
                    <?php 
                        include 'footer1.php';
                    ?>
                    </div>
                </div> <!-- close panel -->
            </div> <!-- close colum -->
        </div> <!-- end row1 -->
        <div class="row">
            <?php include "footer.php"; ?>
        </div> <!-- close row2 -->
    </div> <!-- close main container -->
</body>
</html>