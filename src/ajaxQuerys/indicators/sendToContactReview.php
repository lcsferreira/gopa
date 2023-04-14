<?php
  include_once "../../../config.php"
?>
<?php
  //get id from the request
  $country_id = $_POST['id'];
  $need_clarification = $_POST['clarification'];

  //update the country table where the id is equal to the id from the request and set the indicators_step to wainting_contact
  $sql = "UPDATE countries SET indicators_step = 'waiting contact' WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);

  
  //if the execute was successful
  if(mysqli_stmt_execute($stmt)){
    //get all of the contact_id in the country_contacts table where the country_id is equal to the id from the request
    $sql = "SELECT contact_id FROM country_contact WHERE country_id = $country_id";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $contact_id);
    mysqli_stmt_store_result($stmt);
    $contacts = array();
    while(mysqli_stmt_fetch($stmt)){
      array_push($contacts, $contact_id);
    }
    //for each contact_id get the email and send the email
    foreach($contacts as $contact){
      $sql = "SELECT email FROM contacts WHERE id = $contact AND is_active = 1";
      $stmt = mysqli_prepare($connection, $sql);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $email);
      mysqli_stmt_store_result($stmt);
      while(mysqli_stmt_fetch($stmt)){
        if($need_clarification == "true"){
          $assunto = "Indicators Step - Review required";
          
          $headers  = 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $headers .= 'From: Workflow GoPA <info@globalphysicalactivityobservatory.com>'. "\r\n";
          $headers .= 'Reply-To: info@globalphysicalactivityobservatory.com'. "\r\n";
          $headers .= "X-Priority: 1\r\n";
          $headers .= 'X-Mailer: PHP/' . phpversion();
        
          $mensagem = "
          <br>
            Dear Country Contact,
          <br><br>
            For the Third set of Country Cards 2024, <b>we need clarification for the data you provided for the GoPA! national policy indicators.</b> 
          <br><br>
            Please click in the <b>link below</b> to enter the 2024 GoPA! Country Cards Workflow.
          <br><br>
            <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>Workflow</a>
          <br><br>
            If you have any questions, please contact us at <a href='mailto: andrea.ramirez@globalphysicalactivityobservatory.com'>andrea.ramirez@globalphysicalactivityobservatory.com</a>
          ";
        
          $enviaremail = mail($email, $assunto, $mensagem, $headers);
        }else{
          $assunto = "Indicators Step - Review required";
          
          $headers  = 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $headers .= 'From: Workflow GoPA <info@globalphysicalactivityobservatory.com>'. "\r\n";
          $headers .= 'Reply-To: info@globalphysicalactivityobservatory.com'. "\r\n";
          $headers .= "X-Priority: 1\r\n";
          $headers .= 'X-Mailer: PHP/' . phpversion();
        
          $mensagem = "
          <br>
            Dear Country Contact,
          <br><br>
            For the Third set of Country Cards 2024, we have updated the data for the GoPA! physical activity indicators. Please log into the Workflow in order to review the indicators, make any adjustments and approve the new Country Card.
          <br><br>
            Please click in the <b>link below</b> to enter the 2024 GoPA! Country Cards Workflow.
          <br><br>
            <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/login.php'>Workflow</a>
          <br><br>
            If you have any questions, please contact us at <a href='mailto: andrea.ramirez@globalphysicalactivityobservatory.com'>andrea.ramirez@globalphysicalactivityobservatory.com</a>
          ";
        
          $enviaremail = mail($email, $assunto, $mensagem, $headers);
        }
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