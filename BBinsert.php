<?php
include 'db_connect.php';

$bbname = $_POST['bbnames'];
$gender = $_POST['gender'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$submit = $_POST['submit'];

if ($bbname !== NULL && $submit){
           
        $db_link or die('Couldnt Connect!');

        $sql1="INSERT INTO `mzambrano2016`.`users` (`firstname`, `lastname`) VALUES ('$firstname','$lastname')";
        $sql2="INSERT INTO `mzambrano2016`.`userbbnameinput` (`bbname`, `gender`) VALUES ('$bbname','$gender')";
        $db_link->query($sql1);
        $db_link->query($sql2);


       echo "thank you for your submission";

}else {

    echo "You must complete every field and click submit";
}



header("refresh:1; url=http://lamp.cse.fau.edu/~mzambrano2016/p6/index.php");
//for XAMPP development
 //header("refresh:1; url=http://localhost:8080/FavoriteBabyNames/");

?>