<?php
class salis extends Controller{

    public function importdata(){
        $salys =salis::sarasas(1);
        $alert=0;
        if (isset($_POST["import"])) {
    
            $fileName = $_FILES["file"]["tmp_name"];
            
            if ($_FILES["file"]["size"] > 0) {
                
                $file = fopen($fileName, "r");
                
                while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $pavadinimas="";
                    if (isset($column[0])) {
                        $pavadinimas = $column[0];
                    }
                    $plotas = "";
                    if (isset($column[1])) {
                        $plotas = $column[1];
                    }
                    $gyvsk = "";
                    if (isset($column[2])) {
                        $gyvsk = $column[2];
                    }
                    $tel_kodas = "";
                    if (isset($column[3])) {
                        $tel_kodas = $column[3];
                    }    
                        $created_at = date("Y-m-d");
                        for($i=0;$i<salis::kiekis($salys);$i++){
                            if(($salys[$i][1]==$pavadinimas)||($salys[$i][4]==$tel_kodas)){
                                $alert=1;
                                break;
                            }
                        }
                    if ($alert==1 || empty($pavadinimas) || empty($plotas) || empty($gyvsk) || empty($tel_kodas) ) {
                        $_SESSION['error'] = "Nepavyko sėkmingai importuoti duomenis!";
                        header("Location:salys?page=1");
                    } else {
                        self::query("INSERT INTO salis (id, pavadinimas, plotas, gyvsk, tel_kodas, created_at) VALUES (null,'$pavadinimas','$plotas','$gyvsk','$tel_kodas','$created_at')");
                        $_SESSION['succ'] = "Duomenys sėkmingai importuoti!";
                        header("Location:salys?page=1");
                    }
                }
            }
        }
    }
    public function importdataM(){
        $fk_Salisid=$_POST['salis'];
        $miestai =salis::miestai($fk_Salisid,1);
        $alert=0;
        if (isset($_POST["import"])) {
    
            $fileName = $_FILES["file"]["tmp_name"];
            
            if ($_FILES["file"]["size"] > 0) {
                
                $file = fopen($fileName, "r");
                
                while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $pavadinimas="";
                    if (isset($column[0])) {
                        $pavadinimas = $column[0];
                    }
                    $plotas = "";
                    if (isset($column[1])) {
                        $plotas = $column[1];
                    }
                    $gyvsk = "";
                    if (isset($column[2])) {
                        $gyvsk = $column[2];
                    }
                    $pastokodas = "";
                    if (isset($column[3])) {
                        $pastokodas = $column[3];
                    }    
                        $created_at = date("Y-m-d");
                        for($i=0;$i<salis::kiekis($miestai);$i++){
                            if($miestai[$i][1]==$pavadinimas){
                                $alert=1;
                                break;
                            }
                        }
                    if ($alert==1 ||empty($pavadinimas) || empty($plotas) || empty($gyvsk) || empty($pastokodas) || empty($fk_Salisid) ) {
                        $_SESSION['error'] = "Nepavyko sėkmingai importuoti duomenis!";
                        header("Location:salys?miestai?salis=$fk_Salisid&page=1");
                    } else {
                        self::query("INSERT INTO miestas (id, pavadinimas, plotas, gyvsk, pastokodas, fk_Salisid, created_at) VALUES (null,'$pavadinimas','$plotas','$gyvsk','$pastokodas', '$fk_Salisid','$created_at')");
                        $_SESSION['succ'] = "Duomenys sėkmingai importuoti!";
                        header("Location:salys?miestai?salis=$fk_Salisid&page=1");
                    }
                }
            }
        }
        header("Location:miestai?salis=$fk_Salisid&page=2");
    }
    public static function sarasas($nr){
        if($nr==0){
            $var =self::query("SELECT * FROM salis WHERE pavadinimas LIKE '%$nr%'");
            if(($_POST['start']!='') && ($_POST['end']!='')){
                $start=$_POST['start'];
                $end=$_POST['end'];
                $var= self::query("SELECT * FROM salis WHERE pavadinimas LIKE '%$nr%' AND created_at  >= '$start' AND created_at <= '$end'");
            }elseif($_POST['start']!=''){
                $start=$_POST['start'];
                $var= self::query("SELECT * FROM salis WHERE pavadinimas LIKE '%$nr%' AND created_at  >= '$start'");
            }
            elseif($_POST['end']!=''){
                $end=$_POST['end'];
                $var= self::query("SELECT * FROM salis WHERE pavadinimas LIKE '%$nr%' AND  created_at <= '$end'");
            }
        }
        else{
            $var =self::query("SELECT * FROM salis");
        }
        return $var;
    }
    public static function miestai($id,$nr){
        if($nr==0){
            $var= self::query("SELECT * FROM miestas WHERE fk_Salisid = $id AND pavadinimas LIKE '%$nr%'");
            if(($_POST['start']!='') && ($_POST['end']!='')){
                $start=$_POST['start'];
                $end=$_POST['end'];
                $var= self::query("SELECT * FROM miestas WHERE fk_Salisid = $id AND pavadinimas LIKE '%$nr%' AND created_at  >= '$start' AND created_at <= '$end'");
            }elseif($_POST['start']!=''){
                $start=$_POST['start'];
                $var= self::query("SELECT * FROM miestas WHERE fk_Salisid = $id AND pavadinimas LIKE '%$nr%' AND created_at  >= '$start'");
            }
            elseif($_POST['end']!=''){
                $end=$_POST['end'];
                $var= self::query("SELECT * FROM miestas WHERE fk_Salisid = $id AND pavadinimas LIKE '%$nr%' AND  created_at <= '$end'");
            }
        }
        else{
        $var= self::query("SELECT * FROM miestas WHERE fk_Salisid = $id");
        }
        return $var;
    }   
    public static function sortSM($data){
        $length =salis::kiekis($data);
        for ($j = 0; $j < $length - 1; $j++)
        {
            for ($i = $j + 1; $i < $length; $i++)
            {
                if (strcmp($data[$j][1],$data[$i][1]) > 0)
                {
                    $temp = $data[$j];
                    $data[$j] = $data[$i];
                    $data[$i] = $temp;
                }
            }
        }
        return $data;
    }
    public static function sortSMdec($data){
        $length =salis::kiekis($data);
        for ($j = 0; $j < $length - 1; $j++)
        {
            for ($i = $j + 1; $i < $length; $i++)
            {
                if (strcmp($data[$j][1],$data[$i][1]) < 0)
                {
                    $temp = $data[$j];
                    $data[$j] = $data[$i];
                    $data[$i] = $temp;
                }
            }
        }
        return $data;
    }
    public static function miestas($id){
        $var= self::query("SELECT * FROM miestas WHERE id = $id");
        return $var;
    }
    public static function saliss($id){
        $var= self::query("SELECT * FROM salis WHERE id = $id");
        return $var;
    }
    public static function kiekis($data){
       $var =count($data);
       return $var;
    }
    public static function nSalis(){
        $pavadinimas=$_POST['pavadinimas'];
        $plotas=$_POST['plotas'];
        $gyvsk=$_POST['gyvsk'];
        $tel_kodas=$_POST['tel_kodas'];
        $created_at = date("Y-m-d");
        $salys =salis::sarasas(1);
        $alert=0;
        for($i=0;$i<salis::kiekis($salys);$i++){
            if(($salys[$i][1]==$pavadinimas)||($salys[$i][4]==$tel_kodas)){
                $alert=1;
                break;
            }
        }
        if($alert==0){
            self::query("INSERT INTO salis (id, pavadinimas, plotas, gyvsk, tel_kodas, created_at) VALUES (null,'$pavadinimas','$plotas','$gyvsk','$tel_kodas','$created_at')");
            $salis=$_GET['salis'];
            header("Location:salys?page=1");
        }
        else{
            header("Location:naujasalis");
            $_SESSION['error']="Tokia šalis jau egzistuoja!";
        }
    }
    public static function upSalis(){
        $pavadinimas=$_POST['pavadinimas'];
        $plotas=$_POST['plotas'];
        $gyvsk=$_POST['gyvsk'];
        $tel_kodas=$_POST['tel_kodas'];
        $id=$_POST['id'];
        $alert=0;
        $salys= salis::sarasas(1);
        for($i=0;$i<salis::kiekis($salys);$i++){
            if($salys[$i][0]!=$id){
                if($salys[$i][1]==$pavadinimas){
                    $alert=1;
                    break;
                }
            }
        }
        if($alert==0){
            self::query("UPDATE salis SET pavadinimas='$pavadinimas', plotas='$plotas', gyvsk='$gyvsk', tel_kodas='$tel_kodas' WHERE salis.id = $id");
            $_SESSION['succ']="Šalis sėkmingai paredaguota!";
        }
        else{
            $_SESSION['error']="Tokia šalis jau egzistuoja!";       
        }
    }
    public static function upMiestas(){
        $pavadinimas=$_POST['pavadinimas'];
        $plotas=$_POST['plotas'];
        $gyvsk=$_POST['gyvsk'];
        $pastokodas=$_POST['pastokodas'];
        $id=$_POST['id'];
        $miestai =salis::miestai($_GET['salis'],1);
        $alert=0;
        $salis=$_GET['salis'];
        for($i=0;$i<salis::kiekis($miestai);$i++){
            if($miestai[$i][0]!=$id){
                if($miestai[$i][1]==$pavadinimas){
                    $alert=1;
                    break;
                }
            }
        }
        if($alert==0){
            self::query("UPDATE miestas SET pavadinimas='$pavadinimas', plotas='$plotas', gyvsk='$gyvsk', pastokodas='$pastokodas' WHERE miestas.id = $id");
            $_SESSION['succ']="Miestas sėkmingai paredaguotas!";
        }
        else{
            $_SESSION['error']="Tokis miestas jau egzistuoja!";
        }
    }
    public static function nMiestas(){
        $pavadinimas=$_POST['pavadinimas'];
        $plotas=$_POST['plotas'];
        $gyvsk=$_POST['gyvsk'];
        $pastokodas=$_POST['pastokodas'];
        $fk_Salisid=$_POST['fk_Salisid'];
        $created_at = date("Y-m-d");
        $miestai =salis::miestai($_GET['salis'],1);
        $alert=0;
        $salis=$_GET['salis'];
        for($i=0;$i<salis::kiekis($miestai);$i++){
            if($miestai[$i][1]==$pavadinimas){
                $alert=1;
                break;
            }
        }
        if($alert==0){
            self::query("INSERT INTO miestas (id, pavadinimas, plotas, gyvsk, pastokodas, fk_Salisid, created_at) VALUES (null,'$pavadinimas','$plotas','$gyvsk','$pastokodas','$fk_Salisid','$created_at')");
           header("Location:miestai?salis=$salis&page=1");
        }
        else{
            header("Location:naujasmiestas?salis=$salis");
            $_SESSION['error']="Toks miestas jau egzistuoja!";
        }
    }
    public static function remSalis(){
        $id= $_GET['salis'];
        self::query("DELETE FROM salis WHERE salis.id = $id");
    }
    public static function remMiestai(){
        $id= $_GET['salis'];
        self::query("DELETE FROM miestas WHERE miestas.fk_Salisid = $id");
    }
    public static function remMiestas(){
        $id= $_GET['miestas'];
        self::query("DELETE FROM miestas WHERE miestas.id = $id");
    }
}
?>