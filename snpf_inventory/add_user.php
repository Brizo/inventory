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
                    <div class="panel-heading">ADMINISTRATION : Users
                    	<a role="submit" class="btn btn-default" href="administration.php">Back</a>
                    </div>
                    <div class="panel-body">
                        <div class='row-fluid'>
			    			<div class="col-sm-6 col-sm-offset-3">
			    				<h2><center>ADD USER</center></h2>
			    				<hr>
			    
			    				<?php
			    					if ($_SESSION['addUSuccess'] != ""){
										echo "<div class='alert alert-success alert-dismissable'>"
											.$_SESSION['addUSuccess']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}
			    					if ($_SESSION['addUFailure'] != ""){
										echo "<div class='alert alert-danger alert-dismissable'>"
										.$_SESSION['addUFailure']."<button type='button' class='close' 
											data-dismiss='alert'>&times;</button></div>";
			    					}

			    				?>
			    
							    <form class = "form-horizontal" role="form" id="login_form" action="add_user_proc.php" method="post">
							        <div class="form-group">	
							        	<label for="userName" class="col-sm-4 control-label">User name</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control"	id="userName" name="userName" placeholder="Enter user name" value="<?php  echo $_SESSION['userName']; ?>" />
											<?php
												if ($_SESSION['userNameErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['userNameErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="firstName" class="col-sm-4 control-label">First Name</label>
										<div class="col-sM-8">
											<input type="text" class="form-control"	 id="firstName" name="firstName" placeholder="Enter First Name" value="<?php  echo $_SESSION['firstName']; ?>"/>
											<?php
												if ($_SESSION['firstNameErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['firstNameErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="lastName" class="col-sm-4 control-label">Last Name</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" value="<?php  echo $_SESSION['lastName']; ?>"/>
											<?php
												if ($_SESSION['lastNameErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['lastNameErrorA']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="user_officeNO" class="col-sm-4 control-label">Office No</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="officeNO" name="officeNo" placeholder="Enter Office No" value="<?php  echo $_SESSION['officeNo']; ?>"/>
											<?php
												if ($_SESSION['officeNoErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['officeNoErrorA']."</div>";
												}
											?>
										</div>
									</div>

									<div class="form-group">	
										<label for="udivision" class="col-sm-4 control-label">Division</label>
										<div class="col-sm-8">
											<select class="form-control" id="udivision" name="udivision">
												<option <?php if ($_SESSION['udivision']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM division";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['udivision']==$row['divname'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['divname'].'">'.$row['divname'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['udivisionErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['udivisionErrorA']."</div>";
												}
												?>
											
										</div>
									</div>

									<div class="form-group">	
										<label for="ulocation" class="col-sm-4 control-label">Location</label>
										<div class="col-sm-8">
											<select class="form-control" id="ulocation" name="ulocation">
												<option <?php if ($_SESSION['ulocation']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM sites";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['ulocation']==$row['sitename'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['sitename'].'">'.$row['sitename'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['ulocationErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['ulocationErrorA']."</div>";
												}
												?>
											
										</div>

									</div>

									<div class="form-group">	
										<label for="ufloor" class="col-sm-4 control-label">Floor</label>
										<div class="col-sm-8">
											<select class="form-control" id="ufloor" name="ufloor">
												<option <?php if ($_SESSION['ufloor']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM floors";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['ufloor']==$row['floorname'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['floorname'].'">'.$row['floorname'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['ufloorErrorA'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['ufloorErrorA']."</div>";
												}
												?>
											
										</div>

									</div>


									<div class="form-group">	
							        	<label for="uAccess" class="col-sm-4 control-label">Access Right</label>
							    		<div class="col-sm-8">
								 			<select class="form-control" id="uAccess" name="uAccess" ?>" />
								 				<option <?php if ($_SESSION['uAccess']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
								 				<option <?php if ($_SESSION['uAccess']=="admin") {echo "selected";} ?> value="admin">admin</option>
								 				<option <?php if ($_SESSION['uAccess']=="user") {echo "selected";} ?> value="user">user</option>
								 			</select>
											<?php
												if ($_SESSION['uAccessErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['uAccessErrorA']."</div>";
												}
											?>
										</div>
									</div>
											
									<button type="submit" class="btn btn-primary" name="addU" ><span class="glyphicon glyphicon-Save"></span>Add</button>
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
