

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
  <?php unset($_SESSION['succ']);} 
  elseif(isset($_SESSION['error'])){?>
  <div class="alert alert-danger" role="alert">
    <?php echo  $_SESSION['error'];?>
  </div>
  <?php unset($_SESSION['error']);
  }?>


  <h1 class="container p-3 my-3 bg-dark text-white rounded-pill">Miestai  </h1><br></br>
  <div class="container ">
    <h5 class='float-right'>	<a href="naujasmiestas?salis=<?php echo $_GET['salis']; ?>" class="container p-3 my-3 bg-dark text-white rounded-pill float-enter">Pridėti nauja miestą</a></h5><br></br>
    
    <div class="row">
          <form class="form-horizontal" action="importdataM" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
          <div class="input-row">
            <label class="col-md-4 control-label">Pasirinkite CSV failą</label> <input type="file" name="file" id="file" accept=".csv">
            <button type="submit" id="submit" name="import" class="btn-submit">Importuoti</button><br/>
          </div>
          <input class="form-control" type="number" name="salis" value="<?=$_GET['salis']?>" hidden >
          </form>
        </div>
    
    
        <table class="table table-hover border border-dark">
          <form action="" method="post"> 
            <div class="form-row">
              <div class="col">
                Rikiavimas:
                <select name="fr" id="fr" class="form-control">
                  <option value="1">Tipinis</option>
                  <option value="2">Didėjimo tvarka pagal pavadinimą</option>
                  <option value="3">Mažėjimo tvarka pagal pavadinimą</option>
                </select>
              </div>
              <div class="col">
                <label for="pr">Pradžia:</label>
                <input type="date" id="start" name="start">

                <label for="en">Pabaiga:</label>
                <input type="date" id="end" name="end">
                <br></br>
              </div>
            </div>
            <div class="input-group ">
              <div class="form-outline ">
                Pavadinimas: <input type="text" id="mrezult" name="mrezult" class="form-control" value =""/>
              </div>
              <input name="submit" type="submit" value="Ieškoti"  class="btn btn-primary">
              <label  class="form-label" for="form1"></label>
            </button>
          </div>
        </form>
        <br></br>
      <thead>
        <tr>
          <th scope="col">Pavadinimas</th>
          <th scope="col">Plotas</th>
          <th scope="col">Gyventojų sk.</th>
          <th scope="col">Pašto kodas</th>
          <th scope="col">Pridėjimo data</th>
          <th scope="col">Veiksmai</th>
        </tr>
      </thead>
    <tbody>

  <?php
    $pageno=$_GET["page"];
    if (isset($_POST['submit'])) {
      $rez=$_POST['mrezult'];
      $miestai=salis::miestai($_GET['salis'],$rez);
      if($_POST['fr'] == 2){
        $miestai= salis::sortSM($miestai);
      }
      elseif($_POST['fr'] == 3){
        $miestai= salis::sortSMdec($miestai);
      }
    }
    else{
      $miestai=salis::miestai($_GET['salis'],1);
    }
    
    $limit = 10;
    $offset = ($pageno-1) * $limit; 
    $kiekis= salis::kiekis($miestai);
    $end=$offset+$limit;
    $total_pages = ceil($kiekis / $limit);
    for($i=$offset;$i<$end;$i++){
        if($i==$kiekis){
          break;
        }
        else{?>
          <tr>
            <td ><?php echo $miestai[$i][1] ?></th>
            <td><?php echo $miestai[$i][2] ?></td>
            <td><?php echo $miestai[$i][3] ?></td>
            <td><?php echo $miestai[$i][4] ?></td>
            <td><?php echo $miestai[$i][6] ?></td>
            <td><a href="editmiestas?miestas=<?= $miestai[$i][0];?>&amp;salis=<?=$_GET['salis'];?>&amp;page=<?=$_GET['page'];?>" type="button" class="btn btn-secondary">Redaguoti</button>
            <a href="remmiestas?miestas=<?= $miestai[$i][0];?>&amp;salis=<?=$_GET['salis'];?>&amp;page=<?=$_GET['page'];?>" type="button" class="btn btn-danger">Pašalinti</button></td>
          </tr>
          <?php
        }
    }?>
    </tbody>
  </table>

<?php
if($total_pages >1){
?>
<nav aria-label="Pages">
  <ul class="pagination">
  <?php
    if($pageno>1){?>
      <li class="page-item"><a class="page-link" href="miestai?salis=<?php echo $_GET['salis'];?>&amp;page=<?php echo $cnt=$pageno-1;?>">Atgal</a></li>
      <?php
    }
    for($i=1;$i<=$total_pages;$i++){?>
      <li class="page-item"><a class="page-link" href="miestai?salis=<?php echo $_GET['salis'];?>&amp;page=<?php echo $i;?>"><?php echo $i;?></a></li>
      <?php
    }
    if($pageno!=$total_pages){?>
      <li class="page-item"><a class="page-link" href="miestai?salis=<?php echo $_GET['salis'];?>&amp;page=<?php echo $cnt=$pageno+1;?>">Kitas</a></li>
      <?php
    }?>
  </ul>
</nav>
<?php } ?>   
</div>
