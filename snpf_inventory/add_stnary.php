<?php
    
  require "functions.php";
  require "header.php";
  require "connect.php";

  if (!loggedin()){
    header('Location: index.php');
  }

  $_SESSION['stnary_off'] = $_SESSION['user_name'];
?>
<body>
  <div id="container">
    <?php require "banner.php"; ?>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-primary">
            <div class="panel-heading">ADMINISTRATION : Stationary
              <a role="submit" class="btn btn-default" href="administration.php">Back</a>
            </div>
            <div class="panel-body">
              <div class='row-fluid'>
           	    <div class="col-sm-6 col-sm-offset-3">
			      <h2><center>ADD STATIONARY</center></h2>
			      <hr>
			      <?php
			    	if ($_SESSION['addSTNSuccess'] != ""){
					  echo "<div class='alert alert-success alert-dismissable'>"
					    .$_SESSION['addSTNSuccess']."<button type='button' class='close' 
						data-dismiss='alert'>&times;</button></div>";
			    	}
			    	if ($_SESSION['addSTNFailure'] != ""){
					  echo "<div class='alert alert-danger alert-dismissable'>"
						.$_SESSION['addSTNFailure']."<button type='button' class='close' 
						data-dismiss='alert'>&times;</button></div>";
			    	}
			      ?>
			    
				  <form class = "form-horizontal" role="form" id="login_form" action="add_stnary_proc.php" method="post">
					<div class="form-group">	
					  <label for="stnary_type" class="col-sm-4 control-label">Stationary Type</label>
					  <div class="col-sm-8">
					    <select class="form-control" id="stnary_type" name="stnary_type">
						  <option <?php if ($_SESSION['stnary_type']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
						  <?php
							// get operating system
							$sqlst = "SELECT DISTINCT * FROM stationary_type";				 
							$queryrun = mysql_query($sqlst);									
							while ($row = mysql_fetch_array($queryrun)){
						      // print opening option tag
							  echo '<option ';
							  						
							  // print selected
							  if ($_SESSION['stnary_type']==$row['type_name'])
							    echo "selected";
														
								// print closing option tag
								echo ' value="'.$row['type_name'].'">'.$row['type_name'].'</option>';
							  }
							  echo "</select>";

							  if ($_SESSION['stnary_typeErrorA'] != ""){
								echo "<div class='alert alert-danger'>".$_SESSION['stnary_typeErrorA']."</div>";
							  }
						  ?>
											
					  </div>
					</div>
					<div class="form-group">	
					  <label for="stnary_off" class="col-sm-4 control-label">Officer</label>
					  <div class="col-sm-8">
					    <select class="form-control" id="stnary_off" name="stnary_off">
						  <option <?php if ($_SESSION['stnary_off']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
						  <?php
							// get operating system
							$sqlst = "SELECT DISTINCT * FROM users";				 
							$queryrun = mysql_query($sqlst);									
							while ($row = mysql_fetch_array($queryrun)){
							 	$officer = $row['user_firstName'].' '.$row['user_lastName'];
						      // print opening option tag
							  echo '<option ';
							  						
							  // print selected
							  if ($_SESSION['stnary_off']==$row['user_name'])
							    echo "selected";
														
								// print closing option tag
								echo ' value="'.$row['user_name'].'">'.$officer.'</option>';
							  }
							  echo "</select>";

							  if ($_SESSION['stnary_offErrorA'] != ""){
								echo "<div class='alert alert-danger'>".$_SESSION['stnary_offErrorA']."</div>";
							  }
						  ?>
											
					  </div>
					</div>
					<div class="form-group">	
					  <label for="stnary_qnty" class="col-sm-4 control-label">Initial Quantity</label>
					  <div class="col-sm-8">
						<input type="text" class="form-control"	 id="stnary_qnty" name="stnary_qnty" 
					   	  placeholder="Enter Stationary quantity" value="<?php  echo $_SESSION['stnary_qnty']; ?>"/>
						  <?php
							if ($_SESSION['stnary_qntyErrorA'] != ""){
							  echo "<div class='alert alert-danger'>".$_SESSION['stnary_qntyErrorA']."</div>";
							}
						  ?>
					  </div>
					</div>
										
     				<button type="submit" class="btn btn-primary" name="addST" ><span class="glyphicon glyphicon-Save"></span>Add</button>
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
