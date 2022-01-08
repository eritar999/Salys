<html>
  <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>ŠalysMiestai</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link href="include/stl.css" rel="stylesheet">
	</head>

  <body>
  <?php
  include('menubar.php');
  ?>


    <?php
    if(isset($_SESSION['succ'])){?>
      <div class="alert alert-success" role="alert">
        <?php echo  $_SESSION['succ'];?>
      </div>
      <?php unset($_SESSION['succ']);
      }
    elseif(isset($_SESSION['error'])){?>
      <div class="alert alert-danger" role="alert">
        <?php echo  $_SESSION['error'];?>
      </div>
      <?php unset($_SESSION['error']);
    }?>

    
    <div class="container ">
			<div class="col-sm mb-4">
        <div class="text-center  container p-3 my-3 bg-dark text-white rounded-pill"><br><br>
        <h1>Šalys</h1>
        <h5><a href="naujasalis" >Kurti nauja šalį</a></h5>
        </div>
        <div class="row">
          <form class="form-horizontal" action="importdata" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
          <div class="input-row">
            <label class="col-md-4 control-label">Pasirinkite CSV failą</label> <input type="file" name="file" id="file" accept=".csv">
            <button type="submit" id="submit" name="import" class="btn-submit">Importuoti</button><br/>
          </div>
          </form>
        </div>
        <form action="" method="post"> 
          <div class="input-group ">
          </div>

          <div class="form-row">
            <div class="col">
              Rikiavimas:
            <select name="fr" id="fr" class="form-control">
              <option value="1">Tipinis</option>
              <option value="2">Didėjimo tvarka pagal pavadinimą</option>
              <option value="3">Mažėjimo tvarka pagal pavadinimą</option>
            </select>

            <div class="form-outline ">
              Pavadinimas:
              <input type="text" id="rezult" name="rezult" class="form-control" value =""/>
            </div>
            <input name="submit" type="submit" value="Ieškoti" class="btn btn-primary">
            <label class="form-label" for="form1"></label></button>

            </div>
            <div class="col">
            <label for="birthday">Pradžia:</label>
            <input type="date" id="start" name="start">

            <label for="birthday">Pabaiga:</label>
            <input type="date" id="end" name="end">
            </div>
            
  </div>
        </form> 
        

<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {
	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</div>
    <div class="row">
      <?php
      if (isset($_POST['submit'])) {
        $rez=$_POST['rezult'];
        $salis=salis::sarasas($rez);
        if($_POST['fr'] == 2){
          $salis= salis::sortSM($salis);
        }
        elseif($_POST['fr'] == 3){
          $salis= salis::sortSMdec($salis);
        }
      }
      else{
        $salis=salis::sarasas(1);
      }

      if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
      $pageno=$_GET["page"];
      $limit = 10;
      $offset = ($pageno-1) * $limit; 
      $kiekis= salis::kiekis($salis);
      $end=$offset+$limit;
      $total_pages = ceil($kiekis / $limit);
      for($i=$offset;$i<$end;$i++){
        if($i==$kiekis){
          break;
        }
        else{?>
          <div class="col-md-4 ">
            <div class="col-md-6 ">
              <div class="card border border-dark" style="width: 22rem;">
              <div class="card-body ">
                <h5>	<a href="miestai?salis=<?= $salis[$i][0]; ?>&amp;page=1" ><?php echo $salis[$i][1]?></a></h5>
                <h6 class="card-subtitle mb-2 text-muted">Užimamas plotas: <?php echo $salis[$i][2]?> km2</h6>
                <h6 class="card-subtitle mb-2 text-muted">Gyventojų sk.: <?php echo $salis[$i][3]?></h6>
                <p class="card-text">Tel. kodas: <?php echo $salis[$i][4]?></p>
                <p class="card-text">Pridėjimo data: <?php echo $salis[$i][5]?></p>
              </div>
              <div class="container ">
                <h5 class="float-left">	<a href="editsalis?salis=<?= $salis[$i][0]; ?>" >Redaguoti</a></h5>
                <h5 class="float-right">	<a href="remsalis?salis=<?= $salis[$i][0]; ?>" >Pašalinti</a></h5>
              </div>
            </div>
          </div>
        </div>
        <?php
        }}    ?>
      </div>

<br></br>
<?php 
if($total_pages >1){?>
  <nav aria-label="Pages">
    <ul class="pagination">
      <?php
      if($pageno>1){?>
        <li class="page-item"><a class="page-link" href="salys?page=<?php echo $cnt=$pageno-1;?>">Atgal</a></li>
        <?php
      }
      for($i=1;$i<=$total_pages;$i++){?>
        <li class="page-item"><a class="page-link" href="salys?page=<?php echo $i;?>"><?php echo $i;?></a></li>
        <?php
      }
      if($pageno!=$total_pages){?>
        <li class="page-item"><a class="page-link" href="salys?page=<?php echo $cnt=$pageno+1;?>">Kitas</a></li>
        <?php
      }?>
    </ul>
  </nav>
<?php } ?>   