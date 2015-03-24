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
                  <h2><center>TONNER ORDER LEVELS</center></h2>
                  <hr> 
                </div>
                <div style="margin: 10px auto; padding-left: 5px;">                 
                  <table id="tonner_report" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                    <th>TONNER</th>
                    <th>COLOR</th>
                    <th>REQUIRED</th>
                    <th>USED</th>
                    <th>POOL</th>
                    <th>ORDER LEVEL</th>                                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    /*
                       LEFT JOIN (SELECT COUNT(t_model) as used FROM tonners WHERE t_status like '%assigned') u
                            ON u.t_model = t.t_model
                          LEFT JOIN loc_printers p ON t.t_assignedP = p.p_serialno
                    */
                      $query = 'SELECT  t.t_model as tmodel,
                                        t.t_color as tcolor,
                                        p.p_model,
                                        COUNT(t.t_model) AS required,
                                        COUNT(CASE WHEN t.t_status like "%assigned%" THEN 1 END) AS used,
                                        COUNT(CASE WHEN t.t_status like "%pool%" THEN 1 END) AS pool
                                      FROM tonners t
                                      LEFT JOIN loc_printers p ON t.t_printerM = p.p_model
                                      WHERE p.p_status like "%assigned%"                       
                                      GROUP BY t_model, t_color';

                      $result = mysql_query($query) or die(mysql_error());
                      $order = 1;                                                           
                      if (mysql_num_rows($result) == 0) {
                        echo'Currently no tonners<br /><br />';
                      }else{
                        while ($row = mysql_fetch_array($result)){
                          $order_level = $row['required'] - ($row['pool']);
                          echo "<tr>
                            <td>".$row['tmodel']."</td>
                            <td>".$row['tcolor']."</td>
                            <td>".$row['required']."</td>
                            <td>".$row['used']."</td>
                            <td>".$row['pool']."</td>
                            <td>".$order_level."</td>           
                            </tr>";
                        }
                      }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                    <th>TONNER</th>
                    <th>COLOR</th>
                    <th>REQUIRED</th>
                    <th>USED</th>
                     <th>POOL</th>
                    <th>ORDER LEVEL</th>                             
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
