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
            <div class="panel-heading">ADMINISTRATION : Computers
              <a role="submit" class="btn btn-default" href="administration.php">Back</a>
            </div>
            <div class="panel-body">
              <div class='row-fluid'>
           	    <div class="col-sm-6 col-sm-offset-3">
			      <h2><center>ADD COMPUTER</center></h2>
			      <hr>
			      <?php
			    	if ($_SESSION['addCSuccess'] != ""){
					  echo "<div class='alert alert-success alert-dismissable'>"
					    .$_SESSION['addCSuccess']."<button type='button' class='close' 
						data-dismiss='alert'>&times;</button></div>";
			    	}
			    	if ($_SESSION['addCFailure'] != ""){
					  echo "<div class='alert alert-danger alert-dismissable'>"
						.$_SESSION['addCFailure']."<button type='button' class='close' 
						data-dismiss='alert'>&times;</button></div>";
			    	}
			      ?>
			    
				  <form class = "form-horizontal" role="form" id="login_form" action="add_computer_proc.php" method="post">
				    <div class="form-group">	
				      <label for="compName" class="col-sm-4 control-label">Computer Name</label>
					  <div class="col-sm-8">
					    <input type="text" class="form-control"	id="compName" name="compName" 
					      placeholder="Enter Computer Name" value="<?php  echo $_SESSION['compName']; ?>" />
					    <?php
					      if ($_SESSION['compNameErrorA'] != ""){
						    echo "<div class='alert alert-danger'>".$_SESSION['compNameErrorA']."</div>";
						  }
					    ?>
					  </div>
					</div>

					<div class="form-group">	
					  <label for="compSno" class="col-sm-4 control-label">Comp Seriel No</label>
					  <div class="col-sm-8">
					    <input type="text" class="form-control"	 id="compSno" name="compSno" 
						  placeholder="Enter Seriel No" value="<?php  echo $_SESSION['compSno']; ?>"/>
						<?php
						  if ($_SESSION['compSnoErrorA'] != ""){
							echo "<div class='alert alert-danger'>".$_SESSION['compSnoErrorA']."</div>";
						  }
						?>
					  </div>
					</div>
									
					<div class="form-group">	
					  <label for="compType" class="col-sm-4 control-label">Computer type</label>
					  <div class="col-sm-8">
						<select class="form-control" id="compType" name="compType" ?>" />
					      <option <?php if ($_SESSION['compType']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
						  <option <?php if ($_SESSION['compType']=="Laptop") {echo "selected";} ?> value="Laptop">Laptop</option>
						  <option <?php if ($_SESSION['compType']=="Desktop") {echo "selected";} ?> value="Desktop">Desktop</option>
						</select>
						<?php
						  if ($_SESSION['compTypeErrorA'] != ""){
						    echo "<div class='alert alert-danger'>".$_SESSION['compTypeErrorA']."</div>";
						  }
						?>
					  </div>
					</div>
					
					<div class="form-group">	
					  <label for="compOs" class="col-sm-4 control-label">Operating System</label>
					  <div class="col-sm-8">
					    <select class="form-control" id="compOs" name="compOs">
						  <option <?php if ($_SESSION['compOs']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
						  <?php
							// get operating system
							$sqlst = "SELECT DISTINCT * FROM op_system";				 
							$queryrun = mysql_query($sqlst);									
							while ($row = mysql_fetch_array($queryrun)){
						      // print opening option tag
							  echo '<option ';
							  						
							  // print selected
							  if ($_SESSION['compOs']==$row['osname'])
							    echo "selected";
														
								// print closing option tag
								echo ' value="'.$row['osname'].'">'.$row['osname'].'</option>';
							  }
							  echo "</select>";

							  if ($_SESSION['compOsErrorA'] != ""){
								echo "<div class='alert alert-danger'>".$_SESSION['compOsErrorA']."</div>";
							  }
						  ?>
											
					  </div>
					</div>
					<div class="form-group">	
					  <label for="monType" class="col-sm-4 control-label">Monitor Type</label>
					  <div class="col-sm-8">
						<input type="text" class="form-control"	 id="monType" name="monType" 
					   	  placeholder="Enter Monitor Type" value="<?php  echo $_SESSION['monType']; ?>"/>
						  <?php
							if ($_SESSION['monTypeErrorA'] != ""){
							  echo "<div class='alert alert-danger'>".$_SESSION['monTypeErrorA']."</div>";
							}
						  ?>
					  </div>
					</div>

					<div class="form-group">	
					  <label for="monSerial" class="col-sm-4 control-label">Monitor Serial</label>
					  <div class="col-sm-8">
						<input type="text" class="form-control"	 id="monSerial" name="monSerial" 
					  	  placeholder="Enter Monitor Serial" value="<?php  echo $_SESSION['monSerial']; ?>"/>
						<?php
						  if ($_SESSION['monSerialErrorA'] != ""){
						    echo "<div class='alert alert-danger'>".$_SESSION['monSerialErrorA']."</div>";
						  }
						?>
					  </div>
					</div>
					<div class="form-group">	
					  <label for="compIp" class="col-sm-4 control-label">Comp IP address</label>
					  <div class="col-sm-8">
						<input type="text" class="form-control"	 id="compIp" name="compIp" 
					      placeholder="Enter IP Address" value="<?php  echo $_SESSION['compIp']; ?>"/>
						<?php
						  if ($_SESSION['compIpErrorA'] != ""){
						    echo "<div class='alert alert-danger'>".$_SESSION['compIpErrorA']."</div>";
						  }
						?>
					  </div>
					</div>
					<div class="form-group">	
					  <label for="compUser" class="col-sm-4 control-label">Comp User</label>
					  <div class="col-sm-8">
						<select class="form-control" id="compUser" name="compUser">
					  	  <option <?php if ($_SESSION['compUser']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
						  <?php
							// get users
							$sqlst = "SELECT DISTINCT * FROM users";				 
							$queryrun = mysql_query($sqlst);									
							while ($row = mysql_fetch_array($queryrun)){
						      // print opening option tag
							  echo '<option ';
													
							  // print selected
							  if ($_SESSION['compUser']==$row['user_name'])
							    echo "selected";
														
							  // print closing option tag
							  echo ' value="'.$row['user_name'].'">'.$row['user_firstName'].'-'.$row['user_lastName'].'</option>';
							}
						echo "</select>";

						if ($_SESSION['compUserErrorA'] != ""){
						  echo "<div class='alert alert-danger'>".$_SESSION['compUserErrorA']."</div>";
						}
					  ?>
											
					  </div>
					</div>
										
     				<button type="submit" class="btn btn-primary" name="addC" ><span class="glyphicon glyphicon-Save"></span>Add</button>
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
