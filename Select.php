<?php
session_start();
if(!(isset($_SESSION["Utente"]) && isset($_SESSION["Password"]) && isset($_SESSION['Ruolo']))) header("location:index.php");
//creazione connessione
$tabella=$_GET['tabella'];
include("Config.php");
$colonne="SHOW COLUMNS FROM $tabella";
$stmt=$db->prepare($colonne);
$stmt->execute();
echo "
    <thead>
    <tr>";
$i=0;
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<th onclick='sorting($i)'>". $row['Field'] ."</th>";
    $i++;
}
echo "
    </tr>
    </thead>";
$sql = "SELECT * FROM $tabella";
$stmt=$db->prepare($sql);
$stmt->execute();
while(  $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $colonne="SHOW COLUMNS FROM $tabella";
    $field=$db->prepare($colonne);
    $field->execute();
    echo "<tr>";
    $i=0;
    while($rows = $field->fetch(PDO::FETCH_ASSOC)) {     
        $Campo=$rows['Field'];
        $Campo=$row[$Campo];
        if($i==0) $id=$Campo;
        echo "<td onclick='sorting($i)'>$Campo</td>";
        $i++;
    }
    echo "<td> <input type='radio' name='seleziona' value='$id' onclick='Abilita()'> </td>";          
    echo "</tr>";
}
if($_GET['log']==1){
    try{
        $db->beginTransaction();
        $Descrizione="Tabella $tabella visualizzata";
        include("InsertLog.php");
        $db->commit();
    }
    catch(PDOException $e){
        $db->rollBack();
        echo $e->getMessage(); 
    }
    
}



