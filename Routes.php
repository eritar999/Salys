<?php
session_start();
Route::set('salys', function(){
    salis::CreateView('salys');
});

Route::set('index.php', function(){
    Index::CreateView('Index');
});
Route::set('miestai', function(){
    Index::CreateView('miestai');
});

Route::set('importdata', function(){
    salis::importdata();
   // Index::CreateView('Index');
});

Route::set('importdataM', function(){
    salis::importdataM();
   // Index::CreateView('Index');
});
Route::set('naujasalis', function(){
    salis::CreateView('naujasalis');
});

Route::set('iterptisali', function(){
    salis::nSalis();
 //   salis::CreateView('salys');
});

Route::set('naujasmiestas', function(){
    salis::CreateView('naujasmiestas');
});

Route::set('iterptimiesta', function(){
    salis::nMiestas();
});

Route::set('editsalis', function(){
    salis::CreateView('editsalis');
});
Route::set('editmiestas', function(){
    salis::CreateView('editmiestas');
});

Route::set('editsalys', function(){
    salis::upSalis();
    header("Location:salys?page=1");
});
Route::set('editmiestai', function(){
    salis::upMiestas();
    $salis=$_GET['salis'];
    $page=$_GET['page'];
    header("Location:miestai?salis=$salis&page=$page");
});


Route::set('remsalis', function(){
    salis::remMiestai();
    salis::remSalis();
    $salis=$_GET['salis'];
    $_SESSION['succ']="Šalis sėkmingai pašalinta!";
    header("Location:salys?page=1");
});

Route::set('remmiestas', function(){
    salis::remMiestas();
    $salis=$_GET['salis'];
    $page=$_GET['page'];
    $_SESSION['succ']="Miestas sėkmingai pašalintas!";
    header("Location:miestai?salis=$salis&page=$page");
});
?>