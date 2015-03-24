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
                                echo "ADMINISTRATION : Tonners";
                                echo '<a role="submit" class="btn btn-default" href="administration.php">Back</a>';
                            } else {
                                echo "Tonners";
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
                                <h2><center>TONNERS</center></h2>
                                <hr> 

                                <?php
                                    if ($_SESSION['removeTSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['removeTSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                    if ($_SESSION['removeTFailure'] != ""){
                                        echo "<div class='alert alert-danger alert-dismissable'>"
                                            .$_SESSION['removeTFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updateTSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['updateTSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updateTFailure'] != ""){
                                        echo "<div class='alert alert-danger alert-dismissable'>"
                                            .$_SESSION['updateTFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                ?>
                                
                                <div style="margin: 10px auto; padding-left: 5px;">
                                    <table id="tonner_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S NO</th>
                                                <th>MODEL</th>
                                                <th>COLOR</th>
                                                <th>DATE IN</th>
                                                <th>STATUS</th>
                                                <th>PRINTER</th>
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
                                                $query = 'SELECT * FROM tonners';
                                                $result = mysql_query($query) or die(mysql_error());
                                                            
                                                if (mysql_num_rows($result) == 0) {
                                                   echo "<div class='alert alert-danger alert-dismissable'>Currently No Tonners
                                                        <button type='button' class='close' 
                                                            data-dismiss='alert'>&times;</button></div>";
                                                }else{
                                                    while ($row = mysql_fetch_array($result)){
                                                        echo "<tr>
                                                            <td>".$row['t_serialno']."</td>
                                                            <td>".$row['t_model']."</td>
                                                            <td>".$row['t_color']."</td>
                                                            <td>".$row['t_purchdate']."</td>
                                                            <td>".$row['t_status']."</td>
                                                            <td>".$row['t_assignedP']."</td>";
                                                            if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                                if ($row['t_status'] == 'pool'){
                                                                    echo "<td><a role='button' class='btn btn-success' href='assign_tonner.php?id=".$row['t_serialno']."'><span class='glyphicon glyphicon-circle-arrow-right'></span>Assign</a></td>";
                                                                } else {
                                                                    echo "<td><a role='button' class='btn btn-success'></span>NONE</a></td>";
                                                                }
                                                                echo "<td><a role='button' class='btn btn-danger' href='remove_tonner.php?id=".$row['t_serialno']."'><span class='glyphicon glyphicon-trash'></span>Remove</a></td>";
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
                                                <th>COLOR</th>
                                                <th>DATE IN</th>
                                                <th>STATUS</th>
                                                <th>PRINTER</th>
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
                                            $('#tonner_table').dataTable();
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
