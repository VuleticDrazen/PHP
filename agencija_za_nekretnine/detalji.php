<?php

include 'db.php';
include 'upiti.php';
include 'funkcije.php';

isset($_GET['id']) && is_numeric($_GET['id'])? $id = $_GET['id'] : exit("ID error...");

$sql= "SELECT * FROM nekretnina WHERE id = $id";

$row = mysqli_query($dbconn,$sql);
$nekretnina = mysqli_fetch_assoc($row);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalji nekretnine </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
 
<body style="background-color: #c41031">
<div class="container" style="background-color: #c41031">
    <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel" >
        <ol class="carousel-indicators">
        <?php echo indikatori_slajda($dbconn); ?>
        </ol>
        <div class="carousel-inner" >
            <?php echo slajdovi($dbconn); ?>
        </div>
        <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
         <span class="glyphicon glyphicon-chevron-left"></span>
         <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
         <span class="glyphicon glyphicon-chevron-right"></span>
         <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div>
    <ul class="list-group list-group-flush" style="margin-left: 204px; margin-right:204px" >
        <li class="list-group-item"><i class="fa fa-home" aria-hidden="true"></i> <?=tip_nekretnine($dbconn,$nekretnina['tip_nekretnine_id'])?></li>
        <li class="list-group-item"><i class="fa fa-shopping-basket" aria-hidden="true"> </i><?=tip_oglasa($dbconn,$nekretnina['tip_oglasa_id'])?></li>
        <li class="list-group-item"><i class="fa fa-map-marker" aria-hidden="true"></i> <?=grad($dbconn,$nekretnina['grad_id'])?></li>
        <li class="list-group-item"><i class="fa fa-eur" aria-hidden="true"></i> <?=$nekretnina['cijena']?></li>
        <li class="list-group-item"><i class="fa fa-arrows" aria-hidden="true"></i> <?=$nekretnina['povrsina']?>m2</li>
        <li class="list-group-item"><i class="fa fa-building" aria-hidden="true"></i> <?=$nekretnina['god_izgradnje']?>. godine</li>
        <li class="list-group-item"><i class="fa fa-cart-plus" aria-hidden="true"></i> <?=$nekretnina['status']?></li>
        <?php if($nekretnina['status'] == "Prodato"){?>
        <li class="list-group-item"><i class="fa fa-calendar" aria-hidden="true"></i> Prodato <?=$nekretnina['datum_prodaje']?></li>
        <?php }?>
        <li class="list-group-item" style="font-weight: bold"><?=$nekretnina['opis']?></li>
    </ul>
</div>

<div class="row col-lg-6 col-md-6" style="justify-content: center; display: flex; margin-left: 320px">
    <?php if($nekretnina['status'] != "Prodato"){?>
        <button class="btn btn-dark" id="modal_kupi_nekretninu" style="margin: 6px; padding: 6px">
    <i class="fa fa-cart-plus" aria-hidden="true"></i> Kupi nekretninu
    </button>
    <?php } ?>
    <button class="btn btn-dark" id="modal_izmjena_nekretnine" style="margin: 6px; padding: 6px">
    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Izmijeni nekretninu
    </button>
    <button class="btn btn-dark" id="modal_obrisi_nekretninu" style="margin: 6px; padding: 6px">
    <i class="fa fa-trash" aria-hidden="true"></i> Obrisi nekretninu
    </button>
  
</div>
 
<!-- Modal za kupovinu nekretnine-->
<div class="modal fade" id="kupi_nekretninu">
	<div class="modal-dialog">
	  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>                                                           
			</div> 
			<div class="modal-body">
        <form action="./kupi_nekretninu.php" method="POST">
          <input type="hidden" name="id" value="<?=$nekretnina['id']?>">
          <p>Da li ste sigurni?</p>
          <button class="btn btn-dark" ></i>Da</button>
        </form>
			</div>   
	  </div>                                                                       
	</div>                                          
</div>

<!-- Modal za izmjenu nekretnine-->
<div class="modal fade" id="izmjena_nekretnine">
  <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>                                                           
			</div> 
      <div class="modal-body">
        <form action="./izmijeni_nekretninu.php" method="POST"  enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?=$nekretnina['id']?>">
          <div class="form-row" style="margin: 4px; padding: 4px" >
            <div class="form-group col-lg-4 col-md-4">
              <label for="tipOglasa">Tip oglasa</label>
              <select name="tip_oglasa_id" id="tipOglasa" class="form-control">
                <?php 
                $res_tip_oglasa = mysqli_query($dbconn,"SELECT * FROM tip_oglasa");
                while($row = mysqli_fetch_assoc($res_tip_oglasa)){
                    $id_temp = $row['id'];
                    $name_temp = $row['tip_oglasa'];
                    if($id_temp == $nekretnina['tip_oglasa_id']){
                        echo "<option value=\"$id_temp\" selected>$name_temp</option>";
                    }else{
                        echo "<option value=\"$id_temp\" >$name_temp</option>";
                    }   
                }?>
              </select>
            </div>
              
            <div class="form-group col-lg-4 col-md-4">
              <label for="tipNekretnine">Tip nekretnine</label>
              <select name="tip_nekretnine_id" id="tipNekretnine" class="form-control">
                <?php
                $res_tip_nekr = mysqli_query($dbconn,"SELECT * FROM tip_nekretnine");
                while($row = mysqli_fetch_assoc($res_tip_nekr)){
                    $id_temp = $row['id'];
                    $name_temp = $row['tip_nekretnine'];
                    if($id_temp == $nekretnina['tip_nekretnine_id']){
                        echo "<option value=\"$id_temp\" selected>$name_temp</option>";
                    }else{
                        echo "<option value=\"$id_temp\" >$name_temp</option>";
                    }   
                }?>
              </select>
            </div>
              
            <div class="form-group col-lg-4 col-md-4">
              <label for="tipNekretnine">Grad</label>
              <select name="grad_id" id="grad" class="form-control">
                <?php 
                $res_gradovi = mysqli_query($dbconn,"SELECT * FROM grad");
                while($row = mysqli_fetch_assoc($res_gradovi)){
                    $id_temp = $row['id'];
                    $name_temp = $row['naziv_grada'];
                    if($id_temp == $nekretnina['grad_id']){ echo "<option value=\"$id_temp\" selected>$name_temp</option>";
                    }else {
                        echo "<option value=\"$id_temp\">$name_temp</option>";
                    }
                }?>
              </select>
            </div>
          </div>

          <div class="form-row" style="margin: 1px; padding: 0px">
            <div class="form-group col-lg-6 col-md-6">
              <input type="text" name="povrsina" placeholder="Povrsina" value="<?=$nekretnina['povrsina']?>">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <input type="text" name="god_izgradnje" placeholder="Godina izgradnje" value="<?=$nekretnina['god_izgradnje']?>">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <input type="text" name="cijena" placeholder="Cijena" value="<?=$nekretnina['cijena']?>">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <input type="text" name="opis" placeholder="Opis" value="<?=$nekretnina['opis']?>">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <input type="file" name="foto[]" multiple>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <button class="btn btn-dark" >Izmijeni</button>
            </div>
          </div>
        </form>    
      </div>
    </div>
  </div>
</div>

<!-- Modal za brisanje nekretnine-->
<div class="modal fade" id="obrisi_nekretninu">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>                                                           
			</div> 
			<div class="modal-body">
      <form action="./obrisi_nekretninu.php" method="POST">
      <input type="hidden" name="id" value="<?=$nekretnina['id']?>">
        <p>Da li ste sigurni?</p>
        <button class="btn btn-dark" >Da</button>
      </form>
			</div>   
		</div>                                                                       
	</div>                                          
</div>

 </body>
 <script>
$(document).ready(function(){
	$('#modal_kupi_nekretninu').click(function(){
  		$('#kupi_nekretninu').modal('show')
	});
});
</script>
<script>
$(document).ready(function(){
	$('#modal_izmjena_nekretnine').click(function(){
  		$('#izmjena_nekretnine').modal('show')
	});
});
</script>
<script>
$(document).ready(function(){
	$('#modal_obrisi_nekretninu').click(function(){
  		$('#obrisi_nekretninu').modal('show')
	});
});
</script>

</html>
