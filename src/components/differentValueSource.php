<div class="form-input diff" id="different-value-source-<?php echo $input_option?>">
  <p>Answer below, if you think there's a different data from the source and the contact need to review it.</p>
  <label for="radio-group">
    Different values from source?
  </label>
  <div class="radio" id="radio-group">
    <label for="yes">Yes</label>
    <input type="radio" id="yes" name="different-value-source-<?php echo $input_option?>" value="yes" <?php
    if($_SESSION['userType'] != "admin"){
      echo "disabled ";
    } 
    if ($admin_values['different_value_source_'.$input_option] == 1) {
      echo "checked";
    }
    ?>
    onclick="showDiffInput('<?php echo $indicator_name ?>', 'different-value-source-<?php echo $input_option?>',  '<?php echo $id ?>', '<?php echo $indicator_table_name?>_values_admin')">
    <label for="no">No</label>
    <input type="radio" id="no" name="different-value-source-<?php echo $input_option?>" value="no" <?php 
    if($_SESSION['userType'] != "admin"){
      echo "disabled ";
    }
    if ($admin_values['different_value_source_'.$input_option] == 0 && $admin_values['different_value_source_'.$input_option] != null) {
      echo "checked";
    }
    ?>
    onclick="showDiffInput('<?php echo $indicator_name ?>','different-value-source-<?php echo $input_option?>',  '<?php echo $id ?>', '<?php echo $indicator_table_name?>_values_admin')">
  </div>
</div>