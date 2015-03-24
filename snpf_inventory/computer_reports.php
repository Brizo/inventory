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
                    <div class="panel-heading">REPORTS : Computers
                        <a role="submit" class="btn btn-default" href="reports.php">Back</a>
                    </div>
                    <div class="panel-body">
                        <div class="row-fluid">
                            <div class="col-sm-12 col-sm-offset-0">
                                <div  class="col-sm-6 col-sm-offset-3">
                                    <h2><center>COMPUTERS</center></h2>
                                    <hr>
                                </div> 
                                
                               <?php
                                    if ($_SESSION['removeCSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['removeCSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                    if ($_SESSION['removeCFailure'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['removeCFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updateCSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['updateCSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updateCFailure'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['updateCFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                ?>
                                <div  class="col-sm-6 col-sm-offset-3">
                                    <table id="computer_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>LOCATION</th>
                                                <th>ACTION</th>
                                               
                                                <?php
                                                    if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                        echo '<th colspan="2">ACTION</th>';
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = 'SELECT DISTINCT u.user_location as location FROM users u
                                                    LEFT JOIN computers c on u.user_name = c.comp_user';
                                                $result = mysql_query($query) or die(mysql_error());
                                                            
                                                if (mysql_num_rows($result) == 0) {
                                                    echo "<div class='alert alert-danger alert-dismissable'>Currently No Computers
                                                        <button type='button' class='close' 
                                                            data-dismiss='alert'>&times;</button></div>";
                                                }else{
                                                    while ($row = mysql_fetch_array($result)){
                                                        echo "<tr>
                                                            <td>".$row['location']."</td>";
                                                            echo "<td><a role='button' class='btn btn-success' href='computer_location.php?id=".$row['location']."'>View Computers</a></td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>LOCATION</th>
                                                <th>ACTION</th>
                                               
                                                <?php
                                                    if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                        echo '<th colspan="2">ACTION</th>';
                                                    }
                                                ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#computer_table').dataTable();
                                        } );
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
