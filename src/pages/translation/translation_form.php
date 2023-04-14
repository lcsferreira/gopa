<?php
  $title = "Translation";                   
  include "../../components/header.php";                 
?>
<?php
  if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== "1"){
    header("location: ../login/login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Translation</title>
        <link rel="stylesheet" href="../../../css/pages/translation/translation.css">
        <link rel="stylesheet" href="../../../css/components/header.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
    <?php
    include '../../../config.php';
    
    $country_id = $_GET['id'];
    $user = 0;
    if($_SESSION['userType'] == "admin"){
        $user = 0;
    }else if($_SESSION['userType'] == "contact"){
        $user = 1;
    }

    $sql = "SELECT * FROM translations WHERE country_id = ".$country_id;
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        if(isset($_POST['submit']))
        {
            $sql = "update translations set  s1 = '".$_POST['s1']."', s2 = '".$_POST['s2']."', s3 = '".$_POST['s3']."', s4 = '".$_POST['s4']."', s5 = '".$_POST['s5']."',
                                            s6 = '".$_POST['s6']."', s7 = '".$_POST['s7']."', s8 = '".$_POST['s8']."', s10 = '".$_POST['s10']."', s11 = '".$_POST['s11']."',
                                            s12 = '".$_POST['s12']."', s13 = '".$_POST['s13']."',s14 = '".$_POST['s14']."', s15 = '".$_POST['s15']."', s16 = '".$_POST['s16']."',
                                            s17 = '".$_POST['s17']."', s18 = '".$_POST['s18']."',s19 = '".$_POST['s19']."', s20 = '".$_POST['s20']."', s21 = '".$_POST['s21']."',
                                            s22 = '".$_POST['s22']."', s23 = '".$_POST['s23']."',s24 = '".$_POST['s24']."', s25 = '".$_POST['s25']."',
                                            s26 = '".$_POST['s26']."', s27 = '".$_POST['s27']."', s28 = '".$_POST['s28']."', s29 = '".$_POST['s29']."',
                                            s30 = '".$_POST['s30']."', s31 = '".$_POST['s31']."', s32 = '".$_POST['s32']."', s33 = '".$_POST['s33']."',
                                            s34 = '".$_POST['s34']."', s35 = '".$_POST['s35']."', s36 = '".$_POST['s36']."', s37 = '".$_POST['s37']."',
                                            s38 = '".$_POST['s38']."', s39 = '".$_POST['s39']."', s40 = '".$_POST['s40']."',
                                            s41 = '".$_POST['s41']."', s42 = '".$_POST['s42']."', s43 = '".$_POST['s43']."', s44 = '".$_POST['s44']."',
                                            s45 = '".$_POST['s45']."', s46 = '".$_POST['s46']."', s47 = '".$_POST['s47']."', s48 = '".$_POST['s48']."' 
                WHERE country_id = ".$country_id;
            $rs = mysqli_query($connection, $sql);
            $affectedRows = mysqli_affected_rows($connection);
            if($affectedRows >0){ 
                //update the countries table of the translation_step to 'approved'
                $sql = "UPDATE countries SET translation_step = 'approved' WHERE id = ".$country_id;
                $rs = mysqli_query($connection, $sql);
            }
            echo "<script>window.location.href = '../countriesList/countriesListContacts.php?id=".$country_id."';</script>";
            //redirect to countries list with javascript
        }
    }
    else { 
        if(isset($_POST['submit']))
        {
    	    $sql = "insert into translations values (".$country_id.", 0, '".
                                            $_POST['s1']."','".$_POST['s2']."','".$_POST['s3']."','".$_POST['s4']."','".$_POST['s5']."','".$_POST['s6']."','".$_POST['s7']."','".$_POST['s8']."','".$_POST['s9']."','".$_POST['s10']."','".
                                            $_POST['s11']."','".$_POST['s12']."','".$_POST['s13']."','".$_POST['s14']."','".$_POST['s15']."','".$_POST['s16']."','".$_POST['s17']."','".$_POST['s18']."','".$_POST['s19']."','".$_POST['s20']."','".
                                            $_POST['s21']."','".$_POST['s22']."','".$_POST['s23']."','".$_POST['s24']."','".$_POST['s25']."','".$_POST['s26']."','".$_POST['s27']."','".$_POST['s28']."','".$_POST['s29']."','".$_POST['s30']."','".
                                            $_POST['s31']."','".$_POST['s32']."','".$_POST['s33']."','".$_POST['s34']."','".$_POST['s35']."','".$_POST['s36']."','".$_POST['s37']."','".$_POST['s38']."','".$_POST['s39']."','".$_POST['s40']."','".
                                            $_POST['s41']."','".$_POST['s42']."','".$_POST['s43']."','".$_POST['s44']."','".$_POST['s45']."','".$_POST['s46']."','".$_POST['s47']."','".$_POST['s48'].
                                            "')";
	
            $rs = mysqli_query($connection, $sql);
	        $affectedRows = mysqli_affected_rows($connection);
            if($affectedRows >0){ 
                //update the countries table of the translation_step to 'approved'
                $sql = "UPDATE countries SET translation_step = 'approved' WHERE id = ".$country_id;
                $rs = mysqli_query($connection, $sql);
            }
            echo "<script>window.location.href = '../countriesList/countriesListContacts.php?id=".$country_id."';</script>";
        }
    }
    $sql = "SELECT * FROM translations WHERE country_id = ".$country_id;
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $has_data = true;
        ?>
        <div class="container" id="main">
            <?php
                include_once "../../components/modalConfirm.php";
            ?>
            <div class="title mt-50">
                <h1>Translation</h1>
                <p>Please translate the following sentences to your country’s native language.</p>
            </div>
            <div class="forms-container">
                <form method="post" id="form" >
                    <table border="0">
                <tr>
                    <td>1.	Please tell us what is your country's name in the native country language? For example Brazil = name in English; Brasil = name in Portuguese.</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s1" maxlength="255"><?php if ($has_data) echo $row["s1"]?></textarea></td>
                </tr>
                <tr>
                    <td>2.	How do you translate "World  region  (Africa — AFRO;  Eastern  Mediterranean  EMRO;  Europe  - EURO; The Americas and the Caribbean - PAHO; South—East  Asia  - SEARO;  Western  Pacific  - WPRO)" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s2" maxlength="255"><?php if ($has_data) echo $row["s2"]?></textarea></td>
                </tr>
                <tr>
                    <td>3. How do you translate "Demographic Data" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s3" maxlength="255"><?php if ($has_data) echo $row["s3"]?></textarea></td>
                </tr>
                <tr>
                    <td>4.	How do you translate the word "Capital" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s4" maxlength="255"><?php if ($has_data) echo $row["s4"]?></textarea></td>
                </tr>
                <tr>
                    <td>5.	How do you translate "Population" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s5" maxlength="255"><?php if ($has_data) echo $row["s5"]?></textarea></td>
                </tr>
                <tr>
                    <td>6.	How do you translate "Urban Population" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s6" maxlength="255"><?php if ($has_data) echo $row["s6"]?></textarea></td>
                </tr>
                <tr>
                    <td>7.	How do you translate "Life expectancy" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s7" maxlength="255"><?php if ($has_data) echo $row["s7"]?></textarea></td>
                </tr>
                <tr>
                    <td>8.	How do you translate "Gini index for income inequality" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s8" maxlength="255"><?php if ($has_data) echo $row["s8"]?></textarea></td>
                </tr>
                <tr>
                    <td>9.	How do you translate "Human Development Index" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s9" maxlength="255"><?php if ($has_data) echo $row["s9"]?></textarea></td>
                </tr>
                <tr>
                    <td>10.	How do you translate "Literacy Rate" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s10" maxlength="255"><?php if ($has_data) echo $row["s10"]?></textarea></td>
                </tr>
                <tr>
                    <td>11.	How do you translate "Deaths from non—communicable  diseases"  into  your  country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s11" maxlength="255"><?php if ($has_data) echo $row["s11"]?></textarea></td>
                </tr>
                <tr>
                    <td>12.	How do you translate "World Bank Income Category (High income  - Upper middle income — Lower middle income - Low income)" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s12" maxlength="255"><?php if ($has_data) echo $row["s12"]?></textarea></td>
                </tr>
                <tr>
                    <td>13.	How do you translate "Physical Activity Participation" into your country's language</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s13" maxlength="255"><?php if ($has_data) echo $row["s13"]?></textarea></td>
                </tr>
                <tr>
                    <td>14.	How do you translate "Physical Activity Prevalence estimates for adults" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s14" maxlength="255"><?php if ($has_data) echo $row["s14"]?></textarea></td>
                </tr>
                <tr>
                    <td>15.	How do you translate "Adults" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s15" maxlength="255"><?php if ($has_data) echo $row["s15"]?></textarea></td>
                </tr>
                <tr>
                    <td>16.	How do you translate "Gender Inequalities in Physical Activity Prevalence" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s16" maxlength="255"><?php if ($has_data) echo $row["s16"]?></textarea></td>
                </tr>
                <tr>
                    <td>17.	How do you translate "Women" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s17" maxlength="255"><?php if ($has_data) echo $row["s17"]?></textarea></td>
                </tr>
                <tr>
                    <td>18.	How do you translate "Men" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s18" maxlength="255"><?php if ($has_data) echo $row["s18"]?></textarea></td>
                </tr>
                <tr>
                    <td>19.	How do you translate "Worldwide" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s19" maxlength="255"><?php if ($has_data) echo $row["s19"]?></textarea></td>
                </tr>
                <tr>
                    <td>20.	How do you translate "World region" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s20" maxlength="255"><?php if ($has_data) echo $row["s20"]?></textarea></td>
                </tr>
                <tr>
                    <td>21.	How do you translate "This country card is part of the 3rd Physical Activity Almanac (free resource on the GoPA! website) For description of indicators and data sources visit: " into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s21" maxlength="255"><?php if ($has_data) echo $row["s21"]?></textarea></td>
                </tr>
                <tr>
                    <td>22.	How do you translate "Policy and Surveillance Status" into your country’s language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s22" maxlength="255"><?php if ($has_data) echo $row["s22"]?></textarea></td>
                </tr>
                <tr>
                    <td>23.	How do you translate "National physical activity policy/plan" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s23" maxlength="255"><?php if ($has_data) echo $row["s23"]?></textarea></td>
                </tr>
                <tr>
                    <td>24.	How do you translate "Level of policy implementation" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s24" maxlength="255"><?php if ($has_data) echo $row["s24"]?></textarea></td>
                </tr>
                <tr>
                    <td>25.	How do you translate "National recommendations" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s25" maxlength="255"><?php if ($has_data) echo $row["s25"]?></textarea></td>
                </tr>
                <tr>
                    <td>26.	How do you translate "National survey(s) including physical activity questions" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s26" maxlength="255"><?php if ($has_data) echo $row["s26"]?></textarea></td>
                </tr>
                <tr>
                    <td>27.	How do you translate "Most recent" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s27" maxlength="255"><?php if ($has_data) echo $row["s27"]?></textarea></td>
                </tr>
                <tr>
                    <td>28.	How do you translate "Next" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s28" maxlength="255"><?php if ($has_data) echo $row["s28"]?></textarea></td>
                </tr>
                <tr>
                    <td>29.	How do you translate  the word "Surveys and instruments used to assess physical activity" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s29" maxlength="255"><?php if ($has_data) echo $row["s29"]?></textarea></td>
                </tr>
                <tr>
                    <td>30.	How do you translate "Objective measurement to assess physical activity" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s30" maxlength="255"><?php if ($has_data) echo $row["s30"]?></textarea></td>
                </tr>
                <tr>
                    <td>31.	How do you translate "Devices used" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s31" maxlength="255"><?php if ($has_data) echo $row["s31"]?></textarea></td>
                </tr>
                <tr>
                    <td>32.	How do you translate "Physical activity prevalence estimate (minutes)" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s32" maxlength="255"><?php if ($has_data) echo $row["s32"]?></textarea></td>
                </tr>
                <tr>
                    <td>33. How do you translate "Physical Activity Research" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s33" maxlength="255"><?php if ($has_data) echo $row["s33"]?></textarea></td>
                </tr>
                <tr>
                    <td>34.	How do you translate "Contribution to physical activity research worldwide from 1950-2019" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s34" maxlength="255"><?php if ($has_data) echo $row["s34"]?></textarea></td>
                </tr>
                <tr>
                    <td>35.	How do you translate "Position in the ranking" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s35" maxlength="255"><?php if ($has_data) echo $row["s35"]?></textarea></td>
                </tr>
                <tr>
                    <td>36.	How do you translate "Research articles quintiles (Q) - High - Low" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s36" maxlength="255"><?php if ($has_data) echo $row["s36"]?></textarea></td>
                </tr>
                <tr>
                    <td>37.	How do you translate "Gender Inequalities in Physical Activity Research" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s37" maxlength="255"><?php if ($has_data) echo $row["s37"]?></textarea></td>
                </tr>
                <tr>
                    <td>38.	How do you translate "Percentage of first authors in physical activity research"  into  your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s38" maxlength="255"><?php if ($has_data) echo $row["s38"]?></textarea></td>
                </tr>
                <tr>
                    <td>39.	How do you translate "Physical  Activity  Promotion  - Capacity  Pyramid — High  - Medium  - Low" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s39" maxlength="255"><?php if ($has_data) echo $row["s39"]?></textarea></td>
                </tr>
                <tr>
                    <td>40.	How do you translate "1st set of Country Cards" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s40" maxlength="255"><?php if ($has_data) echo $row["s40"]?></textarea></td>
                </tr>
                <tr>
                    <td>41.	How do you translate "2nd set of Country Cards" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s41" maxlength="255"><?php if ($has_data) echo $row["s41"]?></textarea></td>
                </tr>
                <tr>
                    <td>42.	How do you translate "3rd set of Country Cards" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s42" maxlength="255"><?php if ($has_data) echo $row["s42"]?></textarea></td>
                </tr>
                <tr>
                    <td>43.	How do you translate "Research" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s43" maxlength="255"><?php if ($has_data) echo $row["s43"]?></textarea></td>
                </tr>
                <tr>
                    <td>44.	How do you translate "Surveillance" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s44" maxlength="255"><?php if ($has_data) echo $row["s44"]?></textarea></td>
                </tr>
                <tr>
                    <td>45.	How do you translate "Policy" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s45" maxlength="255"><?php if ($has_data) echo $row["s45"]?></textarea></td>
                </tr>
                <tr>
                    <td>46.	How do you translate "Availability" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s46" maxlength="255"><?php if ($has_data) echo $row["s46"]?></textarea></td>
                </tr>
                <tr>
                    <td>47.	How do you translate "Implementation" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s47" maxlength="255"><?php if ($has_data) echo $row["s47"]?></textarea></td>
                </tr>
                <tr>
                    <td>48.	How do you translate "Contact Information — Name - Institution" into your country's language?</td>
                    <td><textarea <?php if ($user == 0) echo "disabled";?> rows = "5" cols = "60" name = "s48" maxlength="255"><?php if ($has_data) echo $row["s48"]?></textarea></td>
                </tr>
            </table>
            <?php if ($user != 0) echo "<div class='conclusion'><input class='btn-confirm' type=\"button\" name=\"confirmval\" value=\"Send to GoPA\" onclick='confirmation()'><input class='btn-confirm' type=\"submit\" name=\"submit\" value=\"Send to GoPA\" hidden></div>";?>
            <?php if ($user == 0) echo "<div class='buttons'><button class='btn-back' type='button' onclick='document.location = `../countriesList/countriesListAdmin.php`'>Back</button></div>";?>
            </form>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="../../js/translation/translation.js"></script>
        <script src="../../js/sidebarMenu.js"></script>
    </body>
  </html>