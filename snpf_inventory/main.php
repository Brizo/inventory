<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

    if (!loggedin()){
        header('Location: index.php');
    }
    
    $loggedUser = $_SESSION['user_firstName']." ".$_SESSION['user_lastName'];
    clearallmgs();
?>
<body>
    <div id="container">
        <?php include "banner.php"; ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"><img src="icons/active/by32/application_home.png"class="img-rounded">HOME : Welcome <?php echo $loggedUser;?></div>
                    <div class="panel-body">
                        <div class="row-fluid">
                            <div class='col-lg-8 col-lg-offset-2'>
                                <p><center><h4>WELCOME TO THE SNPF INVENTORY PORTAL</h4></p></center><hr><br>
                            </div>
                        </div>
                        <div class='row-fluid'>
                            <div class='col-lg-4'>
                                <a href="printer_list_loc.php" role="button" class="btn btn-default btn-lg" id="printers"><img src="icons/active/by32/printer.png"class="img-rounded">LOCAL PRINTERS</a>
                            </div>
                            <div class='col-lg-4'>
                                <a href="printer_list_leasd.php" role="button" class="btn btn-default btn-lg" id="printers"><img src="icons/active/by32/printer_network.png"class="img-rounded">LEASED PRINTERS</a>
                            </div>
                            <div class='col-lg-4'>
                                <a href="computer_list.php" role="button" class="btn btn-default btn-lg" id="computers"><img src="icons/active/by32/computer.png"class="img-rounded">COMPUTERS</a>
                            </div>
                            <div class='col-lg-4'>
                                <a href="server_list.php" role="button" class="btn btn-default btn-lg" id="servers"><img src="icons/active/by32/servers_network.png"class="img-rounded">SERVERS</a>
                            </div>
                            <br />
                            <div class='col-lg-4'>
                                <a href="user_list.php" role="button" class="btn btn-default btn-lg" id="administration"><img src="icons/active/by32/users_4.png"class="img-rounded">USERS</a>
                            </div>

                            <div class='col-lg-4'>
                                <a href="tonner_list.php" role="button" class="btn btn-default btn-lg" id="tonners"><img src="icons/active/by32/tilelist.png"class="img-rounded">TONNERS</a>
                            </div>


                            <?php
                                session_start();

                                if ($_SESSION['user_accessRight'] == 'admin') {
                                    echo '<div class="col-lg-4">
                                        <a href="administration.php" role="button" class="btn btn-default btn-lg" id="administration"><img src="icons/active/by32/administrator.png"class="img-rounded">ADMIN</a>
                                        </div>';
                                }
                            ?>

                            <div class='col-lg-4'>
                                <a href="reports.php" role="button" class="btn btn-default btn-lg" id="administration"><img src="icons/active/by32/report_stack.png"class="img-rounded">REPORTS</a>
                            </div>

                            <div class='col-lg-4'>
                                <a href="pool_list.php" role="button" class="btn btn-default btn-lg" id="tonners"><img src="icons/active/by32/multilevel_list.png"class="img-rounded">POOL</a>
                            </div>
                        </div><!-- close row -->
                    
                    </div> <!-- close panel-body -->
                    <div class="panel-footer">
                        <a  role="button" href="logout.php" class="btn btn-primary"><span class="glyphicon glyphicon-off"></span>logout</a>
                    </div>
                </div>
            </div><!-- close column 1 -->
        </div><!-- close row 1 -->
        <div class="row">
            <?php include "footer.php"; ?>
        </div> <!-- close row2 -->
    </div> <!-- close main container -->
</body>
</html>
