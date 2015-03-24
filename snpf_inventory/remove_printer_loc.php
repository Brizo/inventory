<?php
    
  require "functions.php";
  require "header.php";
  require "connect.php";

  if (!loggedin()){
    header('Location: index.php');
  }

  clearRespMsgs ();

  if (isset($_POST['cancel'])) {
    header('Location: printer_list_loc.php');
  }

  if (isset($_POST['remove'])) {
    
    //retrieve serial number from form and define query to delete it
    $query = "DELETE from loc_printers WHERE p_serialno = '".$_SESSION['p_serialnoU']."'";

    // check if server was deleted and define messages accordingly
    if ($run = mysql_query($query)) {
      clearRespMsgs();
      $_SESSION['removePSuccess'] = "Printer successfully removed";
      header('Location: printer_list_loc.php');                         
    } else {
      clearRespMsgs();
      $_SESSION['removePFailure'] = "Problem encountered";
      header('Location: printer_list_loc.php');
    }
  } // end else when remove is pressed
?>
<body>
  <div id="container">
    <?php require "banner.php"; ?>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">ADMINISTRATION : Printers
            <a role="submit" class="btn btn-default" href="administration.php">Back</a>
          </div> <!-- close panel heading-->
          <div class="panel-body"> 
            <div class='row-fluid'>
              <div class="col-sm-6 col-sm-offset-3">
                <h2><center>REMOVE LEASED PRINTER</center></h2>
                <hr>

                <?php
                  $printer_serial = $_GET['id'];
                  $referer = $_SERVER['HTTP_REFERER'];

                  $query2 = "SELECT *  FROM loc_printers WHERE p_serialno ='". $printer_serial."'";
                  $result2 = mysql_query($query2);

                  while ($row = mysql_fetch_assoc($result2)){
                    extract($row);
                    $_SESSION['p_serialnoU'] =  $p_serialno;
                    $_SESSION['p_modelU'] = $p_model;
                    $_SESSION['p_nameU'] = $p_name;
                    $_SESSION['p_userU'] = $p_user;
                    $_SESSION['p_statusU'] = $p_status;
                  }
                ?>
               
                <div class="panel panel-success"> <!-- panel 2 starts -->
                  <div class="panel-heading">Are you sure?</div>
                  <div class="panel-body">
                    Printer Serial No : <?php echo $_SESSION['p_serialnoU']; ?><br>
                    Printer Name : <?php echo $_SESSION['p_nameU']; ?><br>
                    Printer Model : <?php echo $_SESSION['p_modelU']; ?>
                  </div>
                
                  <div class="panel-footer">
                    <form action="remove_printer_loc.php" method="post">
                      <button type="submit" name="remove" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>Yes</button>
                      <button role="button" name="cancel" class="btn btn-success"> <span class="glyphicon glyphicon-trash"></span>Cancel</button>
                      <input type="hidden" name="serial" value="<?php echo $_SESSION['p_serialnoU']; ?>" />
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
