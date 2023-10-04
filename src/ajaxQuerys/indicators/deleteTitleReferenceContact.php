<?php
  include_once "../../../config.php"
?>
<?php 
  $id = $_POST['id_country'];
  $inc = $_POST['inc'];
  // Query de exclusão
  $sql = "DELETE FROM national_policy_titles_reference_contact WHERE id_country = $id AND inc = $inc";

  // Executar a query
  if (mysqli_query($connection, $sql)) {
      echo "Registro excluído com sucesso!";
  } else {
      echo "Erro ao excluir o registro: " . mysqli_error($connection);
  }

  // Fechar a conexão
  mysqli_close($connection);
?>