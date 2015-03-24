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
                    <div class="panel-heading">ADMINISTRATION : Servers
                    	<a role="submit" class="btn btn-default" href="administration.php">Back</a>
                    </div>
                    <div class="panel-body">
                        <div class='row-fluid'>
			    			<div class="col-sm-6 col-sm-offset-3">
			    				<h2><center>ADD SERVER</center></h2>
			    				<hr>
			    
			    				<?php
			    					if ($_SESSION['addSSuccess'] != ""){
										echo "<div class='alert alert-success alert-dismissable'>"
											.$_SESSION['addSSuccess']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    					if ($_SESSION['addSFailure'] != ""){
										echo "<div class='alert alert-danger alert-dismissable'>"
										.$_SESSION['addSFailure']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="login_form" action="add_server_proc.php" method="post">
							        <div class="form-group">	
							        	<label for="serverName" class="col-sm-4 control-label">Server Name</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control" id="user_name" name="serverName" placeholder="Enter server name" value="<?php  echo $_SESSION['serverName']; ?>" />
											<?php
												if ($_SESSION['serverNameErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['serverNameErrorA']."</div>";
												}
											?>
										</div>
									</div>

									<div class="form-group">	
							        	<label for="serverSeriel" class="col-sm-4 control-label">Server Seriel No</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control" id="serverSeriel" name="serverSeriel" placeholder="Enter server Seriel" value="<?php  echo $_SESSION['serverSeriel']; ?>" />
											<?php
												if ($_SESSION['serverSerielErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['serverSerielErrorA']."</div>";
												}
											?>
										</div>
									</div>

									<div class="form-group">	
										<label for="serverOS" class="col-sm-4 control-label">Operating System</label>
										<div class="col-sm-8">
											<select class="form-control" id="serverOS" name="serverOS">
												<option <?php if ($_SESSION['serverOS']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM op_system";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['serverOS']==$row['osname'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['osname'].'">'.$row['osname'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['serverOSErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverOSErrorA']."</div>";
												}
												?>
											
										</div>
									</div>
									<div class="form-group">	
										<label for="serverHw" class="col-sm-4 control-label">Hardware</label>
										<div class="col-sM-8">
											<input type="text" class="form-control"	 id="serverHw" name="serverHw" placeholder="Enter Hardware" value="<?php  echo $_SESSION['serverHw']; ?>"/>
											<?php
												if ($_SESSION['serverHwErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverHwErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="serverIp" class="col-sm-4 control-label">IP Address</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="serverIp" name="serverIp" placeholder="Enter IP address" value="<?php  echo $_SESSION['serverIp']; ?>"/>
											<?php
												if ($_SESSION['serverIpErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverIpErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="serverHdd" class="col-sm-4 control-label">Harddrive</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="serverHdd" name="serverHdd" placeholder="Enter Hard drive" value="<?php  echo $_SESSION['serverHdd']; ?>"/>
											<?php
												if ($_SESSION['serverHddErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverHddErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="serverRam" class="col-sm-4 control-label">Ram</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="serverRam" name="serverRam" placeholder="Enter Ram" value="<?php  echo $_SESSION['serverRam']; ?>"/>
											<?php
												if ($_SESSION['serverRamErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverRamErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="serverDesc" class="col-sm-4 control-label">Purpose</label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="3" id="serverDesc" name="serverDesc" 
											placeholder="Enter Server Purpose" value="<?php  echo $_SESSION['serverDesc']; ?>"></textarea>
											<?php
												if ($_SESSION['serverDescErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverDescErrorA']."</div>";
												}
											?>
										</div>
									</div>
											
									<button type="submit" class="btn btn-primary" name="addS" ><span class="glyphicon glyphicon-Save"></span>Add</button>
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
