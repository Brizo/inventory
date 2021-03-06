<?php
    
  require "functions.php";
  require "header.php";
  require "connect.php";

  if (!loggedin()){
    header('Location: index.php');
  }

  clearRespMsgs ();

  if (isset($_POST['cancel'])) {
    header('Location: printer_list_leasd.php');
  }

  if (isset($_POST['remove'])) {
    
    //retrieve serial number from form and define query to delete it
    $query = "DELETE from leasd_printers WHERE p_serial = '".$_SESSION['p_serialD']."'";

    // check if server was deleted and define messages accordingly
    if ($run = mysql_query($query)) {
      clearRespMsgs();
      $_SESSION['removePSSuccess'] = "Printer successfully removed";
      header('Location: printer_list_leasd.php');                         
    } else {
      clearRespMsgs();
      $_SESSION['removePSFailure'] = "Problem encountered";
      header('Location: printer_list_leasd.php');
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

                  $query2 = "SELECT *  FROM leasd_printers WHERE p_serial ='". $printer_serial."'";
                  $result2 = mysql_query($query2);

                  while ($row = mysql_fetch_assoc($result2)){
                    extract($row);
                    $_SESSION['p_serialD'] =  $p_serial;
                    $_SESSION['p_modelD'] = $p_model;
                    $_SESSION['p_ipaddrD'] = $p_ipaddr;
                    $_SESSION['p_locationD'] = $p_location;
                    $_SESSION['p_supplierD'] = $p_supplier;
                  }
                ?>
               
                <div class="panel panel-success"> <!-- panel 2 starts -->
                  <div class="panel-heading">Are you sure?</div>
                  <div class="panel-body">
                    Printer Serial No : <?php echo $_SESSION['p_serialD']; ?><br>
                    Printer Model : <?php echo $_SESSION['p_modelD']; ?><br>
                    Printer IP : <?php echo $_SESSION['p_ipaddrD']; ?>
                  </div>
                
                  <div class="panel-footer">
                    <form action="remove_printer_leasd.php" method="post">
                      <button type="submit" name="remove" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>Yes</button>
                      <button role="button" name="cancel" class="btn btn-success"> <span class="glyphicon glyphicon-trash"></span>Cancel</button>
                      <input type="hidden" name="serial" value="<?php echo $_SESSION['p_serialD']; ?>" />
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
