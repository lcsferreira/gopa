<?php
  include_once "../../../config.php"
?>
<?php
  //get id from url
  $payload  = $_POST['payload'];
  $id = $payload['id'];
  $name = $payload['name'];
  $email = $payload['email'];
  $secondaryEmail = $payload['secondaryEmail'];
  $institution = $payload['institution'];
  $is_active = $payload['isActive'];
  $countries = $payload['countries'];

  //insert contact in the database
  $sql = "UPDATE contacts SET name = ?, email = ?, secondary_email = ?, institution = ?, is_active = ? WHERE id='$id'";
  $stmt = mysqli_prepare($connection, $sql);
  
  mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $secondaryEmail, $institution, $is_active);
  mysqli_stmt_execute($stmt);

  if(mysqli_stmt_affected_rows($stmt) > 0){
    //countries is an array of {country,is_main}, if countries is not empty, insert into country_contact
    if(!empty($countries)){
      foreach($countries as $country){
        $country_id = $country['country_id'];
        $is_main = $country['is_main'];
        //if country_id and contact_id don't exist in country_contact, insert
        $sql = "SELECT * FROM country_contact WHERE country_id = '$country_id' AND contact_id = '$id'";
        $result = mysqli_query($connection, $sql);
        if(mysqli_num_rows($result) == 0){
          $sql = "INSERT INTO country_contact (country_id, contact_id, is_main) VALUES (?, ?, ?)";
          $stmt = mysqli_prepare($connection, $sql);
          mysqli_stmt_bind_param($stmt, "iii", $country_id, $id, $is_main);
          mysqli_stmt_execute($stmt);
          if(mysqli_stmt_affected_rows($stmt) > 0){
            echo "success";
          }
        }
        //else update
        else{
          $sql = "UPDATE country_contact SET is_main = ? WHERE country_id = '$country_id' AND contact_id = '$id'";
          $stmt = mysqli_prepare($connection, $sql);
          mysqli_stmt_bind_param($stmt, "i", $is_main);
          mysqli_stmt_execute($stmt);
          if(mysqli_stmt_affected_rows($stmt) > 0){
            echo "success";
          }
        }
      }
    }
    if($is_active == 1){
      //send email to contact
      //get the id of the contact that was just inserted
      // firstAccess.php?id='$contact_id'

      $assunto = "Action Required";
    
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: Workflow GoPA <info@globalphysicalactivityobservatory.com>'. "\r\n";
      $headers .= 'Reply-To: info@globalphysicalactivityobservatory.com'. "\r\n";
      $headers .= "X-Priority: 1\r\n";
      $headers .= 'X-Mailer: PHP/' . phpversion();
    
      $mensagem = "
      <br>
        This is an authomatic activation message for Contacts.
      <br><br>
        Please click in the <b>link below</b> to login in the GoPA Workflow.
      <br><br>
        <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/firstAccess.php?id=$id&userType=contact'>First access registration</a>
      <br><br>
        If you have any questions, please contact us at <a href='mailto: andrea.ramirez@globalphysicalactivityobservatory.com'>andrea.ramirez@globalphysicalactivityobservatory.com</a>
      ";
    
      $enviaremail = mail($email, $assunto, $mensagem, $headers);
    
      if($enviaremail){
        $mgm = "E-MAIL ENVIADO COM SUCESSO!";
        echo "success!";
      } else {
        $mgm = "ERRO AO ENVIAR E-MAIL!";
        echo $mgm;
      }
    }
    echo "success";
  }
  mysqli_stmt_close($stmt);
  mysqli_close($connection);
  
  ?>