<?php
    if(isset($_POST['editUsersBtn'])){
        $err = 0;
        if(isset($_POST['editUsersName']) && $_POST['editUsersName'] != ""){
            $editUsersName = $_POST['editUsersName'];
        } else {
            $err = 1;
        }
        if(isset($_POST['editUsersName1']) && $_POST['editUsersName1'] != ""){
            $editUsersName1 = $_POST['editUsersName1'];
        } else {
            $err = 1;
        }
        if(isset($_POST['editUsersId']) && $_POST['editUsersId'] != ""){
            $editUsersId = $_POST['editUsersId'];
        } else {
            $err = 1;
        }
        if($err == 0){
            
            require('../../ozForumDbConfig.php');
    
            $res = $db->query('UPDATE users SET fName = "'.$editUsersName.'", lName = "'.$editUsersName1.'" WHERE id = '.$editUsersId.'');
    
            $affectedRows = $db->affected_rows;
    
            if($affectedRows > 0){
                echo 200;
            } else {
                echo 501;
            }
            
        } else {
            echo 501;
        }
    } else if(isset($_POST['doDeleteUser'])){
        $err = 0;
        if(isset($_POST['deleteUsersId']) && $_POST['deleteUsersId'] != ""){
            $deleteUsersId = $_POST['deleteUsersId'];
        } else {
            $err = 1;
        }
        if($err == 0){
            
            require('../../ozForumDbConfig.php');
            
            $res = $db->query('DELETE FROM users WHERE id = "'.$deleteUsersId.'"');

            $affectedRows = $affected_rows;

            if($affectedRows > 0){
                echo 200;
            } else {
                echo 501;
            }
        }
    }


?>