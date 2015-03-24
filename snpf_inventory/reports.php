<?php

    include "functions.php";
    include "header.php";
    include "connect.php";

    if (!loggedin()){
        header('Location: index.php');
    }
    
    $loggedUser = $_SESSION['user_firstName']." ".$_SESSION['user_lastName'];
?>
<body>
    <div id="container">
        <?php include "banner.php"; ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        REPORTS : Main
                        <a role="submit" class="btn btn-default" href="main.php"><span class="glyphicon glyphicon-home"></span>HOME</a>
                    </div>
                    <div class="panel-body">
                        <div class="row-fluid">
                            <div class='col-lg-8 col-lg-offset-2'>
                                <p><center><h3>INVENTORY REPORTS</h3></p></center><hr><br>
                            </div>
                        </div>
                        <div class='row-fluid'>
                            <div class='col-lg-4'>
                                <a href="printer_reports.php" role="button" class="btn btn-default btn-lg" id="printers"><img src="icons/active/by32/printer.png"class="img-rounded">PRINTERS</a>
                            </div>
                            <div class='col-lg-4'>
                                <a href="computer_reports.php" role="button" class="btn btn-default btn-lg" id="otherInventory"><img src="icons/active/by32/computer.png"class="img-rounded">COMPUTERS</a>
                            </div>
                            <div class='col-lg-4'>
                                <a href="tonner_reports_used.php" role="button" class="btn btn-default btn-lg" id="administration"><img src="icons/active/by32/report_go.png"class="img-rounded">USED TONNERS</a>
                            </div>
                            <div class='col-lg-4'>
                                <a href="stationary_report.php" role="button" class="btn btn-default btn-lg" id="administration"><img src="icons/active/by32/books.png"class="img-rounded">STATIONARY</a>
                            </div>
                            <div class='col-lg-4'>
                                <a href="tonner_order_levels.php" role="button" class="btn btn-default btn-lg" id="administration"><img src="icons/active/by32/money_euro.png"class="img-rounded">TONNER ORDER LEVELS</a>
                            </div>
                            <div class='col-lg-4'>
                                <a href="tonner_reports_ranout.php" role="button" class="btn btn-default btn-lg" id="administration"><img src="icons/active/by32/report_go.png"class="img-rounded">RAN OUT TONNERS</a>
                            </div>
                        </div><!-- close row -->
                    
                    </div> <!-- close panel-body -->
                    <?php 
                        include 'footer1.php';
                    ?>
                </div>
            </div><!-- close column 1 -->
        </div><!-- close row 1 -->
        <div class="row">
            <?php include "footer.php"; ?>
        </div> <!-- close row2 -->
    </div> <!-- close main container -->
</body>
</html>
