<html>
  <head>  
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
    <title>Žodyno kūrimas</title>               
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="include/stl.css" rel="stylesheet">
  </head>
  <body>   
    <?php
    $miestas=salis::miestas($_GET['miestas']);?>

    <div align="center">   <font size="4" color="#ff0000"><?php echo ""; ?><br></font>  
      <table bgcolor=#C3FDB8 class=" border border-dark">
        <tr><td>
          <form action="editmiestai?salis=<?=$_GET['salis'];?>&amp;page=<?=$_GET['page'];?>" method="POST" class="login">             
          <center style="font-size:18pt;"><b>Miesto redagavimas</b></center><br>
          
          <div class="form-group col-xs-3">
            <label for="exampleInputEmail1 ex2">Pavadinimas</label>
            <input class="form-control" type="char" name="pavadinimas" value="<?=$miestas[0][1];?>" required><br>
            <small id="emailHelp" class="form-text text-muted"></small>
          </div>
			
          <div class="form-group col-xs-3">
            <label for="exampleInputEmail1 ex2">Plotas</label>
            <input class="form-control" type="number" name="plotas" value="<?=$miestas[0][2];?>" required><br>
            <small id="emailHelp" class="form-text text-muted"></small>
          </div>
			
          <div class="form-group col-xs-3">
            <label for="exampleInputEmail1 ex2">Gyventojų skaičius</label>
            <input class="form-control" type="number" name="gyvsk" value="<?=$miestas[0][3];?>" required><br>
            <small id="emailHelp" class="form-text text-muted"></small>
          </div>
			
          <div class="form-group col-xs-3">
            <label for="exampleInputEmail1 ex2">Pašto kodas</label>
            <input class="form-control" type="text" name="pastokodas" value="<?=$miestas[0][4];?>" required >
            <small id="emailHelp" class="form-text text-muted"></small>
          </div>
          
          <input class="form-control" type="number" name="id" value="<?php echo $_GET['miestas'] ?>" hidden >
          <p style="text-align:left;">
          <input type="submit" name="login" value="Atnaujinti"/>    
          <a href="index.php"  type="submit" class="card-link text-danger ">Atgal į Pradžia</a>
          </p>  
          </form>
        </td></tr>
      </table>   
    </div>
  </td></tr>
</table>           
  </body>
</html>
	