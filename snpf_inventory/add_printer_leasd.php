<?php
    
    require "functions.php";
    require "header.php";
    require "connect.php";

    if (!loggedin()){
		header('Location: index.php');
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
			    				<h2><center>ADD LEASED PRINTER</center></h2>
			    				<hr>
			    
			    				<?php
			    					if ($_SESSION['addPSSuccess'] != ""){
										echo "<div class='alert alert-success alert-dismissable'>"
											.$_SESSION['addPSSuccess']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    					if ($_SESSION['addPSFailure'] != ""){
										echo "<div class='alert alert-danger alert-dismissable'>"
										.$_SESSION['addPSFailure']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="add_printer" action="add_printer_proc_leasd.php" method="post">
							      
									<div class="form-group">	
										<label for="printerMdl" class="col-sm-4 control-label">Printer Model</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="printerMdl" name="printerMdl" placeholder="Enter Printer Model" value="<?php  echo $_SESSION['printerMdl']; ?>"/>
											<?php
												if ($_SESSION['printerMdlErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerMdlErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="printerSrl" class="col-sm-4 control-label">Printer Seriel No</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="printerSrl" name="printerSrl" placeholder="Enter Seriel No" value="<?php  echo $_SESSION['printerSrl']; ?>"/>
											<?php
												if ($_SESSION['printerSrlErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerSrlErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
							        	<label for="printerIp" class="col-sm-4 control-label">Printer IP Address</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control"id="printerIp" name="printerIp" placeholder="Enter Printer Name" value="<?php  echo $_SESSION['printerIp']; ?>" />
											<?php
												if ($_SESSION['printerIpErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['printerIpErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="printerLoc" class="col-sm-4 control-label">Printer Location</label>
										<div class="col-sm-8">
											<select class="form-control" id="printerLoc" name="printerLoc">
												<option <?php if ($_SESSION['printerLoc']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM sites";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['printerLoc']==$row['sitename'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['sitename'].'">'.$row['sitename'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['printerLocErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerLocErrorA']."</div>";
												}
												?>
											
										</div>
									</div>

									<div class="form-group">	
										<label for="printerFlr" class="col-sm-4 control-label">Printer Floor</label>
										<div class="col-sm-8">
											<select class="form-control" id="printerFlr" name="printerFlr">
												<option <?php if ($_SESSION['printerFlr']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM floors";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['printerFlr']==$row['floorname'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['floorname'].'">'.$row['floorname'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['printerFlrErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerFlrErrorA']."</div>";
												}
												?>
											
										</div>

									</div>
									<div class="form-group">	
										<label for="printerSup" class="col-sm-4 control-label">Printer Supplier</label>
										<div class="col-sm-8">
											<select class="form-control" id="printerSup" name="printerSup">
												<option <?php if ($_SESSION['printerSup']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM printer_suppliers";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['printerSup']==$row['supplier_name'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['supplier_name'].'">'.$row['supplier_name'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['printerSupErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerSupErrorA']."</div>";
												}
												?>
											
										</div>
									</div>
																				
									<button type="submit" class="btn btn-primary" name="addPS" ><span class="glyphicon glyphicon-Save"></span>Add</button>
									<button type="submit" class="btn btn-warning" name="clear" ><span class="glyphicon glyphicon-refresh"></span>Clear</button>
									<a href="administration.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-step-backward"></span>Back</a>
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
