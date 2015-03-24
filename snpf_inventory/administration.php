<?php
    include "functions.php";
    include "header.php";
    include "connect.php";

    if (!loggedin()){
        header('Location: index.php');
    }

   clearallmgs();
?>
<body>
    <div id="container">
        <?php include "banner.php"; ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">ADMINISTRATION
                        <a role="submit" class="btn btn-default" href="main.php"><span class="glyphicon glyphicon-home"></span>HOME</a>
                    </div>
                    <div class="panel-body">
                        <div class='row-fluid'>
                            <ul class="nav nav-tabs" data-tab="tabs">
                                <li id="loc_printers_tab" class="active"><a href="#loc_printers" data-toggle="tab">LOCAL-PRINTERS</a></li>
                                <li id="leasd_printers_tab"><a href="#leasd_printers" data-toggle="tab">LEASED-PRINTERS</a></li>
                                <li id="tonners_tab"><a href="#tonners" data-toggle="tab">TONNERS</a></li>
                                <li id="otherIn_tab"><a href="#computers" data-toggle="tab">COMPUTERS</a></li>
                                <li id="otherIn_tab"><a href="#servers" data-toggle="tab">SERVERS</a></li>
                                <li id="user_tab"><a href="#users" data-toggle="tab">USERS</a></li>
                                <li id="user_tab"><a href="#pool" data-toggle="tab">POOL</a></li>
                                <li id="user_tab"><a href="#stationary" data-toggle="tab">STATIONARY</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="loc_printers">
                                    <br>
                                    <div class='col-lg-4' > 
                                        <a href="printer_list_loc.php" role="button" class="btn btn-default btn-lg" id="showprinters"><img src="icons/active/by32/printer.png"class="img-rounded">List Local Printers</a>
                                    </div>
                                    <div class='col-lg-4' >
                                        <a href="add_printer_loc.php" role="button" class="btn btn-default btn-lg" id="addprinter"><img src="icons/active/by32/printer_add.png"class="img-rounded">Add Local Printer</a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="leasd_printers">
                                    <br>
                                    <div class='col-lg-4' > 
                                        <a href="printer_list_leasd.php" role="button" class="btn btn-default btn-lg" id="showprinters"><img src="icons/active/by32/printer.png"class="img-rounded">List Leased Printers</a>
                                    </div>
                                    <div class='col-lg-4' >
                                        <a href="add_printer_leasd.php" role="button" class="btn btn-default btn-lg" id="addprinter"><img src="icons/active/by32/printer_add.png"class="img-rounded">Add Leased Printer</a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tonners">
                                    <br>
                                    <div class='col-lg-4' > 
                                        <a href="tonner_list.php" role="button" class="btn btn-default btn-lg" id="showtonners"><img src="icons/active/by32/list.png"class="img-rounded">List Tonners</a>
                                    </div>
                                    <div class='col-lg-4' >
                                        <a href="add_tonner.php" role="button" class="btn btn-default btn-lg" id="addtonner"><img src="icons/active/by32/add.png"class="img-rounded">Add Tonner</a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="computers">
                                    <br>
                                     <div class='col-lg-4' > 
                                        <a href="computer_list.php" role="button" class="btn btn-default btn-lg" id="showtonners"><img src="icons/active/by32/computer.png"class="img-rounded">List Computers</a>
                                    </div>
                                    <div class='col-lg-4' >
                                        <a href="add_computer.php" role="button" class="btn btn-default btn-lg" id="addtonner"><img src="icons/active/by32/computer_add.png"class="img-rounded">Add Computer</a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="servers">
                                    <br>
                                     <div class='col-lg-4' > 
                                        <a href="server_list.php" role="button" class="btn btn-default btn-lg" id="showtonners"><img src="icons/active/by32/list.png"class="img-rounded">List Servers</a>
                                    </div>
                                    <div class='col-lg-4' >
                                        <a href="add_server.php" role="button" class="btn btn-default btn-lg" id="addtonner"><img src="icons/active/by32/add.png"class="img-rounded">Add Server</a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="users">
                                    <br>
                                    <div class='col-lg-4' > 
                                        <a href="user_list.php" role="button" class="btn btn-default btn-lg" id="showusers"><img src="icons/active/by32/user.png"class="img-rounded">List Users</a>
                                    </div>
                                    <div class='col-lg-4' >
                                        <a href="add_user.php" role="button" class="btn btn-default btn-lg" id="addusers"><img src="icons/active/by32/user_add.png"class="img-rounded">Add User</a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pool">
                                    <br>
                                    <div class='col-lg-4' > 
                                        <a href="pool_list.php" role="button" class="btn btn-default btn-lg" id="showpool"><img src="icons/active/by32/list.png"class="img-rounded">List Pool Items</a>
                                    </div>
                                    <div class='col-lg-4' >
                                        <a href="add_pool.php" role="button" class="btn btn-default btn-lg" id="addpool"><img src="icons/active/by32/add.png"class="img-rounded">Add Pool Item</a>
                                    </div>
                                </div>
                                 <div class="tab-pane" id="stationary">
                                    <br>
                                    <div class='col-lg-4' > 
                                        <a href="stnary_list.php" role="button" class="btn btn-default btn-lg" id="showstnary"><img src="icons/active/by32/list.png"class="img-rounded">List Stationary</a>
                                    </div>
                                    <div class='col-lg-4' >
                                        <a href="add_stnary_type.php" role="button" class="btn btn-default btn-lg" id="add_stnary_type"><img src="icons/active/by32/add.png"class="img-rounded">Add Stationary Type</a>
                                    </div>
                                    <div class='col-lg-4' >
                                        <a href="add_stnary.php" role="button" class="btn btn-default btn-lg" id="addstnary"><img src="icons/active/by32/add.png"class="img-rounded">Add Stationary Item</a>
                                    </div>
                                </div>
                            </div> <!-- clse tab content -->
                        </div><!-- close row -->
                    </div> <!-- close panel-body -->
                    <?php 
                        include 'footer1.php';
                    ?>
                </div> <!-- end panel -->
            </div> <!-- end column -->
        </div> <!-- end row1 -->
        <div class="row">
            <?php include "footer.php"; ?>
        </div> <!-- close row2 -->
    </div> <!-- close main container -->
</body>
</html>
