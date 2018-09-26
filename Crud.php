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

<body onload="selection('Select.php','<?php echo $tabella ?>');">

    <!-- navbar -->
    <nav class="navbar navbar-inverse" id="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand"> Giacenze Milano </a>
            </div>
            <ul class="nav navbar-form navbar-left">
                <div class="form-group has-feedback">
                    <button type="submit" class='btn-primary' style="margin-left:200px;margin-right:10px;font-size:13px;width:120px"> Giacenze Milano </p> </button>
                    <button type="submit" class='btn-primary' style="margin-right:10px;font-size:13px;width:120px"> Carichi Rimini </p> </button>
                    <button type="submit" class='btn-primary' style="margin-right:10px;font-size:13px;width:120px"> Maggior Costo </p> </button>
                </div>
            </ul>
            <div class="container">
            <ul class="nav navbar-form navbar-right">
                <div class="form-group has-feedback">
                    <input type='text' id='research' class='form-control' onkeyup='Ricerca();' placeholder='Cerca...'>
                    <i class="glyphicon glyphicon-search form-control-feedback"></i>
                </div>
            </ul>
            </div>
        </div>
    </nav>
       
    <div class="container">
    
        <p class="alert alert-info" id="info" hidden></p>
        <table class="table table-hover" id="id_table">
        </table>
    </div>   
    
    <p id="prova"></p>
</body>
</html>