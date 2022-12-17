<?php
  echo 
  "
  <div class='modal-delete' id='modalDelete'>
      <div class='modal-content'>
        <div class='modal-header'>
          <i class='fa fa-times-circle fa-5x' aria-hidden='true'></i>
        </div>
        <div class='modal-body'>
          <p>Do you really want to delete this ".$type."? This process cannot be undone.</p>
        </div>
        <div class='modal-footer'>
          <button type='button' class='btn-delete' id='delete'>Delete</button>
          <button type='button' class='btn-cancel' id='cancel'>Cancel</button>
        </div>
      </div>
    </div>
  ";
?>