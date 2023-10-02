<?php
session_start();
$navbarshow='';
if(isset($_SESSION['Username'])){
    header('Location: dashbord.php');
}
    $pagtitle='login pag';
    require "init.php";
    //check if user comming from HTTP POST
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $hashpass=sha1($password);
        ////
        $stmt=$connect->prepare(
            "SELECT 
                UserID,Username,Email,Password,GroupID,RegStatus 
            FROM 
                users 
            WHERE 
                Username=? AND Email=? AND Password=? AND GroupID=1 AND RegStatus=1 
            LIMIT 1");
        $stmt->execute(array(
            $username,
            $email,
            $hashpass,
        ));
        $row=$stmt->fetch();
        $cont=$stmt->rowCount();
        if($cont>0){
            $_SESSION['Username']=$username;
            $_SESSION['UserID']=$row['UserID'];
            header('Location: dashbord.php');
            exit();
        }
    }
?>
<div class="container form">
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
        <input class="form-control" type="text" name="username" id="username" placeholder="username">
        <input class="form-control" type="email" name="email" id="email" placeholder="email">
        <input class="form-control" type="password" name="password" id="password" placeholder="password">
        <input class="form-control btn btn-success" type="submit" value="submit" >
    </form>
</div>

<?php
    require "../includes/templets/footer.php";
?>
