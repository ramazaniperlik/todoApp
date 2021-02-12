<html>
<head>

<title>

</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link href="css/style.css" rel="stylesheet">
</head>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



<body>



<?php

include('config.php');
include('todolist.php');

$app = new TodoList( date('Ymd') );
                                    
$todolist = $app->getTodos();

$reqMethod = $_SERVER['REQUEST_METHOD'];

switch($reqMethod){
    case 'POST':
        $app->add();
        break;
    case 'GET':
        if (isset($_GET['action'])=='delete' && !empty($_GET['id'])){
            $app->delete($_GET['id']); 
        }
        else if(isset($_GET['actionn'])=='uptade' && !empty($_GET['id']))
        {
            $app->update($_GET['id']);
        }
        break;
}

$todolist = $app->getTodos();?>

<div class="items">
    <div class="div_add">
        <form action="index.php" method="post">
        <input type="text" name="mytodo" placeholder="Yapılacak ekle" />
        <input type="submit" value="Ekle" class="btn btn-danger"><hr>
        </form>
    </div>

    <div class="surukle sortable">
    
    <?php
    $k=0;
    foreach($todolist as $k=>$v){ 
        echo '
        
            <li class="">

            '.$v.'
            <form action="index.php" style="display:inline-block" >
            <input type="hidden" value="delete" name="action" />
            <input type="hidden" value="'.($k+1).'" name="id" /> 
            <input type="submit" value="sil" class="btn btn-danger" />
            </form>
            <form action="index.php" method="get" style="display:inline-block" >
            <input type="hidden" value="uptade" name="actionn" />
            <input type="hidden" value="'.($k+1).'" name="id" /> 
            
            <input type="submit" value="güncelle" class="btn btn-danger" />
            <input type="text" name="guncel" placeholder="Yapılacak Güncelleme" />
            <div class="Icon" style="display:inline-block"> <i class="fas fa-arrows-alt"></i></i> </div>
            </form>
            </li>'
            ;
    };
    ?>
    
</div>
</div>


        <script>

            $( function() {
                     $( ".surukle" ).sortable();
                    $( ".surukle" ).disableSelection();
             } );

            </script>
</body>
</html>
