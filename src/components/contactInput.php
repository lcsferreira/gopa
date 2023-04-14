<div class="form-input" id="<?php echo $indicator_name ?>">
    <p>Provide the new information here: </p>
    <label for="<?php echo $indicator_name ?>"><?php echo $indicator_title ?></label>
    <input type="<?php echo $indicator_type ?>" <?php
    if($_SESSION['userType'] == "admin"){
      echo "disabled ";
    }
    if($contact_values[$indicator_name] != null){
      echo "value='" . $contact_values[$indicator_name] ."'";
    }
  ?> name="<?php echo $indicator_name ?>" onblur="saveValueByContact('<?php echo $indicator_name ?>', '<?php echo $id ?>', '<?php echo $indicator_table_name ?>')">
</div>