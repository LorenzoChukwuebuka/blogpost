<?php
    session_start();
    $pageTitle = 'Category - Page';
    include('partials/initial.php');
  
    if(isset($_GET['catId'])){
        $catId = $_GET['catId'];

        $numRows = $res->num_rows; 

        if($numRows > 0){
            $row = $res->fetch_assoc();

            echo '<ul class="collection with-header container">
                    <li class="collection-header"><h4>'.$row['category'].'</h4></li>';
    
                    require('../ozForumDbConfig.php');//DB connection

                    $rs1 = $db->query('SELECT articles.*, categories.* FROM articles, categories WHERE catId = categories.id AND catId = '.$catId);
                
                    $nmRws = $rs1->num_rows;

                    if($nmRws > 0){
                        while($rws = $rs1->fetch_assoc()){
                            $title = $rws['title'];
                            $artId = $rws['catId'];
                            $post = $rws['post'];
                            $cat = $rws['category'];

                            echo'<li class="collection-item">
                                    <div class="row">
                                        <div class="col l12">
                                            <div class="col l11">
                                                <h4>'.$title.'</h4>
                                                <span>'.$post.'</span>
                                            </div>
                                            <div class="col l1 centerTxt">
                                                <h6><i class="material-icons">visibility</i></h6>
                                                '.$rws['views'].'
                                            </div>
                                        </div>
                                    </div>
                                </li>';
                        }
                    } else {
                        echo 'No articles for this category. Please create one.';
                    }
            echo '</ul>';
            
        } else {
            echo 'No article for this category yet. Please contact the admin.';
        }
    }
?>

