<?php
    
  require "functions.php";
  require "header.php";
  require "connect.php";

  if (!loggedin()){
    header('Location: index.php');
  }

  if (isset($_POST['cancel'])) {
    clearRespMsgs ();
    header('Location: computer_list.php');
  }

  if (isset($_POST['remove'])) {
    
    //retrieve serial number from form and define query to delete it
    $query = "DELETE from computers WHERE comp_sn = '".$_SESSION['comp_snU']."'";

    // check if server was deleted and define messages accordingly
    if ($run = mysql_query($query)) {
      clearRespMsgs();
      $_SESSION['removeCSuccess'] = "Computer successfully removed";
      header('Location: computer_list.php');                        
    } else {
      clearRespMsgs();
      $_SESSION['removeCFailure'] = "Problem encountered";
      header('Location: computer_list.php');
    }
  } // end else when remove is pressed
?>
<body>
  <div id="container">
    <?php require "banner.php"; ?>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">ADMINISTRATION : Computers
            <a role="submit" class="btn btn-default" href="administration.php">Back</a>
          </div> <!-- close panel heading-->
          <div class="panel-body"> 
            <div class='row-fluid'>
              <div class="col-sm-6 col-sm-offset-3">
                <h2><center>REMOVE COMPUTER</center></h2>
                <hr>

                <?php
                  $comp_serial = $_GET['id'];
                  $referer = $_SERVER['HTTP_REFERER'];

                  $query2 = "SELECT *  FROM computers WHERE comp_sn ='". $comp_serial."'";
                  $result2 = mysql_query($query2);

                  while ($row = mysql_fetch_assoc($result2)){
                    extract($row);
                    $_SESSION['comp_snU'] =  $comp_sn;
                    $_SESSION['comp_nameU'] = $comp_name;
                    $_SESSION['comp_typeU'] = $comp_type;
                  }
                ?>
               
                <div class="panel panel-success"> <!-- panel 2 starts -->
                  <div class="panel-heading">Are you sure?</div>
                  <div class="panel-body">
                    Computer Serial : <?php echo $_SESSION['comp_snU']; ?><br>
                    Computer Name : <?php echo $_SESSION['comp_nameU']; ?><br >
                    Computer Type : <?php echo $_SESSION['comp_typeU']; ?>
                  </div>
                
                  <div class="panel-footer">
                    <form action="remove_computer.php" method="post">
                      <button type="submit" name="remove" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>Yes</button>
                      <button role="button" name="cancel" class="btn btn-success" <span class="glyphicon glyphicon-trash"></span>Cancel</button>
                      <input type="hidden" name="serial" value="<?php echo $_SESSION['comp_snU']; ?>" />
                    </form>
                  </div>
                </div><!-- end panel 2 -->

              </div> <!-- close column -->
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
