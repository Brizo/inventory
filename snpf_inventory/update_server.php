<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

     if (!loggedin()){
        header('Location: index.php');
    }
    
clearRespMsgs();

if (isset($_SESSION['s_serial'])) {
	$s_serial=$_SESSION['s_serial'];
}
if (isset($_SESSION['referer'])) {
	$referer=$_SESSION['referer'];
}

clearRespMsgs();

if (isset($_POST['cancel'])){
	header('Location: '.$referer);
	exit();
}
if (isset($_POST['updateS'])) {

	$name = $_POST['serverNameU'];
	$os = $_POST['serverOSU'];
	$hardware = $_POST['serverHwU'];
	$serial = $_POST['serverSerielU'];
	$ip = $_POST['serverIpU'];
	$hdrive = $_POST['serverHddU'];
	$ram = $_POST['serverRamU'];
	$desc = $_POST['serverDescU'];

	// update data in mysql database
	$query="UPDATE servers SET s_name = '$name',s_os = '$os', s_hardware = '$hardware', s_ip= '$ip', s_hdrive='$hdrive', s_ram='$ram',s_desc='$desc'
			WHERE s_serial='$serial'";

	$result=mysql_query($query);

	if ($result){
		clearRespMsgs();
		$_SESSION ['updateSuccess'] = 'Server successfuly updated';	
		header('Location: server_list.php');
	}else{
		clearRespMsgs();
		$_SESSION ['updateFailure'] = 'Update Problem encountered';
		header('Location: server_list.php');
	}
	
} 
//--------------------------------------------FORM----------------------------------------

//create session and store wireless ip address name
$_SESSION['s_serial'] = $_GET['id'];
$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

// Get wireless ip information
$query2 = "SELECT *  FROM servers WHERE s_serial ='". $_SESSION['s_serial']."'";
$result2 = mysql_query($query2);


// Display ip information 
while ($row = mysql_fetch_assoc($result2)){
	extract($row);

	$_SESSION['serverNameU'] =  $s_name;
	$_SESSION['serverOSU'] = $s_os;
	$_SESSION['serverHwU'] = $s_hardware;
	$_SESSION['serverSerielU'] = $s_serial;
	$_SESSION['serverIpU'] = $s_ip;
	$_SESSION['serverHddU'] = $s_hdrive;
	$_SESSION['serverRamU'] = $s_ram;
	$_SESSION['serverDescU'] = $s_desc;

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
			    				<h2><center>Update Server</center></h2>
			    				<hr>

			    				<?php
			    					
			    					if ($_SESSION['updateSSuccess'] != ""){
					                    echo "<div class='alert alert-success alert-dismissable'>"
					                      .$_SESSION['updateSSuccess']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }   
					                if ($_SESSION['updateSFailure'] != ""){
					                    echo "<div class='alert alert-danger alert-dismissable'>"
					                      .$_SESSION['updateSFailure']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="update_form" action="update_server.php" method="post">
							        <div class="form-group">	
							        	<label for="serverNameU" class="col-sm-4 control-label">Server Name</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control" id="user_nameU" name="serverNameU" placeholder="Enter server name" value="<?php  echo $_SESSION['serverNameU']; ?>" />
											<?php
												if ($_SESSION['serverNameErrorU'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['serverNameErrorU']."</div>";
												}
											?>
										</div>
									</div>

									<div class="form-group">	
							        	<label for="serverSerielU" class="col-sm-4 control-label">Server Seriel No</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control" id="serverSerielU" name="serverSerielU" placeholder="Enter server Seriel" value="<?php  echo $_SESSION['serverSerielU']; ?>" />
											<?php
												if ($_SESSION['serverSerielErrorU'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['serverSerielErrorU']."</div>";
												}
											?>
										</div>
									</div>

									<div class="form-group">	
										<label for="serverOSU" class="col-sm-4 control-label">Operating System</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="serverOSU" name="serverOSU" placeholder="Enter OS" value="<?php  echo $_SESSION['serverOSU']; ?>"/>
											<?php
												if ($_SESSION['serverOSErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverOSErrorU']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="serverHwU" class="col-sm-4 control-label">Hardware</label>
										<div class="col-sM-8">
											<input type="text" class="form-control"	 id="serverHwU" name="serverHwU" placeholder="Enter Hardware" value="<?php  echo $_SESSION['serverHwU']; ?>"/>
											<?php
												if ($_SESSION['serverHwErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverHwErrorU']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="serverIpU" class="col-sm-4 control-label">IP Address</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="serverIpU" name="serverIpU" placeholder="Enter IP address" value="<?php  echo $_SESSION['serverIpU']; ?>"/>
											<?php
												if ($_SESSION['serverIpErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverIpErrorU']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="serverHddU" class="col-sm-4 control-label">Harddrive</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="serverHdd" name="serverHddU" placeholder="Enter Hard drive" value="<?php  echo $_SESSION['serverHddU']; ?>"/>
											<?php
												if ($_SESSION['serverHddErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverHddErrorU']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="serverRamU" class="col-sm-4 control-label">Ram</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="serverRamU" name="serverRamU" placeholder="Enter Ram" value="<?php  echo $_SESSION['serverRamU']; ?>"/>
											<?php
												if ($_SESSION['serverRamErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverRamErrorU']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="serverDescU" class="col-sm-4 control-label">Purpose</label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="3" id="serverDescU" name="serverDescU" 
											placeholder="Enter Server Purpose" value="<?php  echo $_SESSION['serverDescU']; ?>"></textarea>
											<?php
												if ($_SESSION['serverDescErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['serverDescErrorU']."</div>";
												}
											?>
										</div>
									</div>
											
									<button type="submit" class="btn btn-primary" name="updateS" ><span class="glyphicon glyphicon-edit"></span>Update</button>
									<a href="server_list.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-step-backward"></span>Back</a>
							    </form>
			    			</div>
              			</div><!-- close row -->
                    </div> <!-- close panel-body -->
                    <?php 
                        include 'footer1.php';
                    ?>
                </div> <!-- close panel -->
            </div> <!-- close colum -->
        </div> <!-- end row1 -->
        <div class="row">
            <?php include "footer.php"; ?>
        </div> <!-- close row2 -->
    </div> <!-- close main container -->
</body>
</html>