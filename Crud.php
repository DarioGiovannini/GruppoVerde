<?php session_start();
    if(!(isset($_SESSION["Utente"]) && isset($_SESSION["Password"]) && isset($_SESSION['Ruolo']))) header("location:index.php");
    include("config.php");
    $view=$_GET['view'];
    $tabella=$_GET['tabella'];
    if(($tabella!="tblprodotti" || $view!="viewprodotti") && $_SESSION['Ruolo']!="Amministratore") 
    {
        $tabella="tblprodotti";
        $view="viewprodotti";
    }
    $colonne="SHOW COLUMNS FROM $tabella";
    $stmt=$db->prepare($colonne);
    $stmt->execute();
    $string="";
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nomeid=$row['Field'];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $field=$row['Field'];
    $string.="$(\"#$field\"),";
    }
    $string=substr($string,0,-1);   
?>
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
<body onload="selection('Select.php','<?php echo $view; ?>',1);">

    <!-- navbar -->
    <nav class="navbar navbar-inverse" id="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Crud</a>
            </div>
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
    <form action="index.php"> 
    <h4>Nome: <?php echo $_SESSION["Utente"]?></h4>
    <h4><button type="submit" class='btn btn-primary' name='btnlogout' value="1">logout</button></h4>
    </form>

    <?php 
    if(($_SESSION['Ruolo']=="Amministratore" && $tabella=="tblprodotti") || $tabella!="tblprodotti"){
        echo"<form action='Admin.php'>
        <button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-arrow-left'></span></button>
        </form>";
        if( $tabella!="tbllog"){ 
            echo"
        
            <div class='container' style='align-right' id='mostra'> 
                <button type='submit' class='btn success' data-toggle='modal' data-target='#myModal' onclick='formAggiungi(\"$view\",\"$tabella\",tag=[$string]);'>
                <span class='glyphicon glyphicon-plus'></span></button>
                <button type='submit' class='btn btn-danger' name='btnDelete' onclick='cancella(\"$view\",\"$tabella\",\"$nomeid\",\"Select.php\");' id='btnDelete'><span class='glyphicon glyphicon-minus'></span></button>
                <button type='submit' class='btn btn-primary' name='btnUpdate' data-toggle='modal' data-target='#myModal' onclick='formAggiorna(\"$view\",\"$tabella\", tag=[$string]);' id='btnUpdate'>
                <span class='glyphicon glyphicon-pencil'></span></button>
                <div class='modal fade' id='myModal' role='dialog'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <p id='titolo'></p>
                        </div>
                        <div class='modal-body'>";
                        $colonne="SHOW COLUMNS FROM $tabella";
                        $stmt=$db->prepare($colonne);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $field=$row['Field'];
                        if($field=="IdMagazzino") 
                        {
                            echo "<label>Magazzino:</label> <select name='Magazzino' id='IdMagazzino'>";
                            $mag = "SELECT DescrizioneMagazzino,IdMagazzino FROM tblmagazzini";
                            $conn=$db->prepare($mag);
                            $conn->execute();
                            while($riga =$conn->fetch(PDO::FETCH_ASSOC)) {
                                $Magazzino=$riga["DescrizioneMagazzino"];
                                $Id=$riga["IdMagazzino"];
                                echo "<option value='$Id'> $Magazzino</option>";
                            }
                            echo "</select>";
                        }
                        else if($field=="Abilitato") echo"<label for='Abilitato'>Abilitato:</label>
                        <select class='form-control' name='Abilitato' id='Abilitato'>
                            <option value='0'> 0 </option>
                            <option value='1'> 1 </option>
                        </select>
                        <br>";
                        else if($field=="IdRuolo") echo "<label for='IdRuolo'>Ruolo:</label>
                        <select class='form-control' name='IdRuolo' id='IdRuolo'>
                            <option value='1'> Amministratore </option>
                            <option value='2'> Ospite </option>
                        </select>";
                        else echo"<label for='$field'>$field:</label>
                        <input type='text' class='form-control' name='$field' id='$field' placeholder='$field' required>
                        <br>";               
                        }
                               
        
            echo"
                        </div>
                        <div class='modal-footer'>
                            <br>
                            <br>
                            <button type='button' class='btn btn-success' id='insert' data-dismiss='modal'><span class='glyphicon glyphicon-ok'></span> Inserisci</button>
                            <button type='button' class='btn btn-danger' id='annulla' onclick='annulla();' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Annulla </button>
                            <p class='alert alert-danger' id='error' hidden></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
            }
    }
    
        ?>
       
    <div class="container">
        <span class="glyphicon glyphicon-info-sign" onmouseover="info();" onmouseout="resetInfo();" id="information"></span>
        <br>
        <p class="alert alert-info" id="info" hidden></p>
        <table class="table table-hover" id="id_table">
        </table>
    </div>   
    
    <p id="prova"></p>
</body>
</html>