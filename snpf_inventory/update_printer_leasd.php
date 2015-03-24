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

clearRespMsgs();

if (isset($_POST['cancel'])){
	header('Location: '.$referer);
	exit();
}
if (isset($_POST['updatePS'])) {

	$model = $_POST['printerMdlU'];
	$ip = $_POST['printerIpU'];
	$location = $_POST['printerLocU'];
	$floor = $_SESSION['printerFlrU'];
	$supplier = $_SESSION['printerSupU'];

	// update data in mysql database
	$query="UPDATE leasd_printers SET p_model = '$model', p_ipaddr = '$ip', p_location= '$location', 
		p_floor='$floor', p_supplier = '$supplier'
			WHERE p_serial='$p_serial'";

	$result=mysql_query($query);

	if ($result){
		clearRespMsgs();
		$_SESSION ['updatePSSuccess'] = 'Printer successfuly updated';	
		header('Location: printer_list_leasd.php');
	}else{
		clearRespMsgs();
		$_SESSION ['updatePSFailure'] = 'Update Problem encountered';
		header('Location: printer_list_leasd.php');
	}
	
} 
//--------------------------------------------FORM----------------------------------------

//create session and store wireless ip address name
$_SESSION['p_serial'] = $_GET['id'];
$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

// Get wireless ip information
$query2 = "SELECT *  FROM leasd_printers WHERE p_serial ='". $_SESSION['p_serial']."'";
$result2 = mysql_query($query2);


// Display ip information 
while ($row = mysql_fetch_assoc($result2)){
	extract($row);

	$_SESSION['printerMdlU'] =  $p_model;
	$_SESSION['printerSrlU'] = $p_serial;
	$_SESSION['printerIpU'] = $p_ipaddr;
	$_SESSION['printerLocU'] = $p_location;
	$_SESSION['printerFlrU'] = $p_floor;
	$_SESSION['printerSupU'] = $p_supplier;
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
			    				<h2><center>Update Leased Printer</center></h2>
			    				<hr>
			    
			    				<?php
			    					
			    					if ($_SESSION['updatePSSuccess'] != ""){
					                    echo "<div class='alert alert-success alert-dismissable'>"
					                      .$_SESSION['updatePSSuccess']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }   
					                if ($_SESSION['updatePSFailure'] != ""){
					                    echo "<div class='alert alert-danger alert-dismissable'>"
					                      .$_SESSION['updatePSFailure']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="add_printer" action="update_printer_leasd.php" method="post">
							        <div class="form-group">	
										<label for="printerMdlU" class="col-sm-4 control-label">Printer Model</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="printerMdlU" name="printerMdlU" placeholder="Enter Printer Model" value="<?php  echo $_SESSION['printerMdlU']; ?>"/>
											<?php
												if ($_SESSION['printerMdlErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerMdlErrorU']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
							        	<label for="printerIpU" class="col-sm-4 control-label">Printer IP Address</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control"id="printerIpU" name="printerIpU" placeholder="Enter Printer Name" value="<?php  echo $_SESSION['printerIpU']; ?>" />
											<?php
												if ($_SESSION['printerIpErrorUs'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['printerIpErrorU']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="printerLocU" class="col-sm-4 control-label">Printer Location</label>
										<div class="col-sm-8">
											<select class="form-control" id="printerLocU" name="printerLocU">
												<option <?php if ($_SESSION['printerLocU']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM sites";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['printerLocU']==$row['sitename'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['sitename'].'">'.$row['sitename'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['printerLocErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerLocErrorU']."</div>";
												}
												?>
											
										</div>
									</div>

									<div class="form-group">	
										<label for="printerFlrU" class="col-sm-4 control-label">Printer Floor</label>
										<div class="col-sm-8">
											<select class="form-control" id="printerFlrU" name="printerFlrU">
												<option <?php if ($_SESSION['printerFlrU']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM floors";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['printerFlrU']==$row['floorname'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['floorname'].'">'.$row['floorname'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['printerFlrErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerFlrErrorU']."</div>";
												}
												?>
											
										</div>

									</div>
									<div class="form-group">	
										<label for="printerSupU" class="col-sm-4 control-label">Printer Supplier</label>
										<div class="col-sm-8">
											<select class="form-control" id="printerSupU" name="printerSupU">
												<option <?php if ($_SESSION['printerSupU']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM printer_suppliers";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['printerSupU']==$row['supplier_name'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['supplier_name'].'">'.$row['supplier_name'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['printerSupErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerSupErrorU']."</div>";
												}
												?>
											
										</div>
									</div>
																				
									<button type="submit" class="btn btn-primary" name="updatePS" ><span class="glyphicon glyphicon-edit"></span>Update</button>
									<a href="printer_list_leasd.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-step-backward"></span>Back</a>
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