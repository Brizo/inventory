<?php

  include "functions.php";
  include "header.php";
  include "connect.php";

  if (!loggedin()){
    header('Location: index.php');
  }

  $referer = $_SERVER['HTTP_REFERER']; 
?>
<body>
  <div id="container">
    <?php include "banner.php"; ?>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-primary">
             <div class="panel-heading">
                <?php 
                  if (in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                    echo "ADMINISTRATION : Users";
                    echo '<a role="submit" class="btn btn-default" href="administration.php">Back</a>';
                  } else {
                    echo "Users";
                  }
                ?>
              </div>
            <div class="panel-body">
                <?php 
                  if (!in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                    echo '<div class="row-fluid">';
                      include "nav.php";
                    echo '</div>';
                  }
                ?>         
              <div class="row-fluid">
              <div class="col-sm-10 col-sm-offset-1">
                  <h2><center>SYSTEM USERS</center></h2>
                  <hr> 
                <?php
                  if ($_SESSION['removeUSuccess'] != ""){
                    echo "<div class='alert alert-success alert-dismissable'>"
                      .$_SESSION['removeUSuccess']."<button type='button' class='close' 
                      data-dismiss='alert'>&times;</button></div>";
                  }
                  if ($_SESSION['removeUFailure'] != ""){
                    echo "<div class='alert alert-danger alert-dismissable'>"
                      .$_SESSION['removeUFailure']."<button type='button' class='close' 
                      data-dismiss='alert'>&times;</button></div>";
                  }
                  if ($_SESSION['updateUSuccess'] != ""){
                    echo "<div class='alert alert-success alert-dismissable'>"
                      .$_SESSION['updateUSuccess']."<button type='button' class='close' 
                      data-dismiss='alert'>&times;</button></div>";
                  }
                  if ($_SESSION['updateUFailure'] != ""){
                    echo "<div class='alert alert-danger alert-dismissable'>"
                      .$_SESSION['updateUFailure']."<button type='button' class='close' 
                      data-dismiss='alert'>&times;</button></div>";
                  }
                ?>
                <div style="margin: 10px auto; padding-left: 5px;">
                  <table id="users_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>USER NAME</th>
                        <th>FIRST NAME</th>
                        <th>LAST NAME</th>
                        <th>OFFICE NO</th>
                        <?php
                          if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                            echo '<th>ACTION</th>';
                            echo '<th>ACTION</th>';
                          }
                        ?>	
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = 'SELECT * FROM users';
                      $result = mysql_query($query) or die(mysql_error());
                                                            
                      if (mysql_num_rows($result) == 0) {
                        echo "<div class='alert alert-danger alert-dismissable'>Currently No Users
                          <button type='button' class='close' 
                            data-dismiss='alert'>&times;</button></div>";
                      }else{
                        while ($row = mysql_fetch_array($result)){
                          echo "<tr>
                            
                            <td>".$row['user_name']."</td>
                            <td>".$row['user_firstName']."</td>
                            <td>".$row['user_lastName']."</td>
                            <td>".$row['user_officeNum']."</td>";
                            if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                              echo "<td><a role='button' class='btn btn-success' href='update_user.php?id=".$row['user_name']."'><span class='glyphicon glyphicon-edit'></span>Update</a></td>";
                              echo "<td><a role='button' class='btn btn-danger' href='remove_user.php?id=".$row['user_name']."'><span class='glyphicon glyphicon-trash'></span>Remove</a></td>";
                            }
                            echo "</tr>";
                          
                        } // end checking if users were found
                      }
                    ?>
                    </tbody>
                    <tfoot>
                      <th>USER NAME</th>
                      <th>FIRST NAME</th>
                      <th>LAST NAME</th>
                      <th>OFFICE NO</th>
                      <?php
                        if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                          echo '<th>ACTION</th>';
                          echo '<th>ACTION</th>';
                        }
                      ?>
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
        </div>
      </div>
    </div> <!-- end row1 -->
    <div class="row">
      <?php include "footer.php"; ?>
    </div> <!-- close row2 -->
  </div> <!-- close main container -->
</body>
</html>
