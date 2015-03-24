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
                                echo "ADMINISTRATION : Leased Printers";
                                echo '<a role="submit" class="btn btn-default" href="administration.php">Back</a>';
                            } else {
                                echo "Leased Printers";
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
                                <h2><center>LEASED PRINTERS</center></h2>
                                <hr> 
                               
                                <?php
                                    if ($_SESSION['removePSSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['removePSSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                    if ($_SESSION['removePSFailure'] != ""){
                                        echo "<div class='alert alert-danger alert-dismissable'>"
                                            .$_SESSION['removePSFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updatePSSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['updatePSSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updatePSFailure'] != ""){
                                        echo "<div class='alert alert-danger alert-dismissable'>"
                                            .$_SESSION['updatePSFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                ?>
                                <div style="margin: 10px auto;">
                                    <table id="printer_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S NO</th>
                                                <th>MODEL</th>
                                                <th>IP</th>
                                                <th>LOCATION</th>
                                                <th>FLOOR</th> 
                                                <th>SUPPLIER</th>
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
                                                $query = 'SELECT * FROM leasd_printers';
                                                $result = mysql_query($query) or die(mysql_error());
                                                            
                                                if (mysql_num_rows($result) != 0) {
                                                    while ($row = mysql_fetch_array($result)){
                                                        echo "<tr>
                                                            <td>".$row['p_serial']."</td>
                                                            <td>".$row['p_model']."</td>
                                                            <td>".$row['p_ipaddr']."</td>
                                                            <td>".$row['p_location']."</td>
                                                            <td>".$row['p_floor']."</td>
                                                            <td>".$row['p_supplier']."</td>";
                                                            if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                                echo "<td><a role='button' class='btn btn-success' href='update_printer_leasd.php?id=".$row['p_serial']."'><span class='glyphicon glyphicon-edit'></span>Update</a></td>";
                                                                echo "<td><a role='button' class='btn btn-danger' href='remove_printer_leasd.php?id=".$row['p_serial']."'><span class='glyphicon glyphicon-trash'></span>Remove</a></td>";
                                                            }
                                                        echo "</tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S NO</th>
                                                <th>MODEL</th>
                                                <th>IP</th>
                                                <th>LOCATION</th>
                                                <th>FLOOR</th> 
                                                <th>SUPPLIER</th>
                                                <?php
                                                    if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                        echo '<th>ACTION</th>';
                                                        echo '<th>ACTION</th>';
                                                    }
                                                ?> 
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#printer_table').dataTable();
                                        } );
                                    </script>
                                    
                                </div> <!-- end style div -->      
                            </div><!-- close colum div -->
                        </div> <!-- close row -->
                        
                    </div> <!-- close panel-body -->
                    <?php 
                        include 'footer1.php';
                    ?>
                </div> <!-- panel ends -->
            </div> <!-- column ends -->
        </div> <!-- end row1 -->
        <div class="row">
            <?php include "footer.php"; ?>
        </div> <!-- close row2 -->
    </div> <!-- close main container -->

</body>
</html>
