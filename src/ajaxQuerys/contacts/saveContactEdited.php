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
  
  $is_active_changed = false;
  $sql = "SELECT is_active FROM contacts WHERE id = '$id'";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);
  $old_is_active = $row['is_active'];
  //insert contact in the database
  $sql = "UPDATE contacts SET name = ?, email = ?, secondary_email = ?, institution = ?, is_active = ? WHERE id='$id'";
  $stmt = mysqli_prepare($connection, $sql);
  
  mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $secondaryEmail, $institution, $is_active);
  mysqli_stmt_execute($stmt);

  //if the is_active changed, set a variable to true
  if($old_is_active != $is_active){
    $is_active_changed = "true";
  }

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
  if($is_active == 1 && $is_active_changed == "true"){
    //send email to contact
    //get the id of the contact that was just inserted
    // firstAccess.php?id='$contact_id'

    $assunto = "Action Required -  GoPA! Country Contact registration instructions - new GoPA! data review and Country Card approval system";
  
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Workflow GoPA <info@globalphysicalactivityobservatory.com>'. "\r\n";
    $headers .= 'Reply-To: info@globalphysicalactivityobservatory.com'. "\r\n";
    $headers .= "X-Priority: 1\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
  
    $mensagem = "
    <br>
    This is an automatic user activation message for the GoPA! Country Contacts registration system. This is the new system for the Country Cards 2024 review and approval.
    <br><br>
    Click here to go to the Workflow guide:
    <br><br>
    <a href='https://app.tango.us/app/workflow/Workflow-for-the-Third-set-of-Country-Cards-2024-review---Global-Observatory-for-Physical-Activity---GoPA--62dcab470a92458ab014ab69f2bbba0c'>English</a>
    <a href='https://app.tango.us/app/workflow/Workflow-para-la-revisi-n-del-Tercer-set-de-Country-Cards-2024---Observatorio-Global-de-Actividad-F-sica---GoPA--8d540b43a94b4fd99f953839ab3b0217'>Spanish</a>
    <br><br>
    Please click on the link below to log in to the GoPA workflow. This is a link that will allow you to create the password.
    <br><br>
      <a href='http://work.globalphysicalactivityobservatory.com/src/pages/login/firstAccess.php?id=$id&userType=contact'>First-time registration</a>
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
  mysqli_stmt_close($stmt);
  mysqli_close($connection);
  
  ?>