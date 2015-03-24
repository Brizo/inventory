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
                                echo "ADMINISTRATION : Local Printers";
                                echo '<a role="submit" class="btn btn-default" href="administration.php">Back</a>';
                            } else {
                                echo "Local Printers";
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
                                <h2><center>LOCAL PRINTERS</center></h2>
                                <hr> 
                               <?php
                                    if ($_SESSION['removePSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['removePSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                    if ($_SESSION['removePFailure'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['removePFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updatePSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['updatePSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updatePFailure'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['updatePFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                ?>
                                <div style="margin: 10px auto; padding-left: 5px;">
                                    <table id="printer_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S NO</th>
                                                <th>MODEL</th>
                                                <th>NAME</th>
                                                <th>COMP</th>
                                                <th>STATUS</th> 
                                                <?php
                                                    if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                        echo '<th>ACTION</th>';
                                                        echo '<th>ACTION</th>';
                                                        echo '<th>ACTION</th>';
                                                    }
                                                ?>   
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = 'SELECT * FROM loc_printers';
                                                $result = mysql_query($query) or die(mysql_error());
                                                            
                                                if (mysql_num_rows($result) != 0) {
                                                    while ($row = mysql_fetch_array($result)){
                                                        echo "<tr>
                                                            <td>".$row['p_serialno']."</td>
                                                            <td>".$row['p_model']."</td>
                                                            <td>".$row['p_name']."</td>
                                                            <td>".$row['p_comp']."</td>
                                                            <td>".$row['p_status']."</td>";
                                                            if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                                echo "<td><a role='button' class='btn btn-success' href='update_printer_loc.php?id=".$row['p_serialno']."'><span class='glyphicon glyphicon-edit'></span>Update</a></td>";
                                                                echo "<td><a role='button' class='btn btn-warning' href='assign_printer.php?id=".$row['p_serialno']."'><span class='glyphicon glyphicon-circle-arrow-right'></span>Assign</a></td>";
                                                                echo "<td><a role='button' class='btn btn-danger' href='remove_printer_loc.php?id=".$row['p_serialno']."'><span class='glyphicon glyphicon-trash'></span>Remove</a></td>";
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
                                                <th>NAME</th>
                                                <th>COMP</th>
                                                <th>STATUS</th>
                                                <?php
                                                    if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                        echo '<th>ACTION</th>';
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
