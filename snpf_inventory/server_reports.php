<?php
  include "functions.php";
  include "header.php";
  include "connect.php";

  if (!loggedin()){
    header('Location: index.php');
  }  
?>
<body>
  <div id="container">
    <?php include "banner.php"; ?>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
          <div class="panel-heading">REPORTS : Servers
            <a role="submit" class="btn btn-default" href="reports.php"><span class="glyphicon glyphicon-list-alt"></span>Reports</a>
          </div>
          <div class="panel-body">               
            <div class="row-fluid">
              <div class="col-sm-10 col-sm-offset-1">
                <h2><center>SERVERS</center></h2>
                <hr>
                <div style="margin: 10px auto; padding-left: 5px;">                     
                  <p>SERVER REPORTS</p>                    
                </div> <!-- end style div -->      
              </div><!-- close colum div -->
            </div> <!-- close row -->		              
          </div> <!-- close panel-body -->
          <?php 
            include 'footer1.php';
          ?>
        </div> <!-- close panel -->
      </div> <!-- close colum div -->
    </div> <!-- end row1 -->
    <div class="row">
      <?php include "footer.php"; ?>
    </div> <!-- close row2 -->
  </div> <!-- close main container -->
</body>
</html>
