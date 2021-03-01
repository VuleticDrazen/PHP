<?php 

include 'db.php';
include 'funkcije.php';

$tip_nek = check_input($_POST['novi_tip_nekretnine'], "Morate upisati novi tip nekretnine");

$fname=str_replace(" ", "", $tip_nek);

if(!ctype_alpha($fname)){
    function_alert("Greska pri unosu novog tipa nekretnine: Tip nekretnine mora sadrzati samo slova");

}else{

    $tip_nek = ucwords(strtolower($tip_nek));
    $sql_insert = "INSERT INTO tip_nekretnine (tip_nekretnine) VALUES ('$tip_nek')";
    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert){

        header("location: index.php?msg=city_added");

    }else{
    
        header("location: index.php?msg=error");

    }
}


?>