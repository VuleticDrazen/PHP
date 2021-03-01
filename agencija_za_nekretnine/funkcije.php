<?php 

include 'db.php';

function check_input($data, $problem=''){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        die($problem);
    }
    return $data;
}

function indikatori_slajda($dbconn){
    $id = $_GET['id'];
    $output = ''; 
    $count = 0;
    $query = "SELECT * FROM fotografije WHERE id_nekretnine = $id";
    $result = mysqli_query($dbconn, $query);

    while($row = mysqli_fetch_array($result)){
    if($count == 0){
    $output .= '<li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>';
    }else{
      $output .= '<li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>';
    }
    
    $count = $count + 1;

    }
 return $output;
}

function slajdovi($dbconn){
    $id = $_GET['id'];
    $output = '';
    $count = 0;
    $query = "SELECT * FROM fotografije WHERE id_nekretnine= $id";
    $result = mysqli_query($dbconn, $query);

    while($row = mysqli_fetch_array($result)){
     if($count == 0){
      $output .= '<div class="item active">';
     }else{
      $output .= '<div class="item" >';
     }
     $output .= '<img src="./uploads/'.$row["naziv_fotografije"].'" alt="" style="height: 500px; width:1200px"/></div>';
     $count = $count + 1;
    }
    return $output;
}

function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}


?>