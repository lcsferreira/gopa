<div class="comment-area">
  <label for="<?php echo $indicator_name ?>-comments" class="label-textarea">If any adjustment, please indicate year of information and provide additional comments here: </label>
  <textarea placeholder="Add a comment..." name="comments" id="<?php echo $indicator_name ?>-comments" cols="30" rows="5" class="comment" onblur="saveComment('<?php echo $indicator_name ?>', '<?php echo $id ?>', '<?php echo $indicator_table_name ?>_comments')"><?php if($comments[$indicator_name] != null){echo $comments[$indicator_name];}?></textarea>
</div>