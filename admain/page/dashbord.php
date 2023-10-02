<?php
session_start();
//  
if(isset($_SESSION['Username'])){
    // require "../conect.php";
    // require "../includes/templets/heder.php";
    $pagtitle = "dashbord";
    require "init.php";
    
?>
    <div class="container home-static text-center">
        <h1>Dashbord pag</h1>
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="stat">
                    <a href="memper.php">
                        Total Mampers
                        <span>
                            <?php echo countItem('UserID','users','GroupID != 1'); ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="stat">
                    <a href="memper.php?do=Manage&Panding=Panding">
                        Panding Mampers
                        <span>
                            <?php echo countItem('UserID','users','RegStatus = 0'); ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="stat">
                    Total Mamper
                    <span>
                        2000
                    </span>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="stat">
                    Total Mamper
                    <span>
                        2000
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php
}else{
    header('Location:login.php');
    exit();
}
require "../includes/templets/footer.php";
?>