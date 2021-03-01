<?php 

include 'db.php';
isset($_POST['id']) ? $id = $_POST['id'] : exit("ID error...");

$sql_1 = "DELETE FROM nekretnina WHERE id = $id";
$sql_2 = "DELETE FROM fotografije WHERE id_nekretnine = $id";
  
$res_2 = mysqli_query($dbconn,$sql_2);  
$res_1 = mysqli_query($dbconn,$sql_1);

if($res_1){
    if($res_2){
        header("location: index.php?msg=uspjesno_brisanje");
    }else {
        header("location: index.php?msg=fotografije_nisu_obrisane");
    }  
}else if($res_2){
    header("location: index.php?msg=nekretnina_nije_obrisana");
    }else{
    header("location: index.php?msg=error...");
    }
    ?>
