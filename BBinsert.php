<?php
include 'db_connect.php';

$name = $_POST['bbnames'];
$gender = $_POST['gender'];
$submit = $_POST['submit'];

if ($name !== NULL && $submit){
           
        $db_link or die('Couldnt Connect!');

        $sql="INSERT INTO `mzambrano2016`.`UserBBnames` (`gender`, `name`) VALUES ('$gender','$name')";
        $db_link->query($sql);


       echo "thank you for your submission";

}else {

    echo "You must complete every field and click submit";
}

header("refresh:1; url=http://lamp.cse.fau.edu/~mzambrano2016/p6/index.php");

?>