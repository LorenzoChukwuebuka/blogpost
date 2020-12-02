<?php
    session_start();

    if(isset($_SESSION['active'])){
        header('Location: logout.php');
    } else {
        if(isset($_POST['regAction'])){
            $err = 0;

            if(isset($_POST['fName']) && $_POST['fName'] != ""){
                $fName = $_POST['fName'];
            } else {
                $err = 1;
            }
            if(isset($_POST['lName']) && $_POST['lName'] != ""){
                $lName = $_POST['lName'];
            } else {
                $err = 1;
            }
            if(isset($_POST['oName']) || $_POST['oName'] != $_POST['']){
                $oName = $_POST['oName'];
            } else {
                $err = 1;
            }
            if(isset($_POST['email']) && $_POST['email'] !=""){
                $email = $_POST['email']; 
            } else {
                $err = 1;
            }
            if(isset($_POST['securityPass']) && $_POST['securityPass'] !=""){
                $securityPass = $_POST['securityPass'];
            } else {
                $err = 1;
            }
            if(isset($_POST['dob']) && $_POST['dob'] !=""){
                $dob = $_POST['dob'];
            } else {
                $err = 1;
            }
            if(isset($_POST['phone']) && $_POST['phone'] !=""){
                $phone = $_POST['phone'];
            } else {
                $err = 1;
            }
            if(isset($_POST['username']) && $_POST['username'] !=""){
                $username = $_POST['username'];
            } else {
                $err = 1;
            }
            if(isset($_POST['regPass']) && $_POST['regPass'] !=""){
                $regPass = $_POST['regPass'];
            } else {
                $err = 1;
            }
            if(isset($_POST['addr']) && $_POST['addr'] !=""){
                $addr = $_POST['addr'];
            } else {
                $err = 1;
            }
            if(isset($_POST['group3']) && $_POST['group3'] !=""){
                $group3 = $_POST['group3'];
            } else {
                $err = 1;
            }

            // echo $fName.'-'.$lName.'-'.$oName.'-'.$email.'-'.$securityPass.'-'.$dob.'-'.$phone.'-'.$username.'-'.$regPass.'-'.$group3;
            if($err == 0){
                require('../../ozForumDbConfig.php');
                
                $res = $db->query('INSERT INTO users(fName, oName, lName, gender, addr, phone, dob, dateJoined, uName, regPass, userType) VALUES ("'.$fName.'", "'.$oName.'", "'.$lName.'", "'.$group3.'", "'.$addr.'", "'.$phone.'", "'.$dob.'", NOW(), "'.$username.'", "'.$regPass.'", "G")');

                if($res){
                    $userId = $db->insert_id;

                    $_SESSION['loggedIn'] = true;
                    $_SESSION['id'] = $userId;
                    $_SESSION['fName'] = $fName;
                    $_SESSION['lName'] = $lName;
                    $_SESSION['oName'] = $oName;
                    $_SESSION['email'] = $email;
                    $_SESSION['securityPass'] = $securityPass;
                    $_SESSION['dob'] = $dob;
                    $_SESSION['phone'] = $phone;
                    $_SESSION['username'] = $username;
                    $_SESSION['regPass'] = $regPass;
                    $_SESSION['userType'] = 'Guest';
                    $_SESSION['addr'] = $addr;
                    $_SESSION['group3'] = $group3;

                    echo 200;
                } else {
                    echo 501;
                }
            }
        } else {
            echo 501;
        }
    }
?>