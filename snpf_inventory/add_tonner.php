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
                    <div class="panel-heading">ADMINISTRATION : Tonners
                    	<a role="submit" class="btn btn-default" href="administration.php">Back</a>
                    </div>
                    <div class="panel-body">
                        <div class='row-fluid'>
			    			<div class="col-sm-6 col-sm-offset-3">
			    				<h2><center>ADD TONNER</center></h2>
			    				<hr>
			    
			    				<?php
			    					if ($_SESSION['addTSuccess'] != ""){
										echo "<div class='alert alert-success alert-dismissable'>"
											.$_SESSION['addTSuccess']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    					if ($_SESSION['addTFailure'] != ""){
										echo "<div class='alert alert-danger alert-dismissable'>"
										.$_SESSION['addTFailure']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="login_form" action="add_tonner_proc.php" method="post">
							        <div class="form-group">	
							        	<label for="tSerielNo" class="col-sm-4 control-label">Tonner Seriel No</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control"	 id="tSerielNo" name="tSerielNo" 
								 				placeholder="Enter Tonner Seriel No" value="<?php  echo $_SESSION['tSerielNo']; ?>" />
											<?php
												if ($_SESSION['tSerielNoErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['tSerielNoErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="tModel" class="col-sm-4 control-label">Tonner Model</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="tModel" name="tModel" 
												placeholder="Enter Tonner Model" value="<?php  echo $_SESSION['tModel']; ?>"/>
											<?php
												if ($_SESSION['tModelErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['tModelErrorA']."</div>";
												}
											?>
										</div>
									</div>

									<div class="form-group">	
							        	<label for="tColor" class="col-sm-4 control-label">Tonner Color</label>
							    		<div class="col-sm-8">
								 			<select class="form-control" id="tColor" name="tColor" ?>" />
								 				<option <?php if ($_SESSION['tColor']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
								 				<option <?php if ($_SESSION['tColor']=="Cyan") {echo "selected";} ?> value="Cyan">Cyan</option>
								 				<option <?php if ($_SESSION['tColor']=="Yellow") {echo "selected";} ?> value="Yellow">Yellow</option>
								 				<option <?php if ($_SESSION['tColor']=="Margenta") {echo "selected";} ?> value="Margenta">Margenta</option>
								 				<option <?php if ($_SESSION['tColor']=="Black") {echo "selected";} ?> value="Black">Black</option>
								 			</select>
											<?php
												if ($_SESSION['tColorErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['tColorErrorA']."</div>";
												}
											?>
										</div>
									</div>

									<div class="form-group">	
										<label for="tPrinter" class="col-sm-4 control-label">Printer Model</label>
										<div class="col-sm-8">
											<select class="form-control" id="tPrinter" name="tPrinter">
												<option <?php if ($_SESSION['tPrinter']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM loc_printers";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['tPrinter']==$row['p_model'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['p_model'].'">'.$row['p_model'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['tPrinterErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['tPrinterErrorA']."</div>";
												}
												?>
											
										</div>
									</div>
									
									<div class="form-group">
										<label for="tDesc" class="col-sm-4 control-label">Tonner Description</label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="3" id="tDesc" name="tDesc" 
												placeholder="Enter Tonner Description" value="test"></textarea>
											<?php
												if ($_SESSION['tDescErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['tDescErrorA']."</div>";
												}
											?>
										</div>
									</div>
											
									<button type="submit" class="btn btn-primary" name="addT" ><span class="glyphicon glyphicon-Save"></span>Add</button>
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
