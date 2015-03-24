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
          <div class="panel-heading">REPORTS : Stationary
            <a role="submit" class="btn btn-default" href="reports.php">Back</a>
          </div>
          <div class="panel-body">                
            <div class="row-fluid">
              <div class="col-sm-10 col-sm-offset-1">
                  <h2><center>SNPF STATIONARY</center></h2>
                  <hr> 
               
                <div style="margin: 10px auto; padding-left: 5px;">
                  <table id="users_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>STATIONARY TYPE</th>
                        <th>QUANTITY</th>
                        <th>USED</th>
                        <th>ORDER LEVEL</th>
                        <th>OFFICER</th>
                        <th>LAST MODIFIED</th>
                     
                      </tr>
                    </thead>
                    <tbody>
                          <?php
                           $query = 'SELECT * FROM stationary';
                            $result = mysql_query($query) or die(mysql_error());
                                                     
                            if (mysql_num_rows($result) == 0) {
                              echo'Currently no data<br /><br />';
                            }else{
                              while ($row = mysql_fetch_array($result)){
                                echo "<tr>
                                  <td>".$row['stnary_type']."</td>
                                  <td>".$row['quantity']."</td>
                                  <td>".$row['qnty_used']."</td>
                                  <td>".$row['order_level']."</td>
                                  <td>".$row['officer']."</td>
                                  <td>".$row['date_modified']."</td>
  			                        </tr>";
                              }
                            }
                          ?>
                    </tbody>
                    <tfoot>
                          <tr>
                            <th>STATIONARY TYPE</th>
                            <th>QUANTITY</th>
                            <th>USED</th>
                            <th>ORDER LEVEL</th>
                            <th>OFFICER</th>
                            <th>LAST MODIFIED</th>
                          </tr>
                    </tfoot>
                  </table>
                  <script type="text/javascript">
                    $(document).ready(function() {
                      $('#users_table').dataTable();
                    });
                  </script>             
                </div> <!-- end style div -->      
              </div><!-- close colum div -->
            </div> <!-- close row -->              
          </div> <!-- close panel-body -->
          <?php 
            include 'footer1.php';
          ?>
        </div> <!-- close panel -->
      </div> <!-- close column-->
    </div> <!-- end row1 -->
    <div class="row">
      <?php include "footer.php"; ?>
   </div> <!-- close row2 -->
  </div> <!-- close main container -->
</body>
</html>
