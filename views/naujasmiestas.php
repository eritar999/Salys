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
        if(isset($_SESSION['error'])){?>
        <div class="alert alert-danger" role="alert">
          <?php echo  $_SESSION['error'];?>
        </div>
        <?php unset($_SESSION['error']);
      }?>
     
     <div align="center">   <font size="4" color="#ff0000"><?php echo ""; ?><br></font>  
     <table bgcolor=#C3FDB8 class=" border border-dark">
       <tr><td>
         <form action="iterptimiesta?salis=<?= $_GET['salis'];?>" method="POST" class="login" id="regForm">
           <center style="font-size:18pt;"><b>Miesto pridėjimas</b></center><br>  
           <div class="form-group col-xs-3">
             <label for="Plotas">Pavadinimas</label>
             <input class="form-control" type="char" name="pavadinimas" value="" required><br>
            </div>
			
            <div class="form-group col-xs-3">
              <label for="Plotas">Plotas (㎢)</label>
                <input class="form-control" type="number" name="plotas" value="" required><br>
        </div>
            </div>
			
            <div class="form-group col-xs-3">
              <label for="gyvsk ex2">Gyventojų skaičius</label>
              <input class="form-control" type="number" name="gyvsk" value="" required><br>
            </div>
            
            <div class="form-group col-xs-3">
              <label for="pastokodas">Pašto kodas</label>
              <input class="form-control" type="text" name="pastokodas" value="" required >
            </div>

            <input class="form-control" type="number" name="fk_Salisid" value="<?php echo $_GET['salis'] ?>" hidden >
            <p style="text-align:left;">
            <input type="submit" name="login" value="Sukurti"/>     
            <a href="miestai?salis=<?=$_GET['salis']; ?>&page=1"  type="submit" class="card-link text-danger ">Grįžti atgal</a>
          </p>  

          <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                            <script>
                                $(document).ready(function() {
                                    $("#regForm").validate({
                                        rules: {
                                            pavadinimas: {
                                                required: true,
                                                minlength: 3,
                                                maxlength: 20
                                            },
                                            plotas:{
                                                required: true,
                                                digits: true,
                                                maxlength: 10
                                            },
                                            gyvsk: {
                                                required: true,
                                                digits: true,
                                                maxlength: 10
                                            },
                                            pastokodas: {
                                                required: true,
                                                maxlength: 10
                                            }
                                        },
                                        messages: {
                                            pavadinimas: {
                                                required: "Prašome įrašyti pavadinimą!",
                                                minlength: "Pavadinimas turi susidaryti iš mažiausiai 3 simbolių!",
                                                maxlength: "Pavadinimas negali būti ilgesnis nei 20 simbolių!"
                                            },
                                            plotas: {
                                                required: "Prašome įrašyti plotą!",
                                                maxlength: "Ploto dydis neturi viršyti 10 skaitmenų!"
                                            },
                                            gyvsk: {
                                                required: "Prašome įrašyti gyventojų skaičių!",
                                                maxlength: "Gyventojų skaičius neturi viršyti 10 skaitmenų!",
                                            },
                                            pastokodas: {
                                                required: "Prašome įrašyti pašto kodą!",
                                                maxlength: "Gyventojų skaičius neturi viršyti 10 simbolių!"
                                            }
                                        }
                                    });
                                });
                            </script>
        </form>
      </td></tr>
    </table>   
  </div>
</td></tr>
</table>       
 </body>
</html>
	