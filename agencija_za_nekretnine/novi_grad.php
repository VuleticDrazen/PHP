<?php 

include 'db.php';
include 'funkcije.php';

$naziv = check_input($_POST['novi_grad'], "Upisite naziv grada");

$fname=str_replace(" ", "", $naziv);

if(!ctype_alpha($fname)){
    function_alert("Greska pri unosu naziva grada: Naziv grada mora sadrzati samo slova");
}else{
    $naziv = ucwords(strtolower($naziv));
    $sql_insert = "INSERT INTO grad (naziv_grada) VALUES ('$naziv')";
    $res_insert = mysqli_query($dbconn, $sql_insert);

    if($res_insert){
        header("location: index.php?msg=city_added");
    }else{    
        header("location: index.php?msg=error");
    }
}

?>