<?php
    if(isset($_POST['createCatBtn'])){
        $err = 0;
        if(isset($_POST['catName']) && $_POST['catName'] !=""){
            $catName = $_POST['catName'];
        } else {
            $err = 1;
        }       
        if($err == 0){
            require('../../ozForumDbConfig.php');

            $res = $db->query('INSERT INTO categories (category) VALUES ("'.$catName.'")');
            if($res){
                echo 200; // server operation successful
            }
        } else {
            echo 501; // internal server error
        }
    } else if(isset($_POST['checkIfCatExists'])) {
        $err = 0;
        if(isset($_POST['catValue']) && $_POST['catValue'] != ""){
            $catValue = $_POST['catValue'];
        } else {
            $err = 1;
        }
    
        if($err == 0){
            require('../../ozForumDbConfig.php');
    
            $res = $db->query('SELECT * FROM categories WHERE category LIKE "'.$catValue.'%"');
            $numRows = $res->num_rows;
    
            if($numRows > 0){
                while($rows = $res->fetch_assoc()){
                    $data[] = $rows;
                }
                 echo json_encode($data);
            } else {
                echo 501;
            }     
            
        } else {
            echo 501;//internal server error
        }
    } else if(isset($_POST['editCatBtn'])){
        $err = 0;
        if(isset($_POST['editCatName']) && $_POST['editCatName'] !=""){
            $editCatName = $_POST['editCatName'];
        } else {
            $err = 1;
        }
        if(isset($_POST['editCatId']) && $_POST['editCatId'] !=""){
            $editCatId = $_POST['editCatId'];
        } else {
            $err = 1;
        }
        if($err == 0){
            require('../../ozForumDbConfig.php');

            $res = $db->query('UPDATE categories SET category = "'.$editCatName.'" WHERE id ='.$editCatId.'');
            $affectedRows = $db->affected_rows;  
            if($affectedRows > 0){
                echo 200;
            } else {
                echo 501;
            }
        } else {
            echo 501;//internal server error
        }
    }  else if(isset($_POST['deleteCatBtn'])){
        $err = 0;
        if(isset($_POST['deleteCatId']) && $_POST['deleteCatId'] != ""){
            $deleteCatId = $_POST['deleteCatId'];
        } else {
            $err = 1;
        }    
    
        if($err == 0){
            require('../../ozForumDbConfig.php');
    
            $res = $db->query('DELETE FROM categories WHERE id ='.$deleteCatId);
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