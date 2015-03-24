<?php
    
  require "functions.php";
  require "header.php";
  require "connect.php";

  if (!loggedin()){
    header('Location: index.php');
  }

  clearRespMsgs ();
  
  if (isset($_POST['cancel'])) {
    clearRespMsgs ();
    header('Location: tonner_list.php');
  }

  if (isset($_POST['remove'])) {
    
    //define query to delete it
    $query = "DELETE from tonners WHERE t_serialno = '".$_SESSION['t_serialnoR']."'";

    // check if server was deleted and define messages accordingly
    if ($run = mysql_query($query)) {
      $_SESSION['removeTSuccess'] = "Server successfully removed";
      header('Location: tonner_list.php');                        
    } else {
      $_SESSION['removeTFailure'] = "Problem encountered";
      header('Location: tonner_list.php');
    }
  } // end else when remove is pressed
?>
<body>
  <div id="container">
    <?php require "banner.php"; ?>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">ADMINISTRATION : Tonners
            <a role="submit" class="btn btn-default" href="administration.php">Back</a>
          </div> <!-- close panel heading-->
          <div class="panel-body"> 
            <div class='row-fluid'>
              <div class="col-sm-6 col-sm-offset-3">
                <h2><center>REMOVE TONNER</center></h2>
                <hr>

                <?php
                  $tonner_serial = $_GET['id'];
                  $referer = $_SERVER['HTTP_REFERER'];

                  $query2 = "SELECT *  FROM tonners WHERE t_serialno ='". $tonner_serial."'";
                  $result2 = mysql_query($query2);

                  while ($row = mysql_fetch_assoc($result2)){
                    extract($row);
                    $_SESSION['t_serialnoR'] =  $t_serialno;
                    $_SESSION['t_modelR'] = $t_model;
                    $_SESSION['t_colorR'] = $t_color;
                    
                  }
                ?>
               
                <div class="panel panel-success"> <!-- panel 2 starts -->
                  <div class="panel-heading">Are you sure?</div>
                  <div class="panel-body">
                    Tonner Serial No : <?php echo $_SESSION['t_serialnoR']; ?><br>
                    Tonner Model : <?php echo $_SESSION['t_modelR']; ?><br>
                    Tonner Color : <?php echo $_SESSION['t_colorR']; ?>
                  </div>
                
                  <div class="panel-footer">
                    <form action="remove_tonner.php" method="post">
                      <button type="submit" name="remove" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>Yes</button>
                      <button role="button" name="cancel" class="btn btn-success" <span class="glyphicon glyphicon-trash"></span>Cancel</button>
                      <input type="hidden" name="serial" value="<?php echo $_SESSION['t_serialnoU']; ?>" />
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
