<?php 
  //include config.php
  include_once "../../../config.php";
  //get id from the request
  $country_id = $_POST['id'];

  //select the name from the country where the id is equal to the id from the request
  $sql = "SELECT name FROM countries WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $country_name);
  mysqli_stmt_store_result($stmt);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);


  //update countries table of value translation_step to 'waiting_contact' where id = $_POST['id']
  $sql = "UPDATE countries SET translation_step = 'waiting contact' WHERE id = ".$_POST['id'];
  $stmt = mysqli_prepare($connection, $sql);
  //execute sql query
  if(mysqli_stmt_execute($stmt)){
    $sql = "SELECT contact_id FROM country_contact WHERE country_id = $country_id";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $contact_id);
    mysqli_stmt_store_result($stmt);
    $contacts = array();
    while(mysqli_stmt_fetch($stmt)){
      array_push($contacts, $contact_id);
    }

    foreach ($contacts as $contact) {
      $sql = "SELECT email FROM contacts WHERE id = $contact AND is_active = 1";
      $stmt = mysqli_prepare($connection, $sql);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $email);
      mysqli_stmt_store_result($stmt);
      while (mysqli_stmt_fetch($stmt)) {
        $assunto = "Indicators Step - Review required";
  
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Workflow GoPA <info@globalphysicalactivityobservatory.com>'. "\r\n";
        $headers .= 'Reply-To: info@globalphysicalactivityobservatory.com'. "\r\n";
        $headers .= "X-Priority: 1\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();
      
        $mensagem = "
        <br>
          Dear ".$country_name." Contact,
        <br><br>
          For the Third set of Country Cards 2024, if your country has a native language that is not English, you will be asked to work with us to produce a translated version. Please log into the workflow in order to begin the <b>translation.</b>
        <br><br>
          Please click in the <b>link below</b> to enter the 2024 GoPA! Country Cards Workflow.
        <br><br>
          <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>TWorkflow</a>
        <br><br>
          If you have any questions, please contact us at <a href='mailto: andrea.ramirez@globalphysicalactivityobservatory.com'>andrea.ramirez@globalphysicalactivityobservatory.com</a>
        ";
      
        $enviaremail = mail($email, $assunto, $mensagem, $headers);
      }
  }
    if($enviaremail){
      echo "success";
    } else {
      echo "error";
    }
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>