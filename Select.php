<?php
session_start();
$tabella=$_GET['tabella'];
include("Config.php");
$colonne="SHOW COLUMNS FROM $tabella";
$stmt=$db->prepare($colonne);
$stmt->execute();
if($tabella=="maggiorcosto") 
{
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<table align='center'>";
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $sql = "SELECT * FROM $tabella";
    $paragrafo=$db->prepare($sql);
    $paragrafo->execute();
    $row = $paragrafo->fetch(PDO::FETCH_ASSOC);
    echo "<tr> ";
    echo "<td><h3 style='margin:30px'>" .  $row['Prodotto'] ."</h3></td>";
    echo "<td><h3 style='margin:30px'> € " .  $row['Prezzo'] ."</h3></td>";
    echo "</tr></table>";



}
echo "
    <table class='table table-hover'>
    <thead>
    <tr>";
$i=0;
$sql = "SELECT * FROM $tabella";
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if($i==0 && $_GET["ricerca"]!="0") $sql = $sql . " WHERE " . $row['Field'] . " like '%".$_GET['Campo']."%'";
    if($_GET["ricerca"]!="0" && $i!=0 ) $sql = $sql . " OR " . $row['Field'] . " like '%".$_GET['Campo']."%'";
    echo "<th>". $row['Field'] ."<button class=' btn-primary' style='margin-left:5px' onclick='selection(\"Select.php\",\"$tabella\",\"".$row['Field']."\",\"ASC\",\"0\");'> <i class='glyphicon glyphicon-arrow-up'> </i> </button>  <button class=' btn-primary'  style='margin-left:5px'  onclick='selection(\"Select.php\",\"$tabella\",\"".$row['Field']."\",\"DESC\",\"0\");'> <i class='glyphicon glyphicon-arrow-down'> </i> </button></th>";
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
        if($tabella=="maggiorcosto" && $i==0){
            $rows = $field->fetch(PDO::FETCH_ASSOC);
            $rows = $field->fetch(PDO::FETCH_ASSOC);
        }   
        $Campo=$rows['Field'];
        
        if($Campo=="Prezzo") $Campo = "€ ".$row[$Campo];
        else if($Campo=="Data") $Campo=substr($row[$Campo],6,2) . "/" . substr($row[$Campo],4,2) . "/" .  substr($row[$Campo],0,4) ;
        else $Campo=$row[$Campo];
        if($i==0) $id=$Campo;
        echo "<td>$Campo</td>";
        $i++;
    }
}
echo "</table>";




