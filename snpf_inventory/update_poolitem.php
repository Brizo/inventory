<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

     if (!loggedin()){
        header('Location: index.php');
    }
    
clearRespMsgs();

if (isset($_SESSION['serialno'])) {
	$serialno=$_SESSION['serialno'];
}
if (isset($_SESSION['referer'])) {
	$referer=$_SESSION['referer'];
}

clearRespMsgs();

if (isset($_POST['cancel'])){
	header('Location: '.$referer);
	exit();
}
if (isset($_POST['updatePL'])) {

	$itemserialno = $_POST['itemserialU'];
	$itemtype = $_POST['itemtypeU'];
	$itembrand = $_POST['itembrandU'];
	$itemassetno = $_POST['itemassetnoU'];


	// update data in mysql database
	$query="UPDATE pool_items SET serialno = '$itemserialno',type = '$itemtype', brand = '$itembrand', assetno = '$itemassetno'
			WHERE serialno='$serialno'";

	$result=mysql_query($query);

	if ($result){
		clearRespMsgs();
		$_SESSION ['updatePLSuccess'] = 'Pool Item successfuly updated';	
		header('Location: pool_list.php');
	}else{
		clearRespMsgs();
		$_SESSION ['updatePLFailure'] = 'Update Problem encountered';
		header('Location: pool_list.php');
	}
	
} 
//--------------------------------------------FORM----------------------------------------

//create session and store wireless ip address name
$_SESSION['serialno'] = $_GET['id'];
$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

// Get wireless ip information
$query2 = "SELECT *  FROM pool_items WHERE serialno ='". $_SESSION['serialno']."'";
$result2 = mysql_query($query2);


// Display ip information 
while ($row = mysql_fetch_assoc($result2)){
	extract($row);

	$_SESSION['itemserialU'] =  $serialno;
	$_SESSION['itemtypeU'] = $type;
	$_SESSION['itembrandU'] = $brand;
	$_SESSION['itemassetnoU'] = $assetno;
}

?>
<body>
    <div id="container">
        <?php require "banner.php"; ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">ADMINISTRATION : Pool Items
                    	<a role="submit" class="btn btn-default" href="administration.php">Back</a>
                    </div>
                    <div class="panel-body">
                        <div class='row-fluid'>
			    			<div class="col-sm-6 col-sm-offset-3">
			    				<h2><center>Update Pool Item</center></h2>
			    				<hr>

			    				<?php
			    					
			    					if ($_SESSION['updatePLSuccess'] != ""){
					                    echo "<div class='alert alert-success alert-dismissable'>"
					                      .$_SESSION['updatePLSuccess']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }   
					                if ($_SESSION['updateUFailure'] != ""){
					                    echo "<div class='alert alert-danger alert-dismissable'>"
					                      .$_SESSION['updatePLFailure']."<button type='button' class='close' 
					                      data-dismiss='alert'>&times;</button></div>";
					                }
			    				?>
			    
							    <form class = "form-horizontal" role="form" id="update_form" action="update_poolitem.php" method="post">
							        <div class="form-group">	
							        	<label for="itemserialU" class="col-sm-4 control-label">Item Serial No</label>
							    		<div class="col-sm-8">
								 			<input type="text" class="form-control" id="itemserialU" name="itemserialU" placeholder="Enter item serial no" value="<?php  echo $_SESSION['itemserialU']; ?>" />
											<?php
												if ($_SESSION['itemserialUErrorU'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['itemserialUErrorU']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
							        	<label for="itemtypeU" class="col-sm-4 control-label">Item Type</label>
							    		<div class="col-sm-8">
								 			<select class="form-control" id="itemtypeU" name="itemtypeU" ?>" />
								 				<option <?php if ($_SESSION['itemtypeU']=="--select--"){echo "selected";} ?> value="--select--">--select--</option>
								 				<option <?php if ($_SESSION['itemtypeU']=="Computer") {echo "selected";} ?> value="Computer">Computer</option>
								 				<option <?php if ($_SESSION['itemtypeU']=="Server") {echo "selected";} ?> value="Server">Server</option>
								 				<option <?php if ($_SESSION['itemtypeU']=="Monitor") {echo "selected";} ?> value="Monitor">Monitor</option>
								 				<option <?php if ($_SESSION['itemtypeU']=="Key Board") {echo "selected";} ?> value="Key Board">Key Board</option>
								 				<option <?php if ($_SESSION['itemtypeU']=="Mouse") {echo "selected";} ?> value="Mouse">Mouse</option>
								 				<option <?php if ($_SESSION['itemtypeU']=="Printer") {echo "selected";} ?> value="Printer">Printer</option>
								 			</select>
											<?php
												if ($_SESSION['itemtypeErrorA'] != ""){
									  				echo "<div class='alert alert-danger'>".$_SESSION['itemtypeErrorA']."</div>";
												}
											?>
										</div>
									</div>

									<div class="form-group">	
										<label for="itembrandU" class="col-sm-4 control-label">Item Brand</label>
										<div class="col-sm-8">
											<input type="text" class="form-control"	 id="itembrandU" name="itembrandU" placeholder="Enter Item Brand" value="<?php  echo $_SESSION['itembrandU']; ?>"/>
											<?php
												if ($_SESSION['itembrandUErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['itembrandUErrorU']."</div>";
												}
											?>
										</div>
									</div>
									<div class="form-group">	
										<label for="itemassetnoU" class="col-sm-4 control-label">Asset No</label>
										<div class="col-sM-8">
											<input type="text" class="form-control"	 id="itemassetnoU" name="itemassetnoU" placeholder="Enter Hardware" value="<?php  echo $_SESSION['itemassetnoU']; ?>"/>
											<?php
												if ($_SESSION['itemassetnoErrorU'] != ""){
													echo "<div class='alert alert-danger'>".$_SESSION['itemassetnoErrorU']."</div>";
												}
											?>
										</div>
									</div>
									
											
									<button type="submit" class="btn btn-primary" name="updatePL" ><span class="glyphicon glyphicon-edit"></span>Update</button>
									<a href="pool_list.php" role="button" class="btn btn-success"><span class="glyphicon glyphicon-step-backward"></span>Back</a>
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