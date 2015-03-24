<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

     if (!loggedin()){
        header('Location: index.php');
    }
   
   clearRespMsgs(); 

if (isset($_SESSION['p_serial'])) {
	$p_serial=$_SESSION['p_serial'];
}
if (isset($_SESSION['referer'])) {
	$referer=$_SESSION['referer'];
}

if (isset($_POST['cancel'])){
	header('Location: '.$referer);
	exit();
}
if (isset($_POST['assignP'])) {
	$pcomp = $_POST['pcomputer'];

	// update data in mysql database
	$query="UPDATE loc_printers SET p_comp = '$pcomp', p_status = 'assigned' WHERE p_serialno='$p_serial'";

	$result=mysql_query($query);

	if ($result){
		clearRespMsgs();
		$_SESSION ['updateSuccess'] = 'Printer successfuly assigned';	
		header('Location: printer_list_loc.php');
	}else{
		clearRespMsgs();
		$_SESSION ['updateFailure'] = 'Assignment Problem encountered';
		header('Location: printer_list_loc.php');
	}
} 
//--------------------------------------------FORM----------------------------------------

//create session and store wireless ip address name
$_SESSION['p_serial'] = $_GET['id'];
$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

// Get wireless ip information
$query2 = "SELECT *  FROM printers WHERE p_serialno ='". $_SESSION['p_serial']."'";
$result2 = mysql_query($query2);


// Display ip information 
while ($row = mysql_fetch_assoc($result2)){
	extract($row);

	$_SESSION['printerModelU'] =  $p_model;
	$_SESSION['printerNameU'] = $p_name;
	$_SESSION['printerUserU'] = $p_user;
	$_SESSION['printerDescU'] = $p_description;

}

?>
<body>
    <div id="container">
        <?php require "banner.php"; ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">ADMINISTRATION : Printers
                    	<a role="submit" class="btn btn-default" href="administration.php">Back</a>
                    </div>
                    <div class="panel-body">
                        <div class='row-fluid'>
			    			<div class="col-sm-6 col-sm-offset-3">
			    				<h2><center>ASSIGN PRINTER TO COMPUTER</center></h2>
			    				<hr>
			    
							    <form class = "form-horizontal" role="form" id="assign_printer" action="assign_printer.php" method="post">
									<div class="form-group">	
										<label for="pcomputer" class="col-sm-4 control-label">Computer</label>
										<div class="col-sm-8">
											<select class="form-control" id="pcomputer" name="pcomputer">
												<option <?php if ($_SESSION['pcomputer']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM computers";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['pcomputer']==$row['comp_sn'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['comp_sn'].'">'.$row['comp_sn'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['pcomputerErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['pcomputerErrorA']."</div>";
												}
												?>
											
										</div>
									</div>
						
									<button type="submit" class="btn btn-primary" name="assignP" ><span class="glyphicon glyphicon-edit"></span>Assign</button>
									<a href="printer_list_loc.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-step-backward"></span>Back</a>
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