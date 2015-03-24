<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

     if (!loggedin()){
        header('Location: index.php');
    }  

if (isset($_SESSION['u_name'])) {
	$username=$_SESSION['u_name'];
}
if (isset($_SESSION['referer'])) {
	$referer=$_SESSION['referer'];
}

if (isset($_POST['cancel'])){
	header('Location: '.$referer);
	exit();
}
if (isset($_POST['updateU'])) {

	$uname =  $_POST ['userNameU'];
	$upass = $_POST ['userPassU2'];
	$upass2 = $_POST ['userPassU'];
	$ufirstname = $_POST ['firstNameU'];
	$ulastname = $_POST ['lastNameU'];
	$userofficeno = $_POST ['officeNoU'];
	$userlocation = $_POST ['ulocationU'];
	$userfloor = $_POST ['ufloorU'];
	$userdivision = $_POST ['udivisionU'];
	$useraccess = $_POST ['uAccessU'];

	if ($upass !== $upass2){
		clearRespMsgs();
		$_SESSION ['updateUFailure'] = 'Entered passwords do no match';
		unset($_POST['updateU']);
		header('Location: update_user.php');
		exit();
	} else {
			// update data in mysql database
		$query="UPDATE users SET user_name = '$uname',user_pass = '$upass', user_firstName = '$ufirstname',	
		 	user_lastName= '$ulastname', user_officeNum='$userofficeno', user_location = '$userlocation',
		 	user_division = '$userdivision', user_floor = '$userfloor', user_accessRight='$useraccess'
				WHERE user_name='".$_SESSION['u_name']."'";

		$result=mysql_query($query);

		if ($result){
			clearRespMsgs();
			$_SESSION ['updateUSuccess'] = 'User successfuly updated';	
			header('Location: user_list.php');	
		}else{
			clearRespMsgs();
			$_SESSION ['updateUFailure'] = 'Update Problem encountered';
			header('Location: user_list.php');
		}
	}

	
	
} 
//--------------------------------------------FORM----------------------------------------

//create session and store wireless ip address name
if (!isset($_SESSION['u_name'])) {
	$_SESSION['u_name'] = $_GET['id'];
	$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];	

	// Get wireless ip information
	$query2 = "SELECT *  FROM users WHERE user_name ='". $_SESSION['u_name']."'";
	$result2 = mysql_query($query2);

	// Display ip information 
	while ($row = mysql_fetch_assoc($result2)){
		extract($row);

		$_SESSION ['userNameU'] = $user_name;
		$_SESSION ['userPassU'] = $user_pass;
		$_SESSION ['firstNameU'] = $user_firstName;
		$_SESSION ['lastNameU'] = $user_lastName;
		$_SESSION ['officeNoU'] = $user_officeNum;
		$_SESSION ['ulocationU'] = $user_location;
		$_SESSION ['uAccessU'] = $user_accessRight;
		$_SESSION ['udivisionU'] = $user_division;
		$_SESSION ['ufloorU'] = $user_floor;
	}
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
			    				<h2><center>Update User</center></h2>
			    				<hr>
			    
			    				<?php
			    					
			    					if ($_SESSION['updateUSuccess'] != ""){
					                    echo "<div class='alert alert-success alert-dismissable'>"
					                      .$_SESSION['updateUSuccess']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }   
					                if ($_SESSION['updateUFailure'] != ""){
					                    echo "<div class='alert alert-danger alert-dismissable'>"
					                      .$_SESSION['updateUFailure']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="login_form" action="update_user.php" method="post">
							        <div class="form-group">	
							        	<label for="userNameU" class="col-sm-4 control-label">User name</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control"	id="userNameU" name="userNameU" placeholder="Enter user name" value="<?php  echo $_SESSION['userNameU']; ?>" />
											
										</div>
									</div>
									<div class="form-group">	
							        	<label for="userPassU" class="col-sm-4 control-label">User Password</label>
							    		<div class="col-sm-8">
								 			<input type="password" class="form-control"	id="userPassU" name="userPassU" placeholder="Enter user Pass" value="<?php  echo $_SESSION['userPassU']; ?>" />
											
										</div>
									</div>
									<div class="form-group">	
							        	<label for="userPassU2" class="col-sm-4 control-label">Confirm Password</label>
							    		<div class="col-sm-8">
								 			<input type="password" class="form-control"	id="userPassU2" name="userPassU2" placeholder="Enter confirmation Pass" value="<?php  echo $_SESSION['userPassU']; ?>" />
											
										</div>
									</div>
									<div class="form-group">	
										<label for="firstNameU" class="col-sm-4 control-label">First Name</label>
										<div class="col-sM-8">
											<input type="text" class="form-control"	 id="firstNameU" name="firstNameU" placeholder="Enter First Name" value="<?php  echo $_SESSION['firstNameU']; ?>"/>
										
										</div>
									</div>
									<div class="form-group">	
										<label for="lastNameU" class="col-sm-4 control-label">Last Name</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="lastNameU" name="lastNameU" placeholder="Enter Last Name" value="<?php  echo $_SESSION['lastNameU']; ?>"/>
										
										</div>
									</div>
									<div class="form-group">	
										<label for="officeNoU" class="col-sm-4 control-label">Office No</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="officeNoU" name="officeNoU" placeholder="Enter Office No" value="<?php  echo $_SESSION['officeNoU']; ?>"/>
											
										</div>
									</div>

									<div class="form-group">	
										<label for="udivisionU" class="col-sm-4 control-label">Division</label>
										<div class="col-sm-8">
											<select class="form-control" id="udivisionU" name="udivisionU">
												<option <?php if ($_SESSION['udivisionU']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM division";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['udivisionU']==$row['divname'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['divname'].'">'.$row['divname'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['udivisionErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['udivisionErrorU']."</div>";
												}
												?>
											
										</div>
									</div>

									<div class="form-group">	
										<label for="ulocationU" class="col-sm-4 control-label">Location</label>
										<div class="col-sm-8">
											<select class="form-control" id="ulocationU" name="ulocationU">
												<option <?php if ($_SESSION['ulocationU']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM sites";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['ulocationU']==$row['sitename'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['sitename'].'">'.$row['sitename'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['ulocationErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['ulocationErrorU']."</div>";
												}
												?>
											
										</div>

									</div>

									<div class="form-group">	
										<label for="ufloorU" class="col-sm-4 control-label">Floor</label>
										<div class="col-sm-8">
											<select class="form-control" id="ufloorU" name="ufloorU">
												<option <?php if ($_SESSION['ufloorU']=="-select-"){echo "selected";} ?> value="--select--">--select--</option>
												<?php
												// get operating system
												$sqlst = "SELECT DISTINCT * FROM floors";				 
												$queryrun = mysql_query($sqlst);									
												while ($row = mysql_fetch_array($queryrun)){
													// print opening option tag
													echo '<option ';
													
													// print selected
													if ($_SESSION['ufloorU']==$row['floorname'])
														echo "selected";
														
													// print closing option tag
													echo ' value="'.$row['floorname'].'">'.$row['floorname'].'</option>';
												}
											echo "</select>";

												if ($_SESSION['ufloorErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['ufloorErrorU']."</div>";
												}
												?>
											
										</div>

									</div>


									<div class="form-group">	
							        	<label for="uAccessU" class="col-sm-4 control-label">Access Right</label>
							    		<div class="col-sm-8">
								 			<select class="form-control" id="uAccessU" name="uAccessU" ?>" />
								 				<option <?php if ($_SESSION['uAccessU']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
								 				<option <?php if ($_SESSION['uAccessU']=="admin") {echo "selected";} ?> value="admin">admin</option>
								 				<option <?php if ($_SESSION['uAccessU']=="user") {echo "selected";} ?> value="user">user</option>
								 			</select>
											<?php
												if ($_SESSION['uAccessErrorU'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['uAccessErrorU']."</div>";
												}
											?>
										</div>
									</div>
											
									<button type="submit" class="btn btn-primary" name="updateU" ><span class="glyphicon glyphicon-edit"></span>Update</button>
									<a href="user_list.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-step-backward"></span>Back</a>
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