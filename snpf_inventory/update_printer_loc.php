<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

     if (!loggedin()){
        header('Location: index.php');
    }
   
   clearRespMsgs(); 

if (isset($_SESSION['p_serial'])) {
	$s_serial=$_SESSION['p_serial'];
}
if (isset($_SESSION['referer'])) {
	$referer=$_SESSION['referer'];
}

$_SESSION ['updateSuccess'] = '';
$_SESSION ['updateFailure'] = '';

if (isset($_POST['cancel'])){
	header('Location: '.$referer);
	exit();
}
if (isset($_POST['updateP'])) {

	$name = $_POST['printerNameU'];
	$model = $_POST['printerModelU'];
	$user = $_POST['printerUserU'];
	$desc = $_POST['printerDescU'];
	$serial = $_SESSION['p_serial'];


	// update data in mysql database
	$query="UPDATE loc_printers SET p_name = '$name', p_model = '$model', p_user= '$user', 
		p_description='$desc'
			WHERE p_serialno='$serial'";

	$result=mysql_query($query);

	if ($result){
		clearRespMsgs();
		$_SESSION ['updatePSuccess'] = 'Printer successfuly updated';	
		header('Location: printer_list_loc.php');
	}else{
		clearRespMsgs();
		$_SESSION ['updatePFailure'] = 'Update Problem encountered';
		header('Location: printer_list_loc.php');
	}
	
} 
//--------------------------------------------FORM----------------------------------------

//create session and store wireless ip address name
$_SESSION['p_serial'] = $_GET['id'];
$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

// Get wireless ip information
$query2 = "SELECT *  FROM loc_printers WHERE p_serialno ='". $_SESSION['p_serial']."'";
$result2 = mysql_query($query2);


// Display ip information 
while ($row = mysql_fetch_assoc($result2)){
	extract($row);

	$_SESSION['printerModelU'] =  $p_model;
	$_SESSION['printerNameU'] = $p_name;
	$_SESSION['printerUserU'] = $p_user;
	$_SESSION['printerDescU'] = $p_description;

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
			    				<h2><center>Update Local Printer</center></h2>
			    				<hr>
			    
			    				<?php
			    					
			    					if ($_SESSION['updatePSuccess'] != ""){
					                    echo "<div class='alert alert-success alert-dismissable'>"
					                      .$_SESSION['updatePSuccess']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }   
					                if ($_SESSION['updatePFailure'] != ""){
					                    echo "<div class='alert alert-danger alert-dismissable'>"
					                      .$_SESSION['updatePFailure']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="add_printer" action="update_printer_loc.php" method="post">
							        <div class="form-group">	
							        	<label for="printerNameU" class="col-sm-4 control-label">Printer Name</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control" id="printerNameU" name="printerNameU" placeholder="Enter Printer Name" value="<?php  echo $_SESSION['printerNameU']; ?>" />
											
										</div>
									</div>
									<div class="form-group">	
										<label for="printerModelU" class="col-sm-4 control-label">Printer Model</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="printerModelU" name="printerModelU" placeholder="Enter Printer Model" value="<?php  echo $_SESSION['printerModelU']; ?>"/>
											
										</div>
									</div>

									<div class="form-group">
										<label for="printerDescU" class="col-sm-4 control-label">Printer Description</label>
										<div class="col-sm-8">
											<textarea class="form-control" rows="3" id="printerDescU" name="printerDescU" placeholder="Enter Printer Description" value="<?php  echo $_SESSION['printerDescU']; ?>"></textarea>
										
										</div>
									</div>
																				
									<button type="submit" class="btn btn-primary" name="updateP" ><span class="glyphicon glyphicon-edit"></span>Update</button>
									<a href="printer_list_loc.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-step-backward"></span>Back</a>
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