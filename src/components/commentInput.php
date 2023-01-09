<div class="comment-area">
  <?php if ($status['indicators_step'] == "waiting contact" && $admin_values['different_value_source_'.$diff_input] == 1) {
    echo "<div class='clarification'><div class='dropdown'><b><u>* Clarification Needed *</u></b><div class='dropdown-content'>Through searching other sources of information related to physical activity policies at the national level, we have identified additional and different information from what you provided for this indicator and we would like to confirm with you. Confirm them by sending us support such as links or pdf documents on the <b>comment section area</b>! Please review and respond to our message to confirm the most current and updated Country Card information for your country. Thank you very much.</div></div></div>";
  }?>
  <label for="<?php echo $indicator_name ?>-comments" class="label-textarea">If any adjustment, please indicate year of information and provide additional comments here: </label>
  <textarea placeholder="Add a comment..." name="comments" id="<?php echo $indicator_name ?>-comments" cols="30" rows="5" class="comment" onblur="saveComment('<?php echo $indicator_name ?>', '<?php echo $id ?>', '<?php echo $indicator_table_name ?>_comments')">
    <?php
      if($comments[$indicator_name] != null){
        echo $comments[$indicator_name];
      }
    ?>
  </textarea>
</div>