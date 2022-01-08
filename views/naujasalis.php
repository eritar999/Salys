<html>
  <head>  
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
    <title>Salies kūrimas</title>
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
          <form action="iterptisali" method="POST" class="login" id="regForm">             
            <center style="font-size:18pt;"><b>Šalies kūrimas</b></center><br>
            <div class="form-group col-xs-3">
              <label for="Pavadinimas">Pavadinimas</label>
              <input class="form-control" type="char" name="pavadinimas"  value="" required><br>
            </div>	

            <div class="form-group col-xs-3">
              <label for="Plotas">Plotas</label>
              <input class="form-control" type="number" name="plotas" value="" required><br>
            </div>
			
            <div class="form-group col-xs-3">
              <label for="gyvsk">Gyventojų skaičius</label>
              <input class="form-control" type="number" name="gyvsk" value="" required><br>
            </div>
			
            <div class="form-group col-xs-3">
              <label for="tel_kodas">Šalies Tel.Kodas</label>
              <input class="form-control" type="text" name="tel_kodas" value="" required >
            </div>
            <p style="text-align:left;">
            <input type="submit" name="login" value="Sukurti"/>     
            <a href="index.php"  type="submit" class="card-link text-danger ">Atgal į Pradžia</a>
          </p>  

   
                          </form>
                          <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                            <script>
                                $(document).ready(function() {
                                    $("#regForm").validate({
                                        rules: {
                                            pavadinimas: {
                                              minlength: 3,
                                              lettersonly: true,
                                              required: true,
                                              maxlength: 20
                                            },
                                            plotas:{
                                                required: true,
                                                digits: true,
                                                minlength: 1,
                                                maxlength: 10
                                            },
                                            gyvsk: {
                                                required: true,
                                                digits: true,
                                                maxlength: 10
                                            },
                                            tel_kodas: {
                                                required: true,
                                                maxlength: 5
                                            }
                                        },
                                        messages: {
                                            pavadinimas: {
                                                required: "Prašome įrašyti pavadinimą!",
                                                lettersonly: "Pavadinimą privalo sudaryti simboliai!",
                                                minlength: "Pavadinimas turi susidaryti iš mažiausiai 3 simbolių!",
                                                maxlength: "Pavadinimas negali būti ilgesnis nei 20 simbolių!"
                                            },
                                            plotas: {
                                                required: "Prašome įrašyti plotą!",
                                                minlength: "Ploto dydis turi susidaryti iš mažiausiai 1 skaitmenų!",
                                                maxlength: "Ploto dydis neturi viršyti 10 skaitmenų!"
                                            },
                                            gyvsk: {
                                                required: "Prašome įrašyti gyventojų skaičių!",
                                                maxlength: "Gyventojų skaičius neturi viršyti 10 skaitmenų!"
                                            },
                                            tel_kodas: {
                                                required: "Prašome įrašyti šalies tel.kodą!",
                                                maxlength: "Šalies tel.kodas neturi viršyti 5 simbolių!"
                                            },
                                        }
                                    });
                                });
                            </script>
      </td></tr>
      </table>  
  </div>
  </td></tr>
  </table>           
 </body>
</html>
	