<?php $tabella=$_GET["tabella"];
if(!isSet($_GET['page'])) $page=1;
else $page=$_GET['page']; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="scripts/Sorter.js"></script>
    <script src="scripts/Research.js"></script>
    <script src="scripts/AJAX.js"></script>
    <title>Mediaworld</title>
</head>

<body onload="selection('Select.php',<?php echo $page ?>,'<?php echo $tabella ?>','0','0','0');">

    <!-- navbar -->
    <nav class="navbar navbar-inverse" id="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">
                <?php if($tabella=='giacenzemilano') echo('Giacenze Milano');
                else if($tabella=='carichirimini') echo('Carichi Rimini');
                else if($tabella=='maggiorcosto') echo('Maggior Costo'); ?> </a>
            </div>
            <span class="nav navbar navbar-form navbar-left">
                    <img alt src="mediaworld_nav.png" style="height:30px;width:160px">
                    <button type="submit" id='giacenzemilano' class='btn-danger' style="margin-left:130px;margin-right:10px;font-size:13px;width:120px" onclick="window.location.href='Crud.php?tabella=giacenzemilano'"> Giacenze Milano </button>
                    <button type="submit" id='carichirimini' class='btn-danger' style="margin-right:10px;font-size:13px;width:120px" onclick="window.location.href='Crud.php?tabella=carichirimini'"> Carichi Rimini  </button>
                    <button type="submit" id='maggiorcosto' class='btn-danger' style="margin-right:10px;font-size:13px;width:120px" onclick="window.location.href='Crud.php?tabella=maggiorcosto'"> Maggior Costo </button>
            </span>
            <div class="container">
            <span class="nav navbar-form navbar-right">
                <span class="form-group has-feedback">
                <span class="search-control">
                    <input type='search' id='research'  placeholder='Cerca...' onkeyup="resetResearch('<?php echo $tabella ?>');">
                    <button class="btn-danger" onclick="selection('Select.php',<?php echo $page ?>,'<?php echo $tabella ?>',$('#research').val(),'0',$('#research').val());"><span class='glyphicon glyphicon-search'></span></button>
                </span>
                </span>
            </span>
            </div>
        </div>
    </nav>
       
    <div class="container">
    
        <p class="alert alert-info" id="info" hidden></p>
        <div id="id_table">   
        </div>   
    </div>
    <p id="prova"></p>
</body>
</html>