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
                                echo "ADMINISTRATION : Servers";
                                echo '<a role="submit" class="btn btn-default" href="administration.php">Back</a>';
                            } else {
                                echo "Servers";
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
                                <h2><center>SERVERS</center></h2>
                                <hr> 
                                
                                <?php
                                    if ($_SESSION['removeSSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['removeSSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                    if ($_SESSION['removeSFailure'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['removeSFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updateSSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['updateSSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updateSFailure'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['updateSFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                ?>
                                <div style="margin: 10px auto; padding-left: 5px;">
                                    <table id="servers_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S NO</th>
                                                <th>NAME</th>
                                                <th>OS</th>
                                                <th>IP</th>
                                                <th>HDD</th>	
                                                <th>RAM</th>
                                                <?php
                                                    if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                        echo '<th colspan="2">ACTION</th>';
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = 'SELECT * FROM servers';
                                                $result = mysql_query($query) or die(mysql_error());
                                                            
                                                if (mysql_num_rows($result) == 0) {
                                                    echo "<div class='alert alert-danger alert-dismissable'>Currently No servers
                                                        <button type='button' class='close' 
                                                            data-dismiss='alert'>&times;</button></div>";
                                                }else{
                                                    while ($row = mysql_fetch_array($result)){
                                                       
                                                        echo "<tr>
                                                            <td>".$row['s_serial']."</td>
                                                            <td>".$row['s_name']."</td>
                                                            <td>".$row['s_os']."</td>
                                                            <td>".$row['s_ip']."</td>
                                                            <td>".$row['s_hdrive']."</td>
                                                            <td>".$row['s_ram']."</td>";
                                                            if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                                echo "<td><a role='button' class='btn btn-success' href='update_server.php?id=".$row['s_serial']."'><span class='glyphicon glyphicon-edit'></span>Update</a></td>";
                                                                echo "<td><a role='button' class='btn btn-danger' href='remove_server.php?id=".$row['s_serial']."'><span class='glyphicon glyphicon-trash'></span>Remove</a></td>";
                                                            }
                                                        echo "</tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S NO</th>
                                                <th>NAME</th>
                                                <th>OS</th>
                                                <th>IP</th>
                                                <th>HDD</th>    
                                                <th>RAM</th>
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
                                            $('#servers_table').dataTable();
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
            </div><!-- column ends -->
        </div> <!-- end row1 -->
        <div class="row">
            <?php include "footer.php"; ?>
        </div> <!-- close row2 -->
    </div> <!-- close main container -->
</body>
</html>
