<?php
  echo "
  <div class='indicator-nav'>
    <div>
      <a href='progress.php?id=".$id."'>Progress</a>
    </div>
    <div>
      <a href='demographic.php?id=".$id."' "; if($page == "demographic"){echo "style='color:#03a9f4'";} echo ">Demographic</a>
    </div>
    <div>
      <a href='paPrevalence.php?id=".$id."' "; if($page == "paPrevalence"){echo "style='color:#03a9f4'";} echo ">P.A. Participation</a>
    </div>
    <div>
      <a href='nationalSurveillance.php?id=".$id."' "; if($page == "nationalSurveillance"){echo "style='color:#03a9f4'";} echo">National Surveillance</a>
    </div>
    <div>
      <a href='nationalPolicy.php?id=".$id."' "; if($page == "nationalPolicy"){echo "style='color:#03a9f4'";} echo">National Policy</a>
    </div>
    <div>
      <a href='research.php?id=".$id."' "; if($page == "research"){echo "style='color:#03a9f4'";} echo">Research</a>
    </div>
    <div>
      <a href='paPyramid.php?id=".$id."' "; if($page == "paPyramid"){echo "style='color:#03a9f4'";} echo">P.A. Promotion</a>
    </div>
    <div>
      <a href='contact.php?id=".$id."' "; if($page == "contact"){echo "style='color:#03a9f4'";} echo">Country Contact</a>
    </div>
    ";
    if($_SESSION['userType'] == "admin"){
      echo "
      <div>
        <a href='conclusionAdmin.php?id=".$id."' "; if($page == "conclusionAdmin"){echo "style='color:#03a9f4'";} echo">Conclusion</a>
      </div>
      ";
    }else{
      echo "
      <div>
        <a href='conclusion.php?id=".$id."' "; if($page == "conclusion"){echo "style='color:#03a9f4'";} echo">Conclusion</a>
      </div>
      ";
    }
  echo "</div>";
?>