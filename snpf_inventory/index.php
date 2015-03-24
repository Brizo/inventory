<?php
  include "functions.php";
  include "header.php";
?>    
  <body>
    <div id="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <center class="page-header text-success"><h1>SNPF INVENTORY</h1></center>
          <h2>Member Login  | </h2>
          <?php
            if ($_SESSION['invalidCred'] != ""){
              echo "<div class='alert alert-danger alert-dismissable'>"
                .$_SESSION['invalidCred']."<button type='button' class='close' 
                data-dismiss='alert'>&times;</button></div>";
            }
          ?>
          <form name="login" class="form-inline" method="post" action="login_proc.php">
            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon glyphicon glyphicon-user"></span>
              <input type="email" name="user_name" id="user_name"  class="form-control" placeholder="Username" required>
            </div>         
            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon glyphicon glyphicon-lock"></span>
              <input type="password" name="user_pass" id="user_pass" class="form-control" placeholder="Password" required>
            </div> <br>
            <div style="margin-bottom: 25px" class="input-group">
              <button value="Login"  type="submit" name="submit" id="submit" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Sign in</button>
            </div>
          </form>           
             
          <div class="alert alert-info">
            <strong>Hello!</strong> Welcome to the SNPF Inventory System!
          </div>
        </div> <!-- END COLUMN -->
      </div> <!-- END ROW -->
    </div> <!-- END CONTAINER -->
  </body>
</html>  