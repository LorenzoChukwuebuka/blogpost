<?php
    if(isset($_POST['createArtBtn'])){
        $err = 0;
        if(isset($_POST['artTitle']) && $_POST['artTitle'] != ""){
            $artTitle = $_POST['artTitle'];
           
        } else {
            $err = 1;
        }
        
        if(isset($_POST['artCat']) && $_POST['artCat'] != ""){
            $artCat = $_POST['artCat'];
            
        } else {
            $err = 1;
        }        
        if(isset($_POST['artPosts']) && $_POST['artPosts'] != ""){
            $artPosts = $_POST['artPosts'];
            
        } else {
            $err = 1;
        }

        if($err == 0){
            require('../../ozForumDbConfig.php');
            $res = $db->query('INSERT INTO articles( title, post, datePosted, catId) VALUES ("'.$artTitle.'", "'.$artPosts.'", NOW(), '.$artCat.')');
           
            if($res){
                echo 200;//server operation successful
               
            }
            
        } else {
            echo 501;//internal server error
           
        }
    
    } else if(isset($_POST['editArtBtn'])){
        $err = 0;
        if(isset($_POST['editArtTitle']) && $_POST['editArtTitle'] != ""){
            $editArtTitle = $_POST['editArtTitle'];
        } else {
            $err = 1;
        }
        if(isset($_POST['editArtPosts']) && $_POST['editArtPosts'] != ""){
            $editArtPosts = $_POST['editArtPosts'];
        } else {
            $err = 1;
        }
        if(isset($_POST['editArtCat']) && $_POST['editArtCat'] != ""){
            $editArtCat = $_POST['editArtCat'];
        } else {
            $err = 1;
        }
        if(isset($_POST['editArtId']) && $_POST['editArtId'] != ""){
            $editArtId = $_POST['editArtId'];
        } else {
            $err = 1;
        }
        // echo $editArtTitle.'-'.$editArtPosts.'-'.$editArtCat.'-'.$editArtId;
        if($err == 0){
            require('../../ozForumDbConfig.php');
            
            $res = $db->query('UPDATE articles SET title = "'.$editArtTitle.'", post =  "'.$editArtPosts.'", catId  =  "'.$editArtCat.'" WHERE id ='.$editArtId);
            $affectedRows = $db->affected_rows;  
            if($affectedRows > 0){
                // echo 'here';
                echo 200;
            } else {
                // echo 'here1';
                echo 501;
            }
            
        } else {
            echo 501;//internal server error
        }
    } else if(isset($_POST['deleteArtBtn'])){
        $err = 0;
        if(isset($_POST['deleteArtId']) && $_POST['deleteArtId'] != ""){
            $deleteArtId = $_POST['deleteArtId'];
        } else {
            $err = 1;
        }    

        if($err == 0){
            require('../../ozForumDbConfig.php');

            $res = $db->query('DELETE FROM articles WHERE id ='.$deleteArtId);
            $affectedRows = $db->affected_rows;  
            if($affectedRows > 0){
                echo 200;
            } else {
                echo 501;
            }
            
        } else {
            echo 501;//internal server error
        }
    } else {
        echo 501;
    }
?>