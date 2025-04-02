<?
// Verifica a conexão
include "../../../config.php";

if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

// Seleciona os dados
$query = "SELECT * FROM contacts";
$stmt = $connection->prepare($query);
$stmt->execute();

$data = $stmt->get_result();

//gera um arquivo CSV
$filename = "contacts_table.xls";

// Cabeçalho
$header = array("ID", "Name", "Email", "Secondary Email", "Institution","Password", "Active", "Consent", "Last Logged In");
header("Content-type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename=' . $filename);


?>

<table style="width:100%" border='1'>
  <tr>
    <?php
    foreach ($header as $value) {
      echo "<th>$value</th>";
    }
    ?>
  </tr>
  <?php
  while ($row = $data->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['secondary_email'] . "</td>";
    echo "<td>" . $row['institution'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td>";
    if ($row['is_active'] == 1) {
      echo "Yes";
    } else {
      echo "No";
    }
    echo "</td>";
    echo "<td>";
    if ($row['consent'] == 1) {
      echo "Yes";
    } else {
      echo "No";
    }
    echo "</td>";
    echo "<td>" . $row['last_logged_in'] . "</td>";
    echo "</tr>";
  }
  ?>
</table>