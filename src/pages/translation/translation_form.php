<?php
// Verificação inicial de autenticação
session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== "1"){
  header("location: ../login/login.php");
  exit();
}

// Inclusão das configurações e bibliotecas necessárias
include_once "../../../config.php";
include '../../../email_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';

// Função para salvar uma tradução individual
function saveTranslation($connection, $country_id, $field, $value) {
  $value = mysqli_real_escape_string($connection, $value);
  
  // Verifica se já existe uma tradução para este país
  $check_sql = "SELECT country_id FROM translations WHERE country_id = $country_id";
  $result = $connection->query($check_sql);
  
  if ($result->num_rows > 0) {
    // Atualiza a tradução existente
    $sql = "UPDATE translations SET $field = '$value' WHERE country_id = $country_id";
  } else {
    // Cria uma nova tradução
    $sql = "INSERT INTO translations (country_id, $field) VALUES ($country_id, '$value')";
  }
  
  return $connection->query($sql);
}

// Função para enviar email de notificação
function sendNotificationEmail($connection, $country_id, $country_name) {
  global $dreamhost, $host_username, $host_password, $host_port;
  
  $admin_emails = ["lucas.simoes.ferreira@gmail.com"];
  date_default_timezone_set('America/Bogota');
  $date = date('m/d/Y h:i:s a', time());
  
  foreach ($admin_emails as $email) {
    try {
      $mail = new PHPMailer(true);
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host = $dreamhost;
      $mail->SMTPAuth = true;
      $mail->Username = $host_username;
      $mail->Password = $host_password;
      $mail->SMTPSecure = 'ssl';
      $mail->Port = $host_port;
      $mail->setFrom($host_username, 'GoPA! Workflow');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = "Translation Step - Contact completed";
      
      $mail->Body = "
      <br>
      Dear Admin,
      <br><br>
      $country_name Contact has completed the translation step for the Country Cards 2024 Workflow on $date. You may view their responses <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>here</a>.
      <br><br>
      Please click in the <b>link below</b> to enter the 2024 GoPA! Country Cards Workflow.
      <br><br>
      <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>Workflow</a>
      <br><br>
      ";
      
      $mail->send();
    } catch (Exception $e) {
      error_log("Erro ao enviar o e-mail: " . $e->getMessage());
      error_log("Detalhes: " . $mail->ErrorInfo);
    }
  }
}

// IMPORTANTE: Processar requisições AJAX antes de qualquer saída HTML
// Processar requisição AJAX para salvar tradução individual
if (isset($_POST['action']) && $_POST['action'] === 'save_translation') {
  $country_id = $_POST['country_id'];
  $field = $_POST['field'];
  $value = $_POST['value'];
  
  $result = saveTranslation($connection, $country_id, $field, $value);
  echo $result ? "success" : "error";
  exit;
}

// Processar seleção de idioma padrão via AJAX
if (isset($_POST["language"]) && !empty($_POST["language"])) {
  $selected_language = $_POST["language"];
  $country_id = $_POST['country_id'];
  
  // Cria a lista de colunas s1 a s60
  $columns = implode(', ', array_map(function ($i) {
    return "s" . ($i + 1);
  }, range(1, 59)));
  
  // Verifica se já existem traduções e remove
  $check_sql = "DELETE FROM translations WHERE country_id = $country_id";
  $connection->query($check_sql);
  
  // Copia as traduções do idioma selecionado
  $copy_sql = "INSERT INTO translations (country_id, id, $columns) 
                SELECT $country_id, 0, $columns 
                FROM language_translations 
                WHERE language = '$selected_language' LIMIT 1";
  
  $result = $connection->query($copy_sql);
  echo $result ? "success" : "error";
  exit;
}

// A partir daqui começam as inclusões que podem gerar saída HTML
$title = "Translation";

// Verificar se estamos em uma requisição AJAX
$is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// Incluir o header apenas se não for uma requisição AJAX
if (!$is_ajax) {
  include "../../components/header.php";
}

// Processar envio final do formulário
if (isset($_POST['submit'])) {
  $country_id = $_POST['country_id'];
  
  // Atualiza o status do país
  $sql = "UPDATE countries SET translation_step = 'approved' WHERE id = $country_id";
  if ($connection->query($sql)) {
    // Busca o nome do país para o email
    $sql = "SELECT name FROM countries WHERE id = $country_id";
    $result = $connection->query($sql);
    $country_name = $result->fetch_assoc()['name'];
    
    // Envia email de notificação
    sendNotificationEmail($connection, $country_id, $country_name);
    
    // Redireciona para a lista de países
    echo "<script>window.location.href = '../countriesList/countriesListContacts.php?id=".$country_id."';</script>";
    exit;
  }
}

// Carregar dados necessários para a página
$country_id = $_GET['id'];
$user = $_SESSION['userType'] === "admin" ? 0 : 1;

// Buscar perguntas
$sql_questions = "SELECT * FROM translation_questions WHERE id = 1";
$result = $connection->query($sql_questions);
$questions = $result->fetch_assoc();

// Buscar traduções existentes
$sql = "SELECT * FROM translations WHERE country_id = $country_id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
$has_data = $result->num_rows > 0;

// Buscar idiomas disponíveis
$sql = "SELECT DISTINCT language FROM language_translations ORDER BY language";
$result1 = $connection->query($sql);

// Se for uma requisição AJAX, encerrar o script aqui
if ($is_ajax) {
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Translation</title>
  <link rel="stylesheet" href="../../../css/pages/translation/translation.css">
  <link rel="stylesheet" href="../../../css/components/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
  /* Estilos para as notificações */
  .notification {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 10px 20px;
    border-radius: 4px;
    color: white;
    font-weight: bold;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    z-index: 1000;
    background-color: #4CAF50;
  }

  .notification.show {
    opacity: 1;
  }

  /* Adaptações para mobile */
  @media (max-width: 768px) {
    .notification {
      bottom: 10px;
      right: 10px;
      left: 10px;
      text-align: center;
    }
  }
  </style>
</head>

<body>
  <div class="container" id="main">
    <?php include_once "../../components/modalConfirm.php"; ?>

    <div class="title mt-50">
      <h1>Translation</h1>
      <p>Please translate the following sentences into your country's native language. If your language is available in
        the dropdown list, select it and click on 'Use as default language.'
        If your language is not listed, we kindly ask that you help us by adding the translation in the text boxes.</p>
    </div>

    <form id="languageForm" style="flex-direction: row; gap: 30px">
      <input type="hidden" name="country_id" value="<?php echo $country_id; ?>">
      <label for="language">Language:</label>
      <select name="language" id="language" <?php if ($user == 0) echo "disabled";?>>
        <option value="" selected>Select</option>
        <?php
          if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
              echo "<option value='" . $row1["language"] . "'>" . $row1["language"] . "</option>";
            }
          }
        ?>
      </select>
      <button class="btn-confirm" type="submit" name="copy_data" <?php if ($user == 0) echo "disabled";?>>Use as Default
        Language</button>
      <?php if ($user == 0) {
        echo "<button class='btn-back' type='button' onclick='document.location = `export_translation_csv.php?country_id=".$country_id."&delimiter=auto`'>Export CSV</button>";
      } ?>
    </form>

    <div class="forms-container">
      <form method="post" id="translationForm">
        <input type="hidden" name="country_id" value="<?php echo $country_id; ?>">
        <table border="0">
          <?php 
            $iterationIndex = 1;
            foreach ($questions as $key => $question) {
              if ($key === "id") continue;
              echo "<tr>";
              echo "<td>".$iterationIndex.". ".$question."</td>";
              echo "<td>
                <textarea ".($user == 0 ? "disabled" : "")." rows='5' cols='60' name='".$key."' class='translation-field' data-field='".$key."' maxlength='255'>".($has_data ? $row[$key] : "")."</textarea>
              </td>";
              echo "</tr>";
              $iterationIndex++;
            }
          ?>
        </table>
        <?php if ($user != 0) echo "<div class='conclusion'><input class='btn-confirm' type='button' name='confirmval' value='Send to GoPA' onclick='confirmation()'><input class='btn-confirm' type='submit' name='submit' value='Send to GoPA' hidden></div>";?>
        <?php if ($user == 0) echo "<div class='buttons'><button class='btn-back' type='button' onclick='document.location = `../countriesList/countriesListAdmin.php`'>Back</button></div>";?>
      </form>
    </div>

    <!-- Container para notificações -->
    <div id="notification" class="notification"></div>
  </div>

  <footer>
    <p><a target="_noblank" href="https://new.globalphysicalactivityobservatory.com/privacy-policy/">Privacy Policy</a>
      © 2023 GoPA. All rights reserved.
    </p>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script>
  $(document).ready(function() {
    // Função simples para mostrar notificação
    function showNotification(message) {
      const notification = $('#notification');
      notification.text(message);
      notification.addClass('show');

      setTimeout(function() {
        notification.removeClass('show');
      }, 2000);
    }

    // Salvamento automático ao digitar
    let timeout;
    $('.translation-field').on('input', function() {
      const field = $(this).data('field');

      clearTimeout(timeout);
      timeout = setTimeout(() => {
        const value = $(this).val();

        // AJAX simplificado
        $.ajax({
          url: 'translation_form_v1.php',
          method: 'POST',
          data: {
            action: 'save_translation',
            country_id: <?php echo $country_id; ?>,
            field: field,
            value: value
          },
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          },
          success: function(response) {
            // Mostra notificação de salvamento bem-sucedido
            if (response.trim() === "success") {
              showNotification('Translation saved');
            }
          }
        });
      }, 1000);
    });

    // Processamento simplificado do formulário de idioma
    $('#languageForm').on('submit', function(e) {
      e.preventDefault();

      // Verifica se um idioma foi selecionado
      const selectedLanguage = $('#language').val();
      if (!selectedLanguage) {
        alert('Please select a language before continuing.');
        return;
      }

      // Mostra notificação
      showNotification('Loading language...');

      // Envia a requisição simplificada
      $.ajax({
        url: 'translation_form_v1.php',
        method: 'POST',
        data: $(this).serialize(),
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
          // Recarrega a página independentemente da resposta
          showNotification('Language loaded. Reloading page...');
          setTimeout(function() {
            location.reload();
          }, 1000);
        },
        error: function() {
          // Recarrega a página mesmo em caso de erro
          setTimeout(function() {
            location.reload();
          }, 1000);
        }
      });
    });
  });
  </script>
  <script src="../../js/translation/translation.js"></script>
  <script src="../../js/sidebarMenu.js"></script>
</body>

</html>