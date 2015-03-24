<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

     if (!loggedin()){
        header('Location: index.php');
    }
    
    $referer = $_SERVER['HTTP_REFERER'];

    /*if (isset($_POST['csv'])) {
        $rep = "computers";
        genCsv($query,$rep);
        echo $query;
    }*/
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
                                echo "ADMINISTRATION : Computers";
                                echo '<a role="submit" class="btn btn-default" href="administration.php">Back</a>';
                            } else {
                                echo "Computers";
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
                            <div class="col-sm-12 col-sm-offset-0">
                                <h2><center>COMPUTERS</center></h2>
                                <hr> 
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
                                <div style="margin: 10px auto; padding-left: 5px;">
                                    <table id="computer_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>SERIAL NO</th>
                                                <th>TYPE</th>
                                                <th>OS</th>
                                                <th>IP</th>
                                                <th>USER</th>
                                                <?php
                                                    if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                        echo '<th colspan="2">ACTION</th>';
                                                    }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = 'SELECT c.comp_sn, c.comp_type, c.comp_os, c.comp_ip, u.user_firstName, u.user_lastName 
                                                        FROM computers c 
                                                        LEFT JOIN users u 
                                                        ON c.comp_user = u.user_name';

                                                $result = mysql_query($query) or die(mysql_error());
                                                            
                                                if (mysql_num_rows($result) == 0) {
                                                    echo "<div class='alert alert-danger alert-dismissable'>Currently No Computers
                                                        <button type='button' class='close' 
                                                            data-dismiss='alert'>&times;</button></div>";
                                                }else{
                                                    while ($row = mysql_fetch_array($result)){
                                                        $user = $row['user_firstName'].' '.$row['user_lastName'];
                                                        echo "<tr>
                                                            <td>".$row['comp_sn']."</td>
                                                            <td>".$row['comp_type']."</td>
                                                            <td>".$row['comp_os']."</td>
                                                            <td>".$row['comp_ip']."</td>
                                                            <td>".$user."</td>";
                                                            
                                                            if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                                echo "<td><a role='button' class='btn btn-success' href='update_computer.php?id=".$row['comp_sn']."'><span class='glyphicon glyphicon-edit'></span>Update</a></td>";
                                                                echo "<td><a role='button' class='btn btn-danger' href='remove_computer.php?id=".$row['comp_sn']."'><span class='glyphicon glyphicon-trash'></span>Remove</a></td>";
                                                            }
                                                        echo "</tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SERIAL NO</th>
                                                <th>TYPE</th>
                                                <th>OS</th>
                                                <th>IP</th>
                                                <th>USER</th>
                                                <?php
                                                    if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                        echo '<th colspan="2">ACTION</th>';
                                                    }
                                                ?>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <!--<form method="post" action="computer_list.php">
                                       <?php
                                            /*if (!in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                echo "<button role='submit' name='csv' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span>EXPORT TO CSV</button>";
                                            }*/
                                        ?> 
                                    </form> -->
                                
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
