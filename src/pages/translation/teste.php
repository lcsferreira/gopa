
<!DOCTYPE html>
<html lang="en">
    </head>
    <body>

<?php

include '../../../config.php';
    
function verifica($country_id, $connection) {
    $indicadores = array(
        "contact",
        "demographic",
        "national_policy",
        "national_surveillance",
        "pa_prevalence",
        "pa_promotion",
        "research"
    );
    foreach ($indicadores as $indicador) {
        $result = $connection->query("SHOW COLUMNS FROM $indicador"."_agreement");
        $columns = array();
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
        foreach ($columns as $column) {
            $sql = "
                    SELECT a.$column
                    FROM $indicador"."_agreement a
                    JOIN $indicador"."_values_contact vc ON a.id = vc.id
                    WHERE a.$column  = 2 AND vc.$column IS NULL AND a.id = $country_id;
                 ";
             $result2 = $connection->query($sql);
            if ($result2->num_rows > 0) {
                return true;
            }
        }
    }
    return false;
}

?>

<?
$country_id = $_GET['id'];
echo $country_id."<br>";
if (verifica($country_id, $connection))
    echo "Algum campo vazio";
else
    echo "Ok";
?>



    </body>
    </html>