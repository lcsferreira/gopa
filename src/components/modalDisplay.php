<?php
  echo 
  "
  <div class='modal-info' id='modalDisplay'>
      <i class='fa fa-times-circle fa-2x' aria-hidden='true' id='closeModalDisplay'></i>
      <div class='modal-content'>
        <div class='modal-header'>
          <h2>How is it going to be displayed</h2>
        </div>
        <div class='modal-body mt-10' id='modalDisplayText'>
          Below is an example of Country Card and how this indicators is going to be displayed.
          <p style='color:red'>Test Country Card – Only for Workflow test</p>
          <img class='mt-10' src='../../../assets/".$page."-display-example.PNG' alt='".$page."' width='100%' height='auto'/>
        </div>
      </div>
    </div>
  ";
?>