<?php $tabella=$_GET["tabella"];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script language="JavaScript" type="text/JavaScript" src="scripts/Sorter.js"></script>
    <script language="JavaScript" type="text/JavaScript" src="scripts/Research.js"></script>
    <script language="JavaScript" type="text/JavaScript" src="scripts/AJAX.js"></script>
</head>

<body onload="selection('Select.php','<?php echo $tabella ?>','0','0','0');">

    <!-- navbar -->
    <nav class="navbar navbar-inverse" id="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">
                <?php if($tabella=='giacenzemilano') echo('Giacenze Milano');
                else if($tabella=='carichirimini') echo('Carichi Rimini');
                else if($tabella=='maggiorcosto') echo('Maggior Costo'); ?> </a>
            </div>
            <ul class="nav navbar-form navbar-left">
                    <button type="submit" class='btn-primary' style="margin-left:200px;margin-right:10px;font-size:13px;width:120px" onclick="window.location.href='Crud.php?tabella=giacenzemilano'"> Giacenze Milano </p> </button>
                    <button type="submit" class='btn-primary' style="margin-right:10px;font-size:13px;width:120px" onclick="window.location.href='Crud.php?tabella=carichirimini'"> Carichi Rimini </p> </button>
                    <button type="submit" class='btn-primary' style="margin-right:10px;font-size:13px;width:120px" onclick="window.location.href='Crud.php?tabella=maggiorcosto'"> Maggior Costo </p> </button>
            </ul>
            <div class="container">
            <ul class="nav navbar-form navbar-right">
                <div class="form-group has-feedback">
                <div class="search-control">
                    <input type='search' id='research'  placeholder='Cerca...'>
                    <button class="btn-primary" onclick="selection('Select.php','<?php echo $tabella ?>',$('#research').val(),'0','1');"><span class='glyphicon glyphicon-search'></span></button>
                </div>
                </div>
            </ul>
            </div>
        </div>
    </nav>
       
    <div class="container">
    
        <p class="alert alert-info" id="info" hidden></p>
        <div id="id_table">   
        </div>   
    
    <p id="prova"></p>
</body>
</html>