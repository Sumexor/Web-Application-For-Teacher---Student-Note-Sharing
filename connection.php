<?php
$servername="localhost";
$username="root";
$password="";
$dbname="test";

$con = mysqli_connect($servername,$username,$password,$dbname);
if($con)
{

}
else
{
    die("Connection failed");
}
?>