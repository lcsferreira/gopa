<div class='clarification' id="<?php echo $indicator_name ?>_diff"  <?php if ($show == "show") {
     echo "style='display: flex'";
   } else {
      echo "style='display: none'";
   }?>>
  <label for="<?php echo $indicator_name ?>-diff-data-explanation-admin" class="label-textarea">Additional information: </label>
  <textarea placeholder="Add a comment..." name="comments" id="<?php echo $indicator_name ?>-diff-data-explanation-admin" cols="30" rows="5" class="comment" onblur="saveValueByAdmin('<?php echo $indicator_name ?>-diff-data-explanation', '<?php echo $id ?>', '<?php echo $indicator_table_name ?>_values_admin')" <?php if ($_SESSION["userType"] != "admin") {echo "disabled";} ?>><?php if($admin_values[$indicator_name.'_diff_data_explanation'] != null){echo $admin_values[$indicator_name.'_diff_data_explanation'];}?>
  </textarea>
  <div class='dropdown'><b><u>* Clarification Needed *</u></b>
    <div class='dropdown-content'>Through searching other sources of information related to physical activity policies at the national level, we have identified information that we would like to confirm with you. Find the details above and please confirm them by sending us links that support this information in the <b>area below</b>. Please review and respond to our message (area above) to confirm the most current and updated Country Card information for your country. Thank you very much.
    </div>
  </div>
  <textarea placeholder="Respond here..." name="comments" id="<?php echo $indicator_name ?>-diff-data-explanation" cols="30" rows="5" class="comment" onblur="saveDiffData('<?php echo $indicator_name ?>-diff-data-explanation', '<?php echo $id ?>', '<?php echo $indicator_table_name ?>_values_contact')" <?php if ($_SESSION["userType"] == "admin") {echo "disabled";} ?>><?php if($contact_values[$indicator_name.'_diff_data_explanation'] != null){echo $contact_values[$indicator_name.'_diff_data_explanation'];}?>
  </textarea>
</div>