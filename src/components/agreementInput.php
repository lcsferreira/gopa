<div class="form-input">
  <div class="radio-agreement" id="radio-group">
    <div>
      <input type="radio" id="yes" name="agreement-<?php echo $agreement_order ?>" value="yes" onclick="hideInput('agreement-<?php echo $agreement_order ?>','<?php echo $indicator_name?>',  '<?php echo $id ?>', '<?php echo $indicator_table_name ?>')" <?php if($_SESSION['userType'] == "admin"){
        echo "disabled ";
      } 
      if($agreement_values[$indicator_name] == 2){
        echo "checked";
      }?>>
      <label for="yes">The information provided is <b>correct</b> and up to date and should be included on the new 2024 Country Card.</label>
    </div>
    <div>
      <input type="radio" id="no" name="agreement-<?php echo $agreement_order ?>" value="no" onclick="showInput('agreement-<?php echo $agreement_order ?>','<?php echo $indicator_name?>',  '<?php echo $id ?>', '<?php echo $indicator_table_name ?>')" <?php if($_SESSION['userType'] == "admin"){
        echo "disabled ";
      }if($agreement_values[$indicator_name] == 1 && $agreement_values[$indicator_name] != null){
        echo "checked";
      }?>>
      <label for="no">The information provided is <b>correct</b> and up to date and should be included in the new Country Card 2024. Furthermore, I <b>wish to provide</b> additional information that should also be included in the new Country Card 2024.</label>
    </div>
    <div>
      <input type="radio" id="no-edit" name="agreement-<?php echo $agreement_order ?>" value="no-edit" onclick="showInput('agreement-<?php echo $agreement_order ?>','<?php echo $indicator_name?>',  '<?php echo $id ?>', '<?php echo $indicator_table_name ?>')" <?php if($_SESSION['userType'] == "admin"){
        echo "disabled ";
      }if($agreement_values[$indicator_name] == 0 && $agreement_values[$indicator_name] != null){
        echo "checked";
      }?>>
      <label for="no"> The information provided is <b>out of date</b> and should not be included in the new Country Card 2024. Therefore, I <b>wish to provide</b> the updated information that should be included in the new Country Card 2024.</label>
    </div>
  </div>
</div>