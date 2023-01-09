<?php
  include_once "../../../config.php"
?>
<?php
  //get id from the request
  $country_id = $_POST['id'];

  //update the country table where the id is equal to the id from the request and set the indicators_step to wainting_contact
  $sql = "UPDATE countries SET indicators_step = 'waiting contact' WHERE id = $country_id";
  $stmt = mysqli_prepare($connection, $sql);

  
  //if the execute was successful
  if(mysqli_stmt_execute($stmt)){
    //get the contact id related in the country_contact table
    $sql = "SELECT contact_id FROM country_contact WHERE country_id = $country_id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $contact_id = $row['contact_id'];
    //send email to the contact
    $sql = "SELECT email FROM contacts WHERE id = $contact_id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];

    $assunto = "Indicators Step - Review required";
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Workflow GoPA <info@globalphysicalactivityobservatory.com>'. "\r\n";
    $headers .= 'Reply-To: info@globalphysicalactivityobservatory.com'. "\r\n";
    $headers .= "X-Priority: 1\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
  
    $mensagem = "
    <br>
      Dear country contact,
    <br><br>
      We've updated the indicators data, please review them, make any adjustments if you want or approve it.
    <br><br>
      Please click in the <b>link below</b> to go to your country's indicators progress.
    <br><br>
      <a href='http://work.globalphysicalactivityobservatory.com/src/pages/indicators/progress.php?id=$country_id'>Progress</a>
    <br><br>
      If you have any questions, please contact us at <a href='mailto: andrea.ramirez@globalphysicalactivityobservatory.com'>andrea.ramirez@globalphysicalactivityobservatory.com</a>
    ";
  
    $enviaremail = mail($email, $assunto, $mensagem, $headers);
  
    if($enviaremail){
      echo "success";
    } else {
      echo "error";
    }
  }

  mysqli_stmt_close($stmt);

  mysqli_close($connection);
?>