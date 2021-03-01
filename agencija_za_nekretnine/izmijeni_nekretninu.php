<?php 

    include 'db.php';
    include 'funkcije.php';
    isset($_POST['id']) ? $id = $_POST['id'] : $id = "nepoznato";
    $tip_oglasa_id = check_input($_POST['tip_oglasa_id'],"Morate odabrati tip oglasa");
    $tip_nekretnine_id = check_input($_POST['tip_nekretnine_id'], "Morate odabrati tip nekretnine");
    $grad_id = check_input($_POST['grad_id'], "Morate odabrati grad");
    is_numeric($_POST['povrsina']) ? $povrsina = check_input($_POST['povrsina'], "Morate unijeti povrsinu nekretnine" ) : exit("Cijena mora biti broj");
    is_numeric($_POST['god_izgradnje']) ? $god_izgradnje = check_input($_POST['god_izgradnje'], "Morate unijeti godinu izgradnje") : exit("Godina izgradnje mora biti broj");
    is_numeric($_POST['cijena']) ? $cijena = check_input($_POST['cijena'], "Morate unijeti cijenu") : exit("Cijena mora biti broj");
    $opis = check_input($_POST['opis'], "Morate unijeti opis");
    
    // upit za editovanje nekretnine
    $sql_update = "
                    UPDATE `nekretnina` SET
                                    tip_oglasa_id = '$tip_oglasa_id',
                                    tip_nekretnine_id = '$tip_nekretnine_id',
                                    grad_id = '$grad_id',
                                    povrsina = '$povrsina',
                                    god_izgradnje = '$god_izgradnje',
                                    cijena = '$cijena',
                                    opis = '$opis' 
                    WHERE id = $id
                ";
    $res_update = mysqli_query($dbconn, $sql_update);

    if(isset($_FILES['foto'])){
        foreach ($_FILES['foto']['tmp_name'] as $key => $slika){
            $img_name = $_FILES['foto']['name'][$key];
            $img_tmp_name = $_FILES['foto']['tmp_name'][$key];
            $temp_arr = explode(".", $img_name);
            $ext = $temp_arr[count($temp_arr)-1];
            $new_img_name = uniqid().".".$ext;
            $direktorijum = './uploads/';
            $result = move_uploaded_file($img_tmp_name,$direktorijum.$new_img_name);  

            $sql_insert_foto = "INSERT INTO fotografije (naziv_fotografije, id_nekretnine) VALUES ('$new_img_name', '$id' )";
            $res_insert_foto = mysqli_query($dbconn, $sql_insert_foto);
        }
    }

    if($res_update){
        header("location: index.php?msg=nekretnina_izmijenjena");
    }else {
        exit("Greska pri editovanju..");
    }


?> 