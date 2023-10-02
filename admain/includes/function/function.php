<?php
// get title function
function gettitle(){
    global $pagtitle;
    if(isset($pagtitle)){
        echo $pagtitle;
    }else{
        echo 'title';
    }
}
//end get title function
/*
**Redirect function v1
*/
// function redirecthome($errormsg,$seconds=3){
//     echo "<div class='alert alert-danger' >$errormsg and redirect $seconds S</div>";
//     header("refresh:$seconds;url=dashbord.php");
//     exit();
// }
// end function redirecthome
/*
**Redirect function v2
*/
function redirecthome($themsg,$alart_class,$url,$seconds=3){
    echo "<div class='alert $alart_class' >$themsg and redirect $seconds S</div>";
    header("refresh:$seconds;url=$url");
    exit();
}
// end function redirecthome
/**
 * Check item function
 * Function to check item in database 
 * $select =the item to select [ex: username , itemname ,catecoryname]
 * $table =from table name
 * $value= WHERE $value 
*/
function checkItem($select,$table,$value){
    global $connect;
    $statment=$connect->prepare("SELECT $select FROM $table WHERE $select=?");
    $statment->execute(array($value));
    $count=$statment->rowCount();
    return $count;
}
/**
 * Count numper of item v1.0
 * 
*/
function countItem($item,$table,$where){
    global $connect;
    $statCount=$connect->prepare("SELECT COUNT($item) FROM $table WHERE $where");
    $statCount->execute();
    $row=$statCount->fetchColumn();
    return $row;
}
?>