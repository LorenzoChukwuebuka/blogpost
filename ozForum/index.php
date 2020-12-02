<?php
    session_start();
    $pageTitle = 'OZ Forum - The most exciting source of information';
    // $names = $_SESSION['names'];
    include('layouts/header.php');
    
          
?>
    
    <div id="home">
        <div class="homeCover">
            <div class="container">
                <div class="row whiteTxt centerTxt">
                    <h1>OZFORUM. <br><small>Lets share your thoughts &amp; Ideas.</small></h1>
                </div>

                <div class="row">
                    <?php
                        require('includes/functions.php');
                        mysqli_data_seek($res, 0);
                        $numRows = $res->num_rows;
                        if($numRows > 0){
                            while($rw = $res->fetch_assoc()){
                                $catId = $rw['id'];
                                echo '<ul class="collection with-header">
                                        <li class="collection-header"><h4>'.$rw['category'].'</h4></li>';
                                        
                                        $res1 = $db->query('SELECT articles.*, CONCAT(users.fName, " ", users.lName) as names FROM articles, users WHERE articles.catId = '.$catId.' AND articles.userId = users.id  ORDER BY datePosted DESC LIMIT 5');
                                        $numRw1 = $res1->num_rows;

                                        if($numRw1 > 0){
                                            
                                            while($rw1 = $res1->fetch_assoc()){         
                                                $rs = $db->query('SELECT COUNT(id) AS num FROM `comments` WHERE articlesId = '.$rw1['id']);    
                                                $r = $rs->fetch_assoc();
                                                $commentNum = $r['num'];                                 
                                                echo    '<li class="collection-item">
                                                            <div class="row">
                                                                <div class="col s8">
                                                                    <h6 class="articleTitle"><a href="singleArticle.php?id='.$rw1['id'].'">'.$rw1['title'].'</a></h6>
                                                                    <span class="articlePostPreview">'.substr($rw1['post'], 0, 150).'</span>
                                                                </div>
                                                                <div class="col s1 centerTxt">
                                                                    <h6> <i class="material-icons">visibility</i></h6>
                                                                    '.$rw1['views'].'
                                                                </div>
                                                                <div class="col s1 centerTxt">
                                                                    <h6> <i class="material-icons">comment</i></h6>
                                                                    '.$commentNum.'                                                                   
                                                                </div>
                                                                <div class="col s2 centerTxt">
                                                                    <h6> <i class="material-icons">person</i></h6>
                                                                    '.$rw1['names'].' <br><small>'.time_elapsed_string($rw1['datePosted']).'</small>
                                                                </div>
                                                            </div>
                                                        </li>';
                                            }
                                            
                                        } else {
                                            echo '<li class="collection-item centerTxt"><small><i>No Article for this category. Please create one.</i></small></li>';
                                        }
                                echo '</ul>';
                            }
                        } else {
                            echo '<li><a href=""><small><i>No Category. Contact admin</i></small></a></li>';
                        }
                    ?>
                </div>
            </div>            
        </div>
        
    </div>
<?php
    include('layouts/footer.php')
?>