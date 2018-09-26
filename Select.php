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
$sql = "SELECT * FROM $tabella";
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if($i!=0 && $_GET["ricerca"]!="0") $sql = $sql . " OR";
    if($_GET["ricerca"]!="0") $sql = $sql . " WHERE " . $row['Field'] . " like '%".$row['Field']."%'";
    echo "<th>". $row['Field'] ."<button class=' btn-primary' style='margin-left:5px' onclick='selection(\"Select.php\",\"$tabella\",\"".$row['Field']."\",\"ASC\");'> <i class='glyphicon glyphicon-arrow-up'> </i> </button>  <button class=' btn-primary'  style='margin-left:5px'  onclick='selection(\"Select.php\",\"$tabella\",\"".$row['Field']."\",\"DESC\");'> <i class='glyphicon glyphicon-arrow-down'> </i> </button></th>";
    $i++;
}
echo "
    </tr>
    </thead>";

if($_GET["ordine"]!="0") $sql = $sql . " ORDER BY " . $_GET["Campo"] . " " . $_GET["ordine"];
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
        else if($Campo=="Data") $Campo=substr($row[$Campo],6,2) . "/" . substr($row[$Campo],4,2) . "/" .  substr($row[$Campo],0,4) ;
        else $Campo=$row[$Campo];
        if($i==0) $id=$Campo;
        echo "<td>$Campo</td>";
        $i++;
    }
}




