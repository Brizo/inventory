<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

     if (!loggedin()){
        header('Location: index.php');
    }

if (isset($_SESSION['idstationary'])) {
	$stnaryid=$_SESSION['idstationary'];
}
if (isset($_SESSION['referer'])) {
	$referer=$_SESSION['referer'];
}

if (isset($_POST['cancel'])){
	header('Location: '.$referer);
	exit();
}
if (isset($_POST['updateSTN'])) {

	$qnty_used = $_SESSION['qnty_usedU'];
	$date_modified = date('Y-n-j');
	$quantity = $_SESSION['quantity'];
	$action = $_POST['action'];
	$new_qnty = $_POST['qnty_updateU'];

	if ($new_qnty == null) {
		clearStnaryUpdateErrors();
		$_SESSION['qnty_updateErrorU'] = "Error ! Enter quantity";
	    header ('Location: update_stnary.php');
		exit();
	} else if ($action == '--select--') {
		clearStnaryUpdateErrors();
		$_SESSION['actionErrorU'] = "Error ! Select Action !";
	    header ('Location: update_stnary.php');
		exit();
	} else {
		if ($action == 'reduce') {
			$qnty_used = $qnty_used + $new_qnty;

			if ($qnty_used > $quantity) {
				$_SESSION ['updateSTNFailure'] = 'Update Not enough items, choose less';
				header('Location: update_stnary.php');
				exit();
			} else {
				$quantity = $quantity - $new_qnty;
				$orderlevel = $quantity - $qnty_used;
			}
			
		} else if($action == 'add') {
			$quantity = $quantity + $new_qnty;
			$orderlevel = $quantity - $qnty_used;
		}
		
		// update data in mysql database
		$query="UPDATE stationary SET quantity = $quantity, qnty_used='$qnty_used', order_level = '$orderlevel', date_modified = '$date_modified'
				WHERE idstationary='$stnaryid'";

		$result=mysql_query($query);

		if ($result){
			clearRespMsgs();
			clearStnaryUpdateErrors();
			clearStnaryUpdateFields();
			$_SESSION ['updateSTNSuccess'] = 'Stationary successfuly updated';	
			header('Location: stnary_list.php');
		}else{
			clearRespMsgs();
			clearStnaryUpdateErrors();
			clearStnaryUpdateFields();
			$_SESSION ['updateSTNFailure'] = 'Update Problem encountered';
			header('Location: stnary_list.php');
		}
	}
	
} 
//--------------------------------------------FORM----------------------------------------

//create session and store wireless ip address name
$_SESSION['idstationary'] = $_GET['id'];
$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

// Get wireless ip information
$query2 = "SELECT *  FROM stationary WHERE idstationary ='".$_SESSION['idstationary']."'";
$result2 = mysql_query($query2);


// Display ip information 
while ($row = mysql_fetch_assoc($result2)){
	extract($row);
	$_SESSION['quantity'] = $quantity;
	$_SESSION['stnary_typeU'] = $stnary_type;
	$_SESSION['qnty_usedU'] = $qnty_used;
}

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
			    				<h2><center>Update Stationary</center></h2>
			    				<hr>
			    
			    				<?php  
					                if ($_SESSION['updateSTNFailure'] != ""){
					                    echo "<div class='alert alert-danger alert-dismissable'>"
					                      .$_SESSION['updateSTNFailure']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="update_stnry" action="update_stnary.php" method="post">
							       	<div class="form-group">	
									  	<label for="stnary_typeU" class="col-sm-4 control-label"> Stationary Type </label>
									  	<div class="col-sm-8">
											<input type="text" class="form-control"	 id="stnary_typeU" name="stnary_typeU" 
									   	    value="<?php  echo $_SESSION['stnary_typeU']; ?>" DISABLED />
									  	</div>
									</div>

									<div class="form-group">	
									  	<label for="quantity" class="col-sm-4 control-label"> Current Balance </label>
									  	<div class="col-sm-8">
											<input type="text" class="form-control"	 id="quantity" name="quantity" 
									   	      value="<?php  echo $_SESSION['quantity']; ?>" DISABLED/>
									  	</div>
									</div>

									<div class="form-group">	
									  	<label for="qnty_updateU" class="col-sm-4 control-label"> Update Value </label>
									  	<div class="col-sm-8">
											<input type="text" class="form-control"	 id="qnty_updateU" name="qnty_updateU" 
									   	  placeholder="Enter Update quantity" value="<?php  echo $_SESSION['qnty_updateU']; ?>"/>
										  	<?php
												if ($_SESSION['qnty_updateErrorU'] != ""){
											  		echo "<div class='alert alert-danger'>".$_SESSION['qnty_updateErrorU']."</div>";
												}
										  	?>
									  	</div>
									</div>

									<div class="form-group">	
									    <label for="action" class="col-sm-4 control-label">Action</label>
									    <div class="col-sm-8">
										    <select class="form-control" id="action" name="action" ?>" />
									          	<option <?php if ($_SESSION['action']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
										    	<option <?php if ($_SESSION['action']=="reduce") {echo "selected";} ?> value="reduce">Reduce</option>
										    	<option <?php if ($_SESSION['action']=="add") {echo "selected";} ?> value="add">Add</option>
										    	
										  	</select>
											<?php
										  		if ($_SESSION['actionErrorU'] != ""){
										    		echo "<div class='alert alert-danger'>".$_SESSION['actionErrorU']."</div>";
										  		}
											?>
									  	</div>
									</div>
																				
									<button type="submit" class="btn btn-primary" name="updateSTN" ><span class="glyphicon glyphicon-edit"></span>Update</button>
									<a href="stnary_list.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-step-backward"></span>Back</a>
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