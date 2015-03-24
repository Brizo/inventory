<?php
    
  require "functions.php";
  require "header.php";
  require "connect.php";

  if (!loggedin()){
    header('Location: index.php');
  }

  clearRespMsgs ();

  if (isset($_POST['cancel'])) {
    header('Location: server_list.php');
  }

  if (isset($_POST['remove'])) {
    
    //retrieve serial number from form and define query to delete it
    $query = "DELETE from servers WHERE s_serial = '".$_SESSION['serverSerielU']."'";

    // check if server was deleted and define messages accordingly
    if ($run = mysql_query($query)) {
      $_SESSION['removeSSuccess'] = "Server successfully removed";
      header('Location: server_list.php');                         
    } else {
      $_SESSION['removeSFailure'] = "Problem encountered";
      header('Location: server_list.php');
    }
  } // end else when remove is pressed
?>
<body>
  <div id="container">
    <?php require "banner.php"; ?>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">ADMINISTRATION : Servers
            <a role="submit" class="btn btn-default" href="administration.php">Back</a>
          </div> <!-- close panel heading-->
          <div class="panel-body"> 
            <div class='row-fluid'>
              <div class="col-sm-6 col-sm-offset-3">
                <h2><center>REMOVE SERVER</center></h2>
                <hr>

                <?php
                  $server_serial = $_GET['id'];
                  $referer = $_SERVER['HTTP_REFERER'];

                  $query2 = "SELECT *  FROM servers WHERE s_serial ='". $server_serial."'";
                  $result2 = mysql_query($query2);

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
               
                <div class="panel panel-success"> <!-- panel 2 starts -->
                  <div class="panel-heading">Are you sure?</div>
                  <div class="panel-body">
                    Server Name : <?php echo $_SESSION['serverNameU']; ?><br>
                    Server Serial : <?php echo $_SESSION['serverSerielU']; ?>
                  </div>
                
                  <div class="panel-footer">
                    <form action="remove_server.php" method="post">
                      <button type="submit" name="remove" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>Yes</button>
                      <button role="button" name="cancel" class="btn btn-success" <span class="glyphicon glyphicon-trash"></span>Cancel</button>
                      <input type="hidden" name="serial" value="<?php echo $_SESSION['serverSerielU']; ?>" />
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
