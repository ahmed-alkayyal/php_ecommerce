<?php
session_start();
//  
if(isset($_SESSION['Username'])){
    $pagtitle = "memper pag";
    require "init.php";
//start coding in page
    $do=isset($_GET['do']) ? $_GET['do'] : "Manage";
    if($do=='Manage'){
        $query='';
        if(isset($_GET['Panding'] ) && $_GET['Panding'] == 'Panding'){
            $query="AND RegStatus = 0";
        }
        $stmt=$connect->prepare("SELECT *  FROM users WHERE GroupID !=1 $query");
        $stmt->execute();
        $rows=$stmt->fetchAll();
        ?>
        <div class="container">
            <h1 class="text-center">
                Manage pag
            </h1>
            <div class="table-responsive">
                <table class="main-table text-center table table-bordered">
                    <tr>
                        <td>#ID</td>
                        <td>username</td>
                        <td>email</td>
                        <td>fullname</td>
                        <td>register date</td>
                        <td>control</td>
                    </tr>
                    <?Php
                        foreach($rows as $row){
                    ?>
                            <tr>
                                <td><?php echo $row['UserID'] ?></td>
                                <td><?php echo $row['Username'] ?></td>
                                <td><?php echo $row['Email'] ?></td>
                                <td><?php echo $row['FullName'] ?></td>
                                <td><?php echo $row['Date'] ?></td>
                                <td>
                                    <a href="memper.php?do=Edit&userid=<?php echo $row['UserID'] ?>" class="btn btn-success">Edit</a>
                                    <a href="memper.php?do=Delete&userid=<?php echo $row['UserID'] ?>" class="btn btn-danger confirm">delete</a>
                                    <?php
                                        if($row['RegStatus'] == 0){
                                            echo "<a href='memper.php?do=Activet&userid=".$row['UserID']."'class='btn btn-info'>Activ</a>";
                                        }
                                    ?>
                                </td>
                            </tr>
                            
                    <?php
                        }
                    ?>
                </table>
            </div>
            <a href='memper.php?do=add' class='btn btn-primary'>Add memper +</a>
        </div>
        <?php
    }elseif($do=='Edit'){
        // echo 'welcom to manage page and username is'. $_SESSION['Username']." "." and user id =".$_SESSION['UserID'];
        $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) :0;
        $stmt=$connect->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1");
        $stmt->execute(array($userid));
        $row=$stmt->fetch();
        $count=$stmt->rowCount();
        if($count>0){
        //start form edit
?>

    <h1 class="text-center">
        Edit profile
    </h1>
    <div class="container">
        <form action="?do=Updata" method="post">
            <input type="hidden" name="userid" value="<?php echo $userid?>">
            <div class="form-group">
                <label for="username" class="col-md-2 control-label">Username</label>
                <div class="col-sm-10" style="position: relative;">
                    <input type="text" name="username" value="<?php echo $row['Username'] ?>" id="username" class="form-control" autocomplete="off" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-2 control-label">password</label>
                <div class="col-sm-10">
                    <input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>">
                    <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-md-2 control-label">email</label>
                <div class="col-sm-10" style="position: relative;">
                    <input type="email" value="<?php echo $row['Email'] ?>" name="email" id="email" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="fullname" class="col-md-2 control-label">Full name</label>
                <div class="col-sm-10" style="position: relative;">
                    <input type="text" value="<?php echo $row['FullName'] ?>" name="fullname" id="fullname" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="submit" value="save" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
<?php
        }else{
            $themsg="this no such ID";
            redirecthome($themsg,'alert-danger','memper.php',4);
        }
    }elseif($do == 'Updata')
    {
        echo "<h1 class='text-center'>Edit profile</h1>";
        echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Get variables from the form
                $id         =$_POST['userid'];
                $username   =$_POST['username'];
                $email      =$_POST['email'];
                $fullname   =$_POST['fullname'];
                $password   ='';
                if(empty($_POST['password'])){
                    $password =$_POST['oldpassword'];
                }else{
                    $password=sha1($_POST['password']);
                }
                //validate in php
                $formerrors=array();
                if(empty($username)){
                    $formerrors[]="username cant be emmoty";
                }
                if(empty($email)){
                    $formerrors[]="email cant be emmoty";
                }
                if(empty($fullname)){
                    $formerrors[]="fullname cant be emmoty";
                }
                foreach($formerrors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                //updata code in database
                if(empty($formerrors)){
                    $stmt=$connect->prepare("UPDATE users SET Username=? , Password=? ,Email=? , FullName=? WHERE UserID=? ");
                    $stmt->execute(array($username,$password,$email,$fullname,$id));
                    echo "<div class='alert alert-success'>".$stmt->rowCount()."succes"."</div>";
                }
            }else{
                $themsg='sorry error';
                redirecthome($themsg,'alert-danger','dashbord.php');
            }
        echo "</div>";
    }elseif($do == 'add')
    {?>
        <h1 class="text-center">
            ADD profile
        </h1>
        <div class="container">
            <form action="?do=insert" method="post">
                <input type="hidden" name="userid" >
                <div class="form-group">
                    <label for="username" class="col-md-2 control-label">Username</label>
                    <div class="col-sm-10" style="position: relative;">
                        <input type="text" name="username" id="username" class="form-control" autocomplete="off" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-2 control-label">password</label>
                    <div class="col-sm-10" style="position: relative;">
                        <input type="password" name="password" id="password" class="form-control" autocomplete="new-password" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-2 control-label">email</label>
                    <div class="col-sm-10" style="position: relative;">
                        <input type="email"  name="email" id="email" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fullname" class="col-md-2 control-label">Full name</label>
                    <div class="col-sm-10" style="position: relative;">
                        <input type="text"  name="fullname" id="fullname" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="submit" value="Add" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    <?php
    }elseif($do == 'insert')
    {
        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD']=='POST'){
            echo "<h1 class='text-center'>ADD profile</h1>";
            //fetch data for form
            $username   =$_POST['username'];
            $password   =$_POST['password'];
            $email      =$_POST['email'];
            $fullname   =$_POST['fullname'];
            $haspass    =sha1($password);

            $formerrors =array();
            if(empty($username)){
                $formerrors[]='username cant be emmoty';
            }
            if(empty($password)){
                $formerrors[]='password cant be emmoty';
            }
            if(empty($email)){
                $formerrors[]='email cant be emmoty';
            }
            if(empty($fullname)){
                $formerrors[]='fullname cant be emmoty';
            }
            foreach($formerrors as $error){
                echo "<div class='alert alert-danger'>$error</div>";
            }
            if(empty($formerrors)){
                //check if user exist in database
                $check=checkItem('Username','users',$username);
                if($check == 1){
                    echo "sorry this username is exist";
                }else{
                    //insert in database
                    $stmt=$connect->prepare('INSERT INTO users(Username,Password,Email,FullName,RegStatus,Date)
                                                VALUES (:username,:password,:email,:fullname,1,now()) 
                                            ');
                    $stmt->execute(array(
                        'username'  => $username,
                        "password"  => $haspass,
                        "email"     =>$email,
                        "fullname"  =>$fullname,
                    ));
                    $themsg=$stmt->rowCount()."succes insert";
                    redirecthome($themsg,'alert-success','memper.php',4);
                }
            }

        }else{
            echo "</div class='alert alert-danger'>soooory errorrr اي الي جابك هنا من غير فورم يالئيم انت يالئيم ولا روح للفورم وتعاله من عندها</div>";
        }
        echo "</div>";
    }elseif($do == 'Delete'){
        $userid=isset($_GET['userid']) && is_numeric($_GET['userid'])?intval($_GET['userid']):0;
        $stmt=$connect->prepare('SELECT * FROM users WHERE UserID =? LIMIT 1');
        $stmt->execute(array($userid));
        $count=$stmt->rowCount();
        if($count > 0){
            // echo $userid;
            $stmt=$connect->prepare('DELETE FROM users WHERE UserID=:userid');
            $stmt->bindParam(':userid',$userid);
            $stmt->execute();
            echo "<div class='alert alert-success'>".$stmt->rowCount()."succes"."</div>";
        }else{
            $themsg='sorry error';
            redirecthome($themsg,'alert-danger','memper.php');
        }
    }elseif($do == 'Activet'){
        $userid=isset($_GET['userid']) && is_numeric($_GET['userid'])?intval($_GET['userid']):0;
        $check=checkItem('UserID','users',$userid);
        if($check > 0){
            $stmt=$connect->prepare("UPDATE users SET RegStatus ='1' WHERE UserID =?");
            $stmt->execute(array($userid));
            $count=$stmt->rowCount();
            if($count > 0){
                $themsg="succes update active";
                redirecthome($themsg,'alert-success','memper.php',4);
            }else{
                redirecthome('error','alert-danger','memper.php',6);
            }
        }else{
            redirecthome('error','alert-danger','memper.php',6);
        }
        // $stmt=$connect->prepare("UPDATE users SET RegStatus ='1' WHERE UserID =?");
        // $stmt->execute(array($userid));
        // $count=$stmt->rowCount();
        // if($count > 0){
        //     $themsg="succes update active";
        //     redirecthome($themsg,'alert-success','memper.php',4);
        // }else{
        //     redirecthome('error','alert-danger','memper.php',6);
        // }

    }

//end codingin pag
}else{
    header('Location:login.php');
    exit();
}
require "../includes/templets/footer.php";
?>