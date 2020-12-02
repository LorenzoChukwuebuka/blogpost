<?php
    session_start();
    $pageTitle = 'OZ Forum - The most exciting source of information';
    include('layouts/header.php');
?>
<style>
    .page-footer{
        margin: 0px;
    }
    .page-footer .footer-copyright {
        padding: 0px 20px;
        /* margin: 0px 0px; */
    }
    .container{
        margin-top: 4vh;
    }
</style>
<div class="navbar-fixed">
        <nav id="homeNav">
            <div class="nav-wrapper">
                <a href="#!" class="brand-logo">OZ FORUM</a>
                <ul class="right hide-on-med-and-down">
                <li>
                    <a class="dropdown-trigger" href="#!" data-target="catDropdown">Categories<i class="material-icons right">arrow_drop_down</i></a>
                </li>
                <?php
                    if(isset($_SESSION['loggedIn'])){
                        echo '<li><a class="dropdown-trigger" href="#!" data-target="dropdown1">'.$_SESSION['names'].'<i class="material-icons right">arrow_drop_down</i></a></li>';
                    } else {
                        echo '<li><a href="auth/auth.php">Login</a></li>';
                    }
                ?>
                
                </ul>
            </div>
        </nav>

        <!-- Dropdown Structure -->
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="logout.php">Logout</a></li>
        </ul>

        <ul id="catDropdown" class="dropdown-content">
            <?php
                require('../ozForumDbConfig.php');

                $res = $db->query('SELECT * FROM categories');
            
                $numRows = $res->num_rows;
            
                if($numRows > 0){
                
                    while($rows = $res->fetch_assoc()){
                        echo    '<li><a href="#">'.$rows['category'].'</a></li>';
                    }
                } else {
                    echo'<li>No category created yet</li>';
                }
            ?>
        </ul>
    </div>
    
    <div class="container">
        <div class="row">
        <?php
            require('../ozForumDbConfig.php');
            
            if(isset($_GET['articleId']) && $_GET['articleId'] != ""){
                $articleId = $_GET['articleId'];                                                                                           
    
                $res = $db->query('SELECT articles.*, categories.category FROM articles, categories WHERE articles.id = '.$articleId.' AND articles.categoryId = categories.id');//get all categories
                    $numRows = $res->num_rows;//get the number of categories returned
        
                    if($numRows == 1){
                        $rows = $res->fetch_assoc();
    
                        $artId = $rows['id'];
                        $title = $rows['title'];
                        $post = $rows['post'];
                        $datePosted = $rows['datePosted'];
                        $cat = $rows['category'];
                        $catId = $rows['categoryId'];
                    } else {
                        
                    }
            }
            echo        '<div class="row">
                            <div class="col s12 m12 l12 xl12">
                                <h3>'.$title.'</h3>
                            </div>
                        </div>   
                        <div class="row"> 
                            <div class="col s8 m8 l8 xl8">
                                <p><small>category:</small> <b>'.$cat.'</b></p>
                            </div>  
                            <small class="col s4 m4 l4 xl4 center-align">
                                datePosted: <a href="#">'.$datePosted.'</a>
                            </small>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12 xl12">
                                <p>'.$post.'</p>
                            </div>
                        </div>';
                        
        ?>
        </div>            
    </div>


    <footer class="page-footer">
        <div class="footer-copyright">
            &copy; Copyright 2020. gozieWithTony.
            <span href="#" class="grey-text text-lighten-4">Developed with <i class="material-icons red-text">favorite</i> by <a href="https://web.whatsApp.com" class="white-text" style="text-decoration: underline;">Tony Val</a></span>
        </div>
    </footer>
<?php
    include('layouts/footer.php');
?>