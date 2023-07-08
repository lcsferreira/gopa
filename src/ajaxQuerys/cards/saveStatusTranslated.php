<?php
  include_once "../../../config.php"
?>
<?php
  $country_id = $_POST['id'];
  $value = $_POST['value'];

  //update the country table where the id is equal to the id from the request and set the indicators_step to wainting_contact
  $sql = "UPDATE countries SET country_cards_step = ? WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "s", $value);
  mysqli_stmt_execute($stmt);

  //get the country_name from the countries table where the id is equal to the id from the request
  $sql = "SELECT name FROM countries WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
  $country_name = $row['name'];

  //if the execute was successful
  if(mysqli_stmt_execute($stmt)){
    if($value == "approved"){
      echo "approved";
    }else if($value == "waiting admin"){
      $admin_emails = ["j.mejia11@uniandes.edu.co", "aravamd@gmail.com"];
      // $admin_emails = ["lucas.simoes.ferreira@gmail.com"];
      foreach ($admin_emails as $email) {
        //get time
        date_default_timezone_set('America/Bogota');
        $date = date('m/d/Y h:i:s a', time());
        //send email to admin
        $assunto = "Indicators Step - Contact completed";
            
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Workflow GoPA <info@globalphysicalactivityobservatory.com>'. "\r\n";
        $headers .= 'Reply-To: info@globalphysicalactivityobservatory.com'. "\r\n";
        $headers .= "X-Priority: 1\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
      
        $mensagem = "
        <br>
          Dear Admin,
        <br><br>
          ".$country_name." Contact has completed a step for the Country Cards 2024 Workflow on".$date.". You may view their responses here.
        <br><br>
          Please click in the <b>link below</b> to enter the 2024 GoPA! Country Cards Workflow.
        <br><br>
          <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>Workflow</a>
        <br><br>
        ";
      
        $enviaremail = mail($email, $assunto, $mensagem, $headers);
        echo "success";
      }
    }else{
      echo "success";
    }
  }else{
    echo "error";
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>