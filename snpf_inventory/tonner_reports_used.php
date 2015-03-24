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
          <div class="panel-heading">REPORTS : Tonners
            <a role="submit" class="btn btn-default" href="reports.php">Back</a>
          </div>
          <div class="panel-body">              
            <div class="row-fluid">
              <div class="col-sm-10 col-sm-offset-1">
                <div class="col-sm-6 col-sm-offset-3">
                  <h2><center>USED TONNERS</center></h2>
                  <hr> 
                </div>
                <div style="margin: 10px auto; padding-left: 5px;">                 
                  <table id="tonner_report" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>SERIAL</th>
                      <th>TONNER</th>
                      <th>COLOR</th>
                      <th>PRINTER</th>
                      <th>USER</th>                                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query = 'SELECT u.user_name as user,u.user_firstName as name, u.user_lastName as surname, p.p_comp as comp, p.p_model as pmodel, t.t_serialno as serialn,t.t_model as tmodel, t.t_color as tcolor
                          FROM tonners t
                          LEFT JOIN loc_printers p ON t.t_assignedP = p.p_serialno
                          LEFT JOIN computers c ON p.p_comp = c.comp_sn
                          LEFT JOIN users u ON c.comp_user = u.user_name
                          WHERE t.t_status LIKE "assigned" AND p.p_comp NOT LIKE "none"';

                      $result = mysql_query($query) or die(mysql_error());
                      $order = 1;                                                           
                      if (mysql_num_rows($result) == 0) {
                        echo'Currently no tonners<br /><br />';
                      }else{
                        while ($row = mysql_fetch_array($result)){
                          $user = $row['name'].' '.$row['surname'];
                          echo "<tr>
                            <td>".$row['serialn']."</td>
                            <td>".$row['tmodel']."</td>
                            <td>".$row['tcolor']."</td>
                            <td>".$row['pmodel']."</td>
                            <td>".$user."</td>           
                            </tr>";
                        }
                      }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>SERIAL</th>
                      <th>TONNER</th>
                      <th>COLOR</th>
                      <th>PRINTER</th>
                      <th>USER</th>                              
                    </tr>
                  </tfoot>
                  </table>
                                      
                  <script type="text/javascript">
                    $(document).ready(function() {
                     $('#tonner_report').dataTable();
                    });
                  </script>

                </div><!-- close colum style -->
              </div> <!-- close column -->
	          </div> <!-- close row --> 
          </div> <!-- close panel body -->
          <?php 
            include 'footer1.php';
          ?>
        </div> <!-- close panel -->
      </div><!-- close colum -->
    </div> <!-- end row1 -->
    <div class="row">
      <?php include "footer.php"; ?>
    </div> <!-- close row2 -->
  </div> <!-- close main container -->
</body>
</html>
