<?php 


    function pretraga($uslovi){
    $sql= "SELECT 
        nekretnina.*, 
        grad.naziv_grada as ime_grada,
        tip_oglasa.tip_oglasa as tip_ogl,
        tip_nekretnine.tip_nekretnine as tip_nek 
    FROM nekretnina 
    LEFT JOIN grad on nekretnina.grad_id = grad.id
    LEFT JOIN tip_oglasa on nekretnina.tip_oglasa_id = tip_oglasa.id
    LEFT JOIN tip_nekretnine on nekretnina.tip_nekretnine_id = tip_nekretnine.id 
    WHERE $uslovi ORDER BY cijena ASC";

    return $sql;
    };

    function profile_img($nekr_id){
        $sql= "INSERT 
            nekretnina.*, 
            fotografija.naziv_fotografije as profile_photo
            tip_oglasa.tip_oglasa as tip_ogl,
            tip_nekretnine.tip_nekretnine as tip_nek 
        FROM nekretnina 
        LEFT JOIN fotografija on  = grad.id
        LEFT JOIN tip_oglasa on nekretnina.tip_oglasa_id = tip_oglasa.id
        LEFT JOIN tip_nekretnine on nekretnina.tip_nekretnine_id = tip_nekretnine.id 
        WHERE $uslovi";
    
        return $sql;
        };

    function grad($dbconn,$grad_id){
        $sql= "SELECT *
    FROM grad  
    WHERE id = $grad_id";
    $res = mysqli_query($dbconn,$sql);
    $row = mysqli_fetch_assoc($res);
    return $row['naziv_grada'];
    }

    
    function tip_oglasa($dbconn,$tip_oglasa_id){
        $sql= "SELECT *
    FROM tip_oglasa 
    WHERE id = $tip_oglasa_id";
    $res = mysqli_query($dbconn,$sql);
    $row = mysqli_fetch_assoc($res);
    return $row['tip_oglasa'];
   
    }

    function tip_nekretnine($dbconn, $tip_nekretnine_id){
        $sql= "SELECT *
    FROM tip_nekretnine  
    WHERE id = $tip_nekretnine_id";
    $res = mysqli_query($dbconn,$sql);
    $row = mysqli_fetch_assoc($res);
    return $row['tip_nekretnine'];

    }
?>