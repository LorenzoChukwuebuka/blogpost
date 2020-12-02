<?php
    //start session
    session_start();
    //if session is active
    if(isset($_SESSION['active'])){
        //redirect to logout page (create logout.php)
        header('Location: logout.php');
    } else { //else
        // if isset (loginBtn) and POST['adminLoginBtn'] != ""
        if (isset($_POST['loginAction'])) {
            //init error var
            $err = 0; 
            //if username field isset and not blank
            if (isset($_POST['uName']) && $_POST['uName'] != ""){
                //get value in username field
                $uName = $_POST['uName']; 
            } else { //else
                //error variable = one
                $err = 1;
            }
            //if Password field isset and not blank
            if(isset($_POST['pass']) && $_POST['pass'] != ""){
                //get value in securityPassword field
                $pass = $_POST['pass'];
            } else {
                //error variable = one
                $err = 1;
            }
            //if userType field isset and not blank
            if(isset($_POST['who']) && $_POST['who'] != ""){

                //get value in userType field
                $who = $_POST['who'];
            } else {
                //error variable = one
                $err = 1;
            }
            // if Password and Confirm Password does not match
            // if (isset($_POST['cPassword']) && $_POST['cPassword'] != $_POST['pass']) {
            //     //error variable = one
            //     $err = 1;
            // }
                
            //if error var is = zero
            if ($err == 0) {
                
                //require dbconnection file
                require('../../ozForumDbConfig.php');

                
                //SELECT user from admin table where username = username given above AND securityPass = securityPass given above
                $res = $db->query('SELECT * FROM users WHERE uName = "'.$uName.'" AND regPass = "'.$pass.'" AND userType = "'.$who.'"');
                //get number of rows return
                $numRows = $res->num_rows;     
                // if numRows is == 1
                // echo $uName.'-'.$pass.'-'.$names.'-'.$id.'-'.$phone;
                if ($numRows == 1) {
                    $rows = $res->fetch_assoc();                   
                    
                    //Create session variable
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['id'] = $rows['id'];
                    $_SESSION['uName'] = $rows['uName'];
                    $_SESSION['fName'] = $rows['fName'];
                    $_SESSION['lName'] = $rows['lName'];
                    $_SESSION['phone'] = $rows['phone'];
                    $_SESSION['names'] = $rows['fName'].' '.$rows['lName'];
                    //$_SESSION['userType'] = $rows['userType'];
                    
                    if($rows['userType'] == 'A'){
                        $_SESSION['userType'] = 'Admin';
                    } else {
                        $_SESSION['userType'] = 'User';
                    }

                    echo 200;
                    // header('Location: index.php');
                } else { 
                    echo 501;
                    // header('Location: ../logout.php');    
                }
            } else {
                echo 501;
                // header('Location: ../logout.php');
            }
               

             
        } else {
            echo 501;
        }
    }
?>