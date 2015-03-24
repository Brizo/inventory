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
                                echo "ADMINISTRATION : Stationary";
                                echo '<a role="submit" class="btn btn-default" href="administration.php">Back</a>';
                            } else {
                                echo "Printers";
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
                                <h2><center>STATIONARY</center></h2>
                                <hr> 
                                <?php
                                    if ($_SESSION['removeSTNSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['removeSTNSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                    if ($_SESSION['removeSTNFailure'] != ""){
                                        echo "<div class='alert alert-danger alert-dismissable'>"
                                            .$_SESSION['removeSTNFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updateSTNSuccess'] != ""){
                                        echo "<div class='alert alert-success alert-dismissable'>"
                                            .$_SESSION['updateSTNSuccess']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }

                                    if ($_SESSION['updateSTNFailure'] != ""){
                                        echo "<div class='alert alert-danger alert-dismissable'>"
                                            .$_SESSION['updateSTNFailure']."<button type='button' class='close' 
                                            data-dismiss='alert'>&times;</button></div>";
                                    }
                                ?>
                                <div style="margin: 10px auto;">
                                    <table id="stnary_table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>STATIONARY</th>
                                                <th>QUANTITY</th>
                                                <th>USED</th>
                                                <th>ORDER LEVEL</th>
                                                <th>OFFICER</th>
                                                <th>MODIFIED</th>
                                                <?php
                                                    if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                        echo '<th>ACTION</th>';
                                                    }
                                                ?>   
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = 'SELECT * FROM stationary';
                                                $result = mysql_query($query) or die(mysql_error());
                                                            
                                                if (mysql_num_rows($result) == 0) {
                                                    echo "<div class='alert alert-danger alert-dismissable'>Currently No Stationary
                                                        <button type='button' class='close' 
                                                            data-dismiss='alert'>&times;</button></div>";
                                                }else{
                                                    while ($row = mysql_fetch_array($result)){
                                                        echo "<tr>
                                                          <td>".$row['stnary_type']."</td>
                                                          <td>".$row['quantity']."</td>
                                                          <td>".$row['qnty_used']."</td>
                                                          <td>".$row['order_level']."</td>
                                                          <td>".$row['officer']."</td>
                                                          <td>".$row['date_modified']."</td>";
                              
                                                            if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                                echo "<td><a role='button' class='btn btn-success' href='update_stnary.php?id=".$row['idstationary']."'><span class='glyphicon glyphicon-edit'></span>Update</a></td>";
                                                            }
                                                        echo "</tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>STATIONARY</th>
                                                <th>QUANTITY</th>
                                                <th>USED</th>
                                                <th>ORDER LEVEL</th>
                                                <th>OFFICER</th>
                                                <th>MODIFIED</th>
                                                <?php
                                                    if ($_SESSION['user_accessRight'] == 'admin' && in_array(substr($referer,0,38),$_SESSION['adminRef'])) {
                                                        echo '<th>ACTION</th>';

                                                    }
                                                ?> 
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#stnary_table').dataTable();
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
