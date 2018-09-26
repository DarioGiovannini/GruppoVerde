<?php
session_start();
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
        if($Campo=="Prezzo") $Campo = "€ ".$row[$Campo];
        else if($Campo=="Data") 
        else $Campo=$row[$Campo];
        if($i==0) $id=$Campo;
        echo "<td onclick='sorting($i)'>$Campo</td>";
        $i++;
    }
}




