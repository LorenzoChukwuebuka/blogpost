<?php
    session_start();
    if(isset($_SESSION['loggedIn']) && isset($_POST['addCommentBtn'])){
        $err = 0;
        if(!isset($_POST['comment']) || $_POST['comment'] == ""){
            $err = 1;
        } else {
            $com = $_POST['comment'];
        }

        if(!isset($_POST['postId']) || $_POST['postId'] == ""){
            $err = 1;
        } else {
            $postId = $_POST['postId'];
        }

        if($err == 0){
            require('../ozForumDbConfig.php');

            $res = $db->query('INSERT INTO comments (comment, articlesId, userId) VALUES ("'.$com.'", '.$postId.', '.$_SESSION['id'].')');
            if($res){
                echo 200; // server operation successful
            } else {
                echo 501;
            }
        } else {
            echo 501;
        }
    } else {
        echo 501;
    }
?>