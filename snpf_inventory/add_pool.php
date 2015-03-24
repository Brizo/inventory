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
                    <div class="panel-heading">ADMINISTRATION : Pool
                    	<a role="submit" class="btn btn-default" href="administration.php">Back</a>
                    </div>
                    <div class="panel-body">
                        <div class='row-fluid'>
			    			<div class="col-sm-6 col-sm-offset-3">
                                <h2><center>ADD POOL</center></h2>
                                <hr> 
			    						    
			    				<?php
			    					if ($_SESSION['addPLSuccess'] != ""){
										echo "<div class='alert alert-success alert-dismissable'>"
											.$_SESSION['addPLSuccess']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    					if ($_SESSION['addPLFailure'] != ""){
										echo "<div class='alert alert-danger alert-dismissable'>"
										.$_SESSION['addPLFailure']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="login_form" action="add_pool_proc.php" method="post">
							        <div class="form-group">	
							        	<label for="itemserial" class="col-sm-4 control-label">Item Serial</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control"	 id="itemserial" name="itemserial" 
								 				placeholder="Enter Item Serial" value="<?php  echo $_SESSION['itemserial']; ?>" />
											<?php
												if ($_SESSION['itemserialErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['itemserialErrorA']."</div>";
												}
											?>
										</div>
									</div>
								

									<div class="form-group">	
							        	<label for="itemtype" class="col-sm-4 control-label">Item Type</label>
							    		<div class="col-sm-8">
								 			<select class="form-control" id="itemtype" name="itemtype" ?>" />
								 				<option <?php if ($_SESSION['itemtype']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
								 				<option <?php if ($_SESSION['itemtype']=="Computer") {echo "selected";} ?> value="Computer">Computer</option>
								 				<option <?php if ($_SESSION['itemtype']=="Server") {echo "selected";} ?> value="Server">Server</option>
								 				<option <?php if ($_SESSION['itemtype']=="Monitor") {echo "selected";} ?> value="Monitor">Monitor</option>
								 				<option <?php if ($_SESSION['itemtype']=="Key Board") {echo "selected";} ?> value="Key Board">Key Board</option>
								 				<option <?php if ($_SESSION['itemtype']=="Mouse") {echo "selected";} ?> value="Mouse">Mouse</option>
								 				<option <?php if ($_SESSION['itemtype']=="Printer") {echo "selected";} ?> value="Printer">Printer</option>
								 			</select>
											<?php
												if ($_SESSION['itemtypeErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['itemtypeErrorA']."</div>";
												}
											?>
										</div>
									</div>

									 <div class="form-group">	
							        	<label for="itembrand" class="col-sm-4 control-label">Item Brand</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control"	 id="itembrand" name="itembrand" 
								 				placeholder="Enter Item Brand Item" value="<?php  echo $_SESSION['itembrand']; ?>" />
											<?php
												if ($_SESSION['itembrandErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['itembrandErrorA']."</div>";
												}
											?>
										</div>
									</div>

									  <div class="form-group">	
							        	<label for="itemassetno" class="col-sm-4 control-label">Asset No</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control"	 id="itemassetno" name="itemassetno" 
								 				placeholder="Enter asset no" value="<?php  echo $_SESSION['itemassetno']; ?>" />
											<?php
												if ($_SESSION['itemassetnoErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['itemassetnoErrorA']."</div>";
												}
											?>
										</div>
									</div>
											
									<button type="submit" class="btn btn-primary" name="addPL" ><span class="glyphicon glyphicon-Save"></span>Add</button>
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
