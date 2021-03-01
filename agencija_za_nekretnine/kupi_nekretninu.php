<?php 
include 'db.php';
isset($_POST['id']) ? $id = $_POST['id'] : $id = "ID error..";

$currentDateTime = date('Y-m-d H:i:s');
 $sql_update = "
 UPDATE `nekretnina` SET `status`= 'Prodato' , `datum_prodaje`= '$currentDateTime' WHERE id = '$id'
";
$res_update = mysqli_query($dbconn, $sql_update);

if($res_update){
header("location: index.php?msg=nekretnina_kupljena");
}else {
exit("Greska pri kupovini..");
}
?>