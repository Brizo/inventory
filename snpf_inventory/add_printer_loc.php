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
			    				<h2><center>ADD LOCAL PRINTER</center></h2>
			    				<hr>
			    
			    				<?php
			    					if ($_SESSION['addPSuccess'] != ""){
										echo "<div class='alert alert-success alert-dismissable'>"
											.$_SESSION['addPSuccess']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    					if ($_SESSION['addPFailure'] != ""){
										echo "<div class='alert alert-danger alert-dismissable'>"
										.$_SESSION['addPFailure']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="add_printer" action="add_printer_proc_loc.php" method="post">
							        <div class="form-group">	
							        	<label for="printerName" class="col-sm-4 control-label">Printer Name</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control"id="printerName" name="printerName" placeholder="Enter Printer Name" value="<?php  echo $_SESSION['printerName']; ?>" />
											<?php
												if ($_SESSION['printerNameErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['printerNameErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="printerModel" class="col-sm-4 control-label">Printer Model</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="printerModel" name="printerModel" placeholder="Enter Printer Model" value="<?php  echo $_SESSION['printerModel']; ?>"/>
											<?php
												if ($_SESSION['printerMdlErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerMdlErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="pSerielNo" class="col-sm-4 control-label">Printer Seriel No</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="pSerielNo" name="pSerielNo" placeholder="Enter Seriel No" value="<?php  echo $_SESSION['pSerielNo']; ?>"/>
											<?php
												if ($_SESSION['pSerielNoErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['pSerielNoErrorA']."</div>";
												}
											?>
										</div>
									</div>

									<div class="form-group">
										<label for="printerDesc" class="col-sm-4 control-label">Printer Description</label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="3" id="printerDesc" name="printerDesc" placeholder="Enter Printer Description" value="<?php  echo $_SESSION['printerDesc']; ?>"></textarea>
											<?php
												if ($_SESSION['printerDescErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['printerDescErrorA']."</div>";
												}
											?>
										</div>
									</div>
																				
									<button type="submit" class="btn btn-primary" name="addP" ><span class="glyphicon glyphicon-Save"></span>Add</button>
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
