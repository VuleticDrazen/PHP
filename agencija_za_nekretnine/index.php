<?php 
    include 'db.php';
    include 'upiti.php';

    // pretraga
    $where_arr = [];
    $where_arr[] = "1=1";
    if(isset($_GET['tip_oglasa_id']) && $_GET['tip_oglasa_id'] !="" ){
        $tip_oglasa_id = $_GET['tip_oglasa_id'];
        $where_arr[] = "tip_oglasa_id LIKE '%$tip_oglasa_id%' ";
    }

    if(isset($_GET['tip_nekretnine_id']) && $_GET['tip_nekretnine_id'] !="" ){
        $tip_nekretnine_id = $_GET['tip_nekretnine_id'];
        $where_arr[] = "tip_nekretnine_id LIKE '%$tip_nekretnine_id%' ";
    }

    if(isset($_GET['grad_id']) && $_GET['grad_id'] !="" ){
        $grad_id = $_GET['grad_id']; 
        $where_arr[] = "grad_id LIKE '%$grad_id%' ";
    }

    if(isset($_GET['povrsina_min']) && $_GET['povrsina_min'] !=""){
      $povrsina_min = $_GET['povrsina_min'];
      if(isset($_GET['povrsina_max']) && $_GET['povrsina_max'] !="" ){
          $povrsina_max = $_GET['povrsina_max'];
          $where_arr[] = "povrsina BETWEEN '$povrsina_min' AND '$povrsina_max'";
      }else {
          $where_arr[] = "povrsina >= '$povrsina_min' ";
      }
  } else if(isset($_GET['povrsina_max']) && $_GET['povrsina_max'] !="" ){
          $povrsina_max = $_GET['povrsina_max'];
          $where_arr[] = "povrsina <= '$povrsina_max'";
      }
    if(isset($_GET['cijena_min']) && $_GET['cijena_min'] !=""){
        $cijena_min = $_GET['cijena_min'];
        if(isset($_GET['cijena_max']) && $_GET['cijena_max'] !="" ){
            $cijena_max = $_GET['cijena_max'];
            $where_arr[] = "cijena BETWEEN '$cijena_min' AND '$cijena_max'";
        }else {
            $where_arr[] = "cijena >= '$cijena_min' ";
        }
    } else if(isset($_GET['cijena_max']) && $_GET['cijena_max'] !="" ){
            $cijena_max = $_GET['cijena_max'];
            $where_arr[] = "cijena <= '$cijena_max'";
        }

    if(isset($_GET['god_izgradnje']) && $_GET['god_izgradnje'] !="" ){
        $god_izgradnje = $_GET['god_izgradnje'];
        $where_arr[] = "god_izgradnje >= '$god_izgradnje' ";
    }

    $where_str = implode( " AND ", $where_arr );
    $res = mysqli_query($dbconn,pretraga($where_str));
    $gradovi = mysqli_query($dbconn, "SELECT * FROM grad")

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
    <title>Agencija za nekretnine</title>

</head>
<body>
    
    <nav class="navbar navbar-light" style="justify-content: center; display: flex; background-color: #c41031">
    <div class="row col-lg-6 col-md-6" style="justify-content: center; display: flex;">
    <button class="btn btn-dark" id="modal_nekretnina" style="margin: 6px; padding: 6px">
    <i class="fa fa-plus" aria-hidden="true"></i>Dodaj novu nekretninu
    </button>
    <button class="btn btn-dark" id="modal_novi_grad" style="margin: 6px; padding: 6px">
    <i class="fa fa-plus" aria-hidden="true"></i>Dodaj novi grad
    </button>
    <button class="btn btn-dark" id="modal_novi_tip" style="margin: 6px; padding: 6px">
    <i class="fa fa-plus" aria-hidden="true"></i>Dodaj novi tip nekretnine
    </button>
  
  </div>
    <form action="./index.php" method="GET">
    <div class="form-row" style="margin: 4px; padding: 4px" >
    <div class="form-group col-lg-4 col-md-4">
      <label for="tipOglasa">Tip oglasa</label>
      <select name="tip_oglasa_id" id="tipOglasa" class="form-control">
        <option value="" selected>--</option>
        <?php 
        $res_tip_oglasa = mysqli_query($dbconn,"SELECT * FROM tip_oglasa");
        while($row = mysqli_fetch_assoc($res_tip_oglasa)){
            $id_temp = $row['id'];
            $name_temp = $row['tip_oglasa'];
            echo "<option value=\"$id_temp\" >$name_temp</option>";
        }?>
      </select></div>
      <div class="form-group col-lg-4 col-md-4">
      <label for="tipNekretnine">Tip nekretnine</label>
      <select name="tip_nekretnine_id" id="tipNekretnine" class="form-control">
        <option value="" selected>--</option>
        <?php
        $res_tip_nekr = mysqli_query($dbconn,"SELECT * FROM tip_nekretnine");
        while($row = mysqli_fetch_assoc($res_tip_nekr)){
            $id_temp = $row['id'];
            $name_temp = $row['tip_nekretnine'];
            echo "<option value=\"$id_temp\" >$name_temp</option>";
        }?>
      </select>
      </div>
      <div class="form-group col-lg-4 col-md-4">
      <label for="tipNekretnine">Grad</label>
      <select name="grad_id" id="grad" class="form-control">
        <option value="" selected>--</option>
        <?php 
        $res_gradovi = mysqli_query($dbconn,"SELECT * FROM grad");
        while($row = mysqli_fetch_assoc($res_gradovi)){
            $id_temp = $row['id'];
            $name_temp = $row['naziv_grada'];
            echo "<option value=\"$id_temp\" >$name_temp</option>";
        }?>
      </select>
      </div></div>

  <div class="form-row" style="margin: 4px; padding: 4px">
    <div class="form-group col-lg-4 col-md-4">
      <input type="text" name="povrsina_min" placeholder="Povrsina od -">
    </div>
    <div class="form-group col-lg-4 col-md-4">
      <input type="text" name="povrsina_max" placeholder="Povrsina do -">
    </div>
    <div class="form-group col-lg-4 col-md-4">
      <input type="text" name="god_izgradnje" placeholder="Godina izgradnje od -">
    </div>
  </div>

  <div class="form-row" style="margin: 4px; padding: 4px">
    <div class="form-group col-lg-4 col-md-4">
      <input type="text" name="cijena_min" placeholder="Cijena od -">
    </div>
    <div class="form-group col-lg-4 col-md-4">
      <input type="text" name="cijena_max" placeholder="Cijena do -">
    </div>
    <div class="form-group col-lg-4 col-md-4">
      <button class="btn btn-dark" ><i class="fa fa-search-plus" aria-hidden="true"></i>Pretraga</button>
    </div>
  </div>  
  
</form>    
      </nav>

    <!-- Prikaz nekretnina -->    
    
  <div class="row">
  <?php

    while($row = mysqli_fetch_assoc($res)){?>
      <div class="card col-lg-4 col-md-4 col-xs-4" style="margin-top: 12px;"> 
        <img class="card-img-top" src="<?=$row['foto']?>" alt="" style="width: 492px; height: 300px; margin-left: 1px">   
        <div class="card-body"> 
          <h5 class="card-title">ID:<?=$row['id']?> - <?=$row['tip_nek']?> - <?=$row['tip_ogl']?> - <?=$row['ime_grada']?></h5> 
          <p class="card-text"><?=$row['opis']?></p> 
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><i class="fa fa-arrows" aria-hidden="true"></i> <?=$row['povrsina']?> m2</li>
            <li class="list-group-item"><i class="fa fa-eur" aria-hidden="true"></i> <?=$row['cijena']?></li>
            <li class="list-group-item"><i class="fa fa-cart-plus" aria-hidden="true"></i> <?=$row['status']?></li>
          </ul>
          <div class="card-footer bg-dark">
            <a href="detalji.php?id=<?=$row['id']?>" class="btn btn-outline-danger btn-sm"><i class="fa fa-info-circle" aria-hidden="true"> Detaljan prikaz</i></a> 
          </div>
        </div> 
      </div> 
 
  <?php } ?>

  </div>


  <!-- Modali -->


  <!-- Modal za unos novog grada-->
  <div class="modal fade" id="novi_grad">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">             
        <button type="button" class="close" data-dismiss="modal">&times;</button>                                                
			</div> 
			<div class="modal-body">
      <form action="./novi_grad.php" method="POST">
        <input type="text" name="novi_grad" placeholder="Naziv grada" required>
        <button class="btn btn-dark" ><i class="fa fa-plus" aria-hidden="true"></i>Dodaj</button>
    </form>
			</div>   
			<div class="modal-footer">
				<p>*Naziv grada moze sadrzati samo slova. Nezavisno od unosa, program ce sacuvati unesen naziv u skladu sa vec definisanim podacima (pr. nOvi saD -> Novi Sad) .</p>
        
			</div>
		</div>                                                                       
	</div>                                          
</div>

<!-- Modal za unos novog tipa nekretnine-->
<div class="modal fade" id="novi_tip">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>                                                           
			</div> 
			<div class="modal-body">
      <form action="./novi_tip_nekretnine.php" method="POST">
        <input type="text" name="novi_tip_nekretnine" placeholder="Naziv tipa nekretnine" required>
        <button class="btn btn-dark" ><i class="fa fa-plus" aria-hidden="true"></i>Dodaj</button>
    </form>
			</div>   
			<div class="modal-footer">
				<p>*Naziv tipa nekretnine moze sadrzati samo slova. Nezavisno od unosa, program ce sacuvati unesen naziv u skladu sa vec definisanim podacima (pr. reStORAn -> Restoran) .</p>
        
			</div>
		</div>                                                                       
	</div>                                          
</div>

<!-- Modal za unos nove nekretnine-->
<div class="modal fade" id="nova_nekretnina">
  <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>                                                           
			</div> 
      <div class="modal-body">
        <form action="./nova_nekretnina.php" method="POST"  enctype="multipart/form-data">
          <div class="form-row" style="margin: 4px; padding: 4px" >
            <div class="form-group col-lg-4 col-md-4">
              <label for="tipOglasa">Tip oglasa</label>
              <select name="tip_oglasa_id" id="tipOglasa" class="form-control" required>
                <option value="" selected>--</option>
                <?php 
                $res_tip_oglasa = mysqli_query($dbconn,"SELECT * FROM tip_oglasa");
                while($row = mysqli_fetch_assoc($res_tip_oglasa)){
                  $id_temp = $row['id'];
                  $name_temp = $row['tip_oglasa'];
                  echo "<option value=\"$id_temp\" >$name_temp</option>";
                }?>
              </select>
            </div>
              
            <div class="form-group col-lg-4 col-md-4">
              <label for="tipNekretnine">Tip nekretnine</label>
              <select name="tip_nekretnine_id" id="tipNekretnine" class="form-control" required>
                <option value="" selected>--</option>
                <?php
                $res_tip_nekr = mysqli_query($dbconn,"SELECT * FROM tip_nekretnine");
                while($row = mysqli_fetch_assoc($res_tip_nekr)){
                  $id_temp = $row['id'];
                  $name_temp = $row['tip_nekretnine'];
                  echo "<option value=\"$id_temp\" >$name_temp</option>";
                }?>
              </select>
            </div>
              
            <div class="form-group col-lg-4 col-md-4">
              <label for="tipNekretnine">Grad</label>
              <select name="grad_id" id="grad" class="form-control" required>
                <option value="" selected>--</option>
                <?php 
                $res_gradovi = mysqli_query($dbconn,"SELECT * FROM grad");
                while($row = mysqli_fetch_assoc($res_gradovi)){
                  $id_temp = $row['id'];
                  $name_temp = $row['naziv_grada'];
                  echo "<option value=\"$id_temp\" >$name_temp</option>";
                }?>
              </select>
            </div>
          </div>
              
          <div class="form-row" style="margin: 1px; padding: 0px">
            <div class="form-group col-lg-6 col-md-6">
              <input type="text" name="povrsina" placeholder="Povrsina" required>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <input type="text" name="god_izgradnje" placeholder="Godina izgradnje" required>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <input type="text" name="cijena" placeholder="Cijena" required>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <input type="text" name="opis" placeholder="Opis">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <input type="file" name="foto[]" multiple required>
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <button class="btn btn-dark" ><i class="fa faplus" aria-hidden="true"></i>Dodaj</button>
            </div>
          </div>

        </form>    
      </div>
    </div>
  </div>
</div>


</body>
<script>
$(document).ready(function(){
	$('#modal_novi_grad').click(function(){
  		$('#novi_grad').modal('show')
	});
});
</script>
<script>
$(document).ready(function(){
	$('#modal_novi_tip').click(function(){
  		$('#novi_tip').modal('show')
	});
});
</script>
<script>
$(document).ready(function(){
	$('#modal_nekretnina').click(function(){
  		$('#nova_nekretnina').modal('show')
	});
});
</script>
</html>