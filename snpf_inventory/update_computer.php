<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

     if (!loggedin()){
        header('Location: index.php');
    }
   
  clearRespMsgs(); 

if (isset($_SESSION['c_serial'])) {
	$c_serial=$_SESSION['c_serial'];
}
if (isset($_SESSION['referer'])) {
	$referer=$_SESSION['referer'];
}

if (isset($_POST['cancel'])){
	header('Location: '.$referer);
	exit();
}
if (isset($_POST['updateC'])) {

	$cname =  $_POST ['compNameU'];
	$ctype = $_POST ['compTypeU'];
	$cos = $_POST ['compOsU'];
	$cip = $_POST ['compIpU'];
	$cserial = $_SESSION['compSnoU'];
	$cmontype = $_SESSION['monTypeU'];
	$cmonserial = $_SESSION['monSerialU'];

	// update data in mysql database
	$query="UPDATE computers SET comp_name = '$cname',comp_type = '$ctype', comp_os = '$cos', 
		comp_ip='$cip', comp_monType = '$cmontype', comp_monSerial='$cmonserial'
			WHERE comp_sn='$c_serial'";

	$result=mysql_query($query);

	if ($result){
		clearRespMsgs();
		$_SESSION ['updateCSuccess'] = 'Computer successfuly updated';	
		header('Location: computer_list.php');	
	}else{
		clearRespMsgs();
		$_SESSION ['updateCFailure'] = 'Problem Encountered';	
		header('Location: computer_list.php');
	}
	
} 
//--------------------------------------------FORM----------------------------------------

//create session and store wireless ip address name
$_SESSION['c_serial'] = $_GET['id'];
$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

// Get wireless ip information
$query2 = "SELECT *  FROM computers WHERE comp_sn ='". $_SESSION['c_serial']."'";
$result2 = mysql_query($query2);


// Display ip information 
while ($row = mysql_fetch_assoc($result2)){
	extract($row);

	$_SESSION ['compNameU'] = $comp_name;
	$_SESSION ['compTypeU'] = $comp_type;
	$_SESSION ['compOsU'] = $comp_os;
	$_SESSION ['monTypeU'] =  $comp_monType;
	$_SESSION ['monSerialU'] = $comp_monSerial;
	$_SESSION ['compIpU'] = $comp_ip;

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
			    				<h2><center>Update Computer</center></h2>
			    				<hr>

			    				<?php
			    					
			    					if ($_SESSION['updateCSuccess'] != ""){
					                    echo "<div class='alert alert-success alert-dismissable'>"
					                      .$_SESSION['updateCSuccess']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }   
					                if ($_SESSION['updateCFailure'] != ""){
					                    echo "<div class='alert alert-danger alert-dismissable'>"
					                      .$_SESSION['updateCFailure']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="login_form" action="update_computer.php" method="post">
							        <div class="form-group">	
							        	<label for="compNameU" class="col-sm-4 control-label">Computer Name</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control"	id="compNameU" name="compNameU" 
								 			placeholder="Enter Computer Name" value="<?php  echo $_SESSION['compNameU']; ?>" />
										
										</div>
									</div>
									
									<div class="form-group">	
							        	<label for="compTypeU" class="col-sm-4 control-label">Computer type</label>
							    		<div class="col-sm-8">
								 			<select class="form-control" id="compTypeU" name="compTypeU" ?>" />
								 				<option <?php if ($_SESSION['compTypeU']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
								 				<option <?php if ($_SESSION['compTypeU']=="Laptop") {echo "selected";} ?> value="Laptop">Laptop</option>
								 				<option <?php if ($_SESSION['compTypeU']=="Desktop") {echo "selected";} ?> value="Desktop">Desktop</option>
								 			</select>
										
										</div>
									</div>
									<div class="form-group">	
										<label for="compOsU" class="col-sm-4 control-label">Operating System</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="compOsU" name="compOsU" 
												placeholder="Enter Computer OS" value="<?php  echo $_SESSION['compOsU']; ?>"/>
										
										</div>
									</div>

									<div class="form-group">	
										<label for="compIpU" class="col-sm-4 control-label">IP address</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="compIpU" name="compIpU" 
												placeholder="Enter IP Address" value="<?php  echo $_SESSION['compIpU']; ?>"/>
										
										</div>
									</div>

									<div class="form-group">	
									  <label for="monTypeU" class="col-sm-4 control-label">Monitor Type</label>
									  <div class="col-sm-8">
										<input type="text" class="form-control"	 id="monTypeU" name="monTypeU" 
									   	  placeholder="Enter Monitor Type" value="<?php  echo $_SESSION['monTypeU']; ?>"/>
									  </div>
									</div>

									<div class="form-group">	
									  <label for="monSerialU" class="col-sm-4 control-label">Monitor Serial</label>
									  <div class="col-sm-8">
										<input type="text" class="form-control"	 id="monSerialU" name="monSerialU" 
									  	  placeholder="Enter Monitor Serial" value="<?php  echo $_SESSION['monSerialU']; ?>"/>
									  </div>
									</div>
											
									<button type="submit" class="btn btn-primary" name="updateC" ><span class="glyphicon glyphicon-edit"></span>Update</button>
									<a href="computer_list.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-step-backward"></span>Back</a>
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