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
            <div class="panel-heading">ADMINISTRATION : Stationary
              <a role="submit" class="btn btn-default" href="administration.php">Back</a>
            </div>
            <div class="panel-body">
              <div class='row-fluid'>
           	    <div class="col-sm-6 col-sm-offset-3">
			      <h2><center>ADD STATIONARY TYPE</center></h2>
			      <hr>
			      <?php
			    	if ($_SESSION['addSTPSuccess'] != ""){
					  echo "<div class='alert alert-success alert-dismissable'>"
					    .$_SESSION['addSTPSuccess']."<button type='button' class='close' 
						data-dismiss='alert'>&times;</button></div>";
			    	}
			    	if ($_SESSION['addSTPFailure'] != ""){
					  echo "<div class='alert alert-danger alert-dismissable'>"
						.$_SESSION['addSTPFailure']."<button type='button' class='close' 
						data-dismiss='alert'>&times;</button></div>";
			    	}
			      ?>
			    
				  <form class = "form-horizontal" role="form" id="login_form" action="add_stnary_type_proc.php" method="post">
					
					<div class="form-group">	
					  <label for="typeName" class="col-sm-4 control-label"> Stationary Type Name </label>
					  <div class="col-sm-8">
						<input type="text" class="form-control"	 id="typeName" name="typeName" 
					   	  placeholder="Enter Stationary Type Name" value="<?php  echo $_SESSION['typeName']; ?>"/>
						  <?php
							if ($_SESSION['typeNameErrorA'] != ""){
							  echo "<div class='alert alert-danger'>".$_SESSION['typeNameErrorA']."</div>";
							}
						  ?>
					  </div>
					</div>
					<div class="form-group">	
						<label for="typeDesc" class="col-sm-4 control-label"> Type Description </label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="3" id="typeDesc" name="typeDesc" 
						    	placeholder="Enter Stationary Type Description" value="<?php  echo $_SESSION['typeDesc']; ?>"></textarea>
								<?php
									if ($_SESSION['typeDescErrorA'] != ""){
										echo "<div class='alert alert-danger'>".$_SESSION['typeDescErrorA']."</div>";
									}
								?>
						</div>
					</div>
										
     				<button type="submit" class="btn btn-primary" name="addSTP" ><span class="glyphicon glyphicon-Save"></span>Add</button>
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
