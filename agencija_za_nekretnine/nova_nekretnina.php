<?php 

    include 'db.php';
    include 'funkcije.php';

    $tip_oglasa_id = check_input($_POST['tip_oglasa_id'],"Morate odabrati tip oglasa");
    $tip_nekretnine_id = check_input($_POST['tip_nekretnine_id'], "Morate odabrati tip nekretnine");
    $grad_id = check_input($_POST['grad_id'], "Morate odabrati grad");
    is_numeric($_POST['povrsina']) ? $povrsina = check_input($_POST['povrsina'], "Morate unijeti povrsinu nekretnine" ) : exit("Cijena mora biti broj");
    is_numeric($_POST['god_izgradnje']) ? $god_izgradnje = check_input($_POST['god_izgradnje'], "Morate unijeti godinu izgradnje") : exit("Godina izgradnje mora biti broj");
    is_numeric($_POST['cijena']) ? $cijena = check_input($_POST['cijena'], "Morate unijeti cijenu") : exit("Cijena mora biti broj");
    $opis = check_input($_POST['opis'], "Morate unijeti opis");
    if(isset($_FILES['foto'])){
        foreach ($_FILES['foto']['tmp_name'] as $key => $slika){
            $img_name = $_FILES['foto']['name'][$key];
            if($img_name == ""){
                exit("Morati odabrati najmanje jednu fotografiju");
            }
        }
    }

    // upit za dodavanje u bazu
    $sql_insert = "INSERT INTO nekretnina
                                (
                                    tip_oglasa_id,
                                    tip_nekretnine_id,
                                    grad_id,
                                    povrsina,
                                    cijena,
                                    god_izgradnje,
                                    opis
                                ) 
                            VALUES
                                (
                                    '$tip_oglasa_id',
                                    '$tip_nekretnine_id',
                                    '$grad_id',
                                    '$povrsina',
                                    '$cijena',
                                    '$god_izgradnje',
                                    '$opis'
                                   
                                )
                ";
        
    $res_insert = mysqli_query($dbconn, $sql_insert);
    $latest_id = $dbconn->insert_id;

    $profile_img;
    foreach ($_FILES['foto']['tmp_name'] as $key => $slika){
        $img_name = $_FILES['foto']['name'][$key];
        $img_tmp_name = $_FILES['foto']['tmp_name'][$key];
        $temp_arr = explode(".", $img_name);
        $ext = $temp_arr[count($temp_arr)-1];
        $new_img_name = uniqid().".".$ext;
        $direktorijum = './uploads/';
        $result = move_uploaded_file($img_tmp_name,$direktorijum.$new_img_name);  
        $profile_img = $direktorijum.$new_img_name;
        $sql_insert_foto = "INSERT INTO fotografije ( naziv_fotografije, id_nekretnine) VALUES ('$new_img_name', '$latest_id' )";
        $res_insert_foto = mysqli_query($dbconn, $sql_insert_foto);
    }
        mysqli_query($dbconn,"UPDATE nekretnina SET foto = '$profile_img' WHERE id = '$latest_id' ");
    
    
    if($res_insert){
        header("location: index.php?msg=contact_added");
    }else{
        exit("<pre>".$sql_insert."</pre>");
        header("location: index.php?msg=error");
        // exit("Greska pri dodavanju...");
    }

    function function_alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
        exit();
    }
    
    ?>
    

