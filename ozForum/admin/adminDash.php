<?php
     //start session
     session_start();
     //if session is active
     if(isset($_SESSION['loggedIn'])){
         $names = $_SESSION['names'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OzForum - <?= $names ?></title>
        <link rel="stylesheet" href="../css/materialize.min.css">
        <link rel="stylesheet" href="../fonts/material-icons.css">
        <link rel="stylesheet" href="../css/ozForum.css">
        <style>
            .bluBackGrd {
                background-color: rgb(17, 91, 114);
            }
            .successToast{
                background-color: green;
            }
        </style>
    </head>
<body>
    
    <nav class="nav-extended green">
        <div class="nav-wrapper">
        <a href="../index.php" class="brand-logo">OzForum</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><?= $names ?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
        </div>
        <div class="nav-content">
            <div class="container">
                <ul class="tabs tabs-transparent">
                    <li class="tab"><a class="active" href="#article">Article</a></li>
                    <li class="tab"><a href="#cats">Categories</a></li>
                    <li class="tab"><a href="#users">Users</a></li>
                </ul>
            </div>           
        </div>
    </nav>

    <!-- Mobile Navigation -->
    
    <!-- <a class="dropdown-trigger" href="#!" data-target="dropdown1"><?= $names ?><i class="material-icons right">arrow_drop_down</i>      -->

    <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
        <!-- <li><a href="#!">one</a></li>
        <li class="divider"></li> -->
        <li><a href="../logout.php">Logout</a></li>
    </ul>

    
    <div id="article" class="col s12">
        <div class="container">
            <h1>Blog Articles</h1>

            <div class="row" id="allArt">
                
                <h2>
                    All Articles
                    <a class="btn-floating btn-large waves-effect waves-light red right modal-trigger" href="#createArtModal"><i class="material-icons">add</i></a>
                </h2>
                <table class="striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>title</th>
                            <th>post</th>
                            <th>category</th>
                            <th>datePosted</th> 
                            <th><i class="material-icons">edit</i></th>
                            <th><i class="material-icons">delete</i></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            require('../../ozForumDbConfig.php');

                            $res = $db->query('SELECT articles.*, categories.category FROM articles, categories WHERE articles.catId = categories.id'); //get all articles
                            $numRows = $res->num_rows; //get number of aricles returned

                            if($numRows > 0){ // if number of article is atleast 1
                                $sn = 1;
                                while($rows = $res->fetch_assoc()){
                                    echo '<tr>
                                            <td>'.$sn.'</td>
                                            <td>'.$rows['title'].'</td>
                                            <td>'.substr($rows['post'], 0, 200).'...</td>
                                            <td>'.$rows['category'].'</td>
                                            <td>'.$rows['datePosted'].'</td>
                                            <td><a href="#" class="editArtModal" data-id="'.$rows['id'].'" data-value="'.$rows['title'].'"data-post="'.$rows['post'].''.$rows['datePosted'].'"data-cat="'.$rows['catId'].'"><i class="material-icons">edit</i></a></td>
                                            <td><a href="#" class="delArtModal" data-id="'.$rows['id'].'" data-value="'.$rows['title'].'"data-post="'.$rows['post'].''.$rows['datePosted'].'"data-cat="'.$rows['catId'].'"><i class="material-icons">delete</i></a></td>
                                        </tr>';
                                    $sn++;
                                }
                            } else { // if no category is returned
                                echo    '<tr>
                                            <td colspan="4" class="center-align"><i>no article created yet</i><td>
                                        </tr>';

                            }
                        ?>
                   

                    </tbody>
                </table>
            </div>
            

            <!--Create Modal Structure -->
            <div id="createArtModal" class="modal">
                <div class="modal-content">
                    <h2>
                        Create Article
                    </h2>
                    <form class="col s12" id="createArtForm">
                        <div class="row">
                            <div class="input-field col s6">
                                
                                <input id="artTitle" type="text" name="artTitle" placeholder="Enter title" class="validate" required/>
                                <label for="artTitle">Title</label>
                            </div>
                        
                            <div class="input-field col s6">
                                <select id="artCat" name="artCat" required>
                                    <option value="_">Select Article Category</option>
                                    <?php
                                        require('../../ozForumDbConfig.php');//DB connection

                                        $res = $db->query('SELECT * FROM categories');//get all categories
                                        $numRows = $res->num_rows;//get the number of categories returned
                            
                                        if($numRows > 0){
                                            while($rows = $res->fetch_assoc()){
                                                echo    '<option value="'.$rows['id'].'">'.$rows['category'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <label for="artCat">Article Category</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea class="materialize-textarea" id="artPosts" placeholder="write post" name="artPosts" class="validate" required></textarea>
                                <label for="artPosts">write Post</label>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <div class="input-field col s6">
                                <button class="btn waves-effect waves-light" type="submit" name="createArtBtn" id="createArtBtn" disabled>Create
                                    <i class="material-icons right">create</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>

            <!-- UPDATE Modal Structure -->
            <div id="editArtModal" class="modal">
                <div class="modal-content">
                    <h2>
                        Edit Post
                    </h2>
                    <form class="input-field col s12" id="editArtForm">
                        <div class="row">
                            <div class="input-field col s6">
                                
                                <input id="editArtTitle" type="text" name="editArtTitle" placeholder="Enter title" class="validate" required/>
                                <label for="editArtTitle">Title</label>
                            </div>
                            <div class="input-field col s6">
                                <select id="editArtCat" name="editArtCat" required>
                                    <option value="_">Select Article Category</option>
                                    <?php
                                        require('../../ozForumDbConfig.php');//DB connection

                                        $res = $db->query('SELECT * FROM categories');//get all categories
                                        $numRows = $res->num_rows;//get the number of categories returned
                            
                                        if($numRows > 0){
                                            while($rows = $res->fetch_assoc()){
                                                echo    '<option value="'.$rows['id'].'">'.$rows['category'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <label for="editArtCat">Article Category</label>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea class="materialize-textarea" id="editArtPosts" placeholder="edit Posts" name="editArtPosts" class="validate" required></textarea>
                                <label for="editArtPosts">Edit Posts</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="editArtId" id="editArtId"/>
                            <div class="input-field col s6">
                                <button class="btn waves-effect waves-light" type="submit" name="editArtBtn" id="editArtBtn" disabled>Edit
                                    <i class="material-icons right">edit</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 

            <!-- delete Modal Structure -->
            <div id="deleteArtModal" class="modal">
                <div class="modal-content center-align">
                    <h4>Delete Category</h4>
                    <p>Are you sure you want to delete this article <b>(<span id="deleteArtTitle"></span>)</b>?</p>
                    <input type="hidden" id="deleteArtId">
                    <div>
                        <button class="btn-large waves-effect waves-light red" id="doDeleteArt">Yes</button>
                        <button class="btn-large waves-effect waves-light modal-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="cats" class="col s12">
        <div class="container">
            <h1>Blog Categories</h1>

            <div class="row" id="allCats">
                
                <h2>
                    All Categories
                    <a class="btn-floating btn-large waves-effect waves-light red right modal-trigger" href="#createCatModal"><i class="material-icons">add</i></a>
                </h2>
                <table class="striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Category</th>
                            <th><i class="material-icons">edit</i></th>
                            <th><i class="material-icons">delete</i></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            require('../../ozForumDbConfig.php');

                            $res = $db->query('SELECT * FROM categories'); //get all categories
                            $numRows = $res->num_rows; //get number of categories returned

                            if($numRows > 0){ // if number of categories is atleast 1
                                $sn = 1;
                                while($rows = $res->fetch_assoc()){
                                    echo '<tr>
                                            <td>'.$sn.'</td>
                                            <td>'.$rows['category'].'</td>
                                            <td><a href="#" class="editCatModal" data-id="'.$rows['id'].'" data-value="'.$rows['category'].'"><i class="material-icons">edit</i></a></td>
                                            <td><a href="#" class="delModal" data-id="'.$rows['id'].'" data-value="'.$rows['category'].'"><i class="material-icons">delete</i></a></td>
                                        </tr>';
                                    $sn++;
                                }
                            } else { // if no category is returned
                                echo    '<tr>
                                            <td colspan="4" class="center-align"><i>no category created yet</i><td>
                                        </tr>';

                            }
                        ?>
                    

                    </tbody>
                </table>
            </div>
        

            <!--Create Modal Structure -->
            <div id="createCatModal" class="modal">
                <div class="modal-content">
                    <h2>
                        Create Category
                    </h2>
                    <form class="col s12" id="createCatForm">
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="Enter Category Name" id="catName" name="catName" type="text" required class="validate">
                                <label for="catName">Category Name</label>

                                <ul class="collection hide">
                                    <li class="collection-item yellow accent-2">Please ensure the category you want to create does not already exist. Check the list below:</li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="input-field col s6">
                                <button class="btn waves-effect waves-light" type="submit" name="createCatBtn" id="createCatBtn" disabled>Create
                                    <i class="material-icons right">create</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            
            </div>

            <!--UPDATE Modal Structure -->
            <div id="editCatModal" class="modal">
                <div class="modal-content">
                    <h2>
                        Edit Category
                    </h2>
                    <form class="input-field col s12" id="editCatForm">
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="Enter Category Name" id="editCatName" name="editCatName" type="text" required class="validate">
                                <label for="editCatName">Category Name</label>

                                <ul class="collection hide">
                                    <li class="collection-item yellow accent-2">Please ensure the category you want to create does not already exist. Check the list below:</li>
                                </ul>  
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <input type="hidden" name="editCatId" id="editCatId"/>
                            <div class="input-field col s6">
                                <button class="btn waves-effect waves-light" type="submit" name="editCatBtn" id="editCatBtn" disabled>Edit
                                    <i class="material-icons right">edit</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

                <!-- delete Modal Structure -->
            <div id="deleteCatModal" class="modal">
                <div class="modal-content center-align">
                    <h4>Delete Category</h4>
                    <p>Are you sure you want to delete this category <b>(<span id="deleteCatName"></span>)</b>?</p>
                    <input type="hidden" id="deleteCatId">
                    <div>
                        <button class="btn-large waves-effect waves-light red" id="doDeleteCat">Yes</button>
                        <button class="btn-large waves-effect waves-light modal-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="users" class="col s12">
        <div class="container">
        
            <h1>
                Blog Users
            </h1>

            <h2>
                All Users
            </h2>
            
            <table class="highlight">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>firstname</th>
                        <th>Lastname</th>
                        <th>dateJoined</th>
                        <th><i class="material-icons">edit</i></th>
                        <th><i class="material-icons">delete</i></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        require('../../ozForumDbConfig.php');

                        $res = $db->query('SELECT users.dateJoined, users.id, users.fName, users.lName FROM users WHERE userType = "G"');
                        $numRows = $res->num_rows;
                        
                        if($numRows > 0){
                            $sn = 1;
                            while($rows = $res->fetch_assoc()){
                                echo    '<tr>
                                            <td>'.$sn.'</td>
                                            <td>'.$rows['fName'].'</td>
                                            <td>'.$rows['lName'].'</td>
                                            <td>'.$rows['dateJoined'].'</td>
                                            <td><a href="#" class="usersModal" data-id="'.$rows['id'].'" data-user="'.$rows['fName'].'" data-user1="'.$rows['lName'].'" data-value="'.$rows['dateJoined'].'"><i class="material-icons">edit</i></a></td>
                                            <td><a href="#" class="delUserModal" data-id="'.$rows['id'].'" data-user="'.$rows['fName'].'" data-user1="'.$rows['lName'].'" data-value="'.$rows['dateJoined'].'"><i class="material-icons">delete</i></a></td>
                                        </tr>';
                                        $sn++;
                            }
                        } else {

                        }
                    ?>
                </tbody>
            </table>

            <!-- delete Users Modal Structure -->
            <div id="deleteUsersModal" class="modal">
                <div class="modal-content center-align">
                    <h4>Delete Category</h4>
                    <p>Are you sure you want to delete this user <b>(<span id="deleteUsersName"></span>)</b>?</p>
                    <input type="hidden" id="deleteUsersId">
                    <div>
                        <button class="btn-large waves-effect waves-light red" id="doDeleteUser">Yes</button>
                        <button class="btn-large waves-effect waves-light modal-close">No</button>
                    </div>
                </div>
            </div>
        
        </div>
        
        <!-- Modal Trigger -->
        <!-- <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a> -->

        <!-- Users Update Modal Structure -->
        <div id="editUsersModal" class="modal bottom-sheet">
            <div class="modal-content">
                <form id="editUsersForm">
                    <div class="container">
                        <h4>
                            Edit User
                        </h4>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" placeholder="Enter user's name" name="editUsersName" id="editUsersName" class="validate">
                                <label for="editUsersName">Edit User's firstname</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" placeholder="Enter user's name" name="editUsersName1" id="editUsersName1" class="validate">
                                <label for="editUsersName1">Edit User's lastname</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="editUsersId" id="editUsersId"/>
                            <div class="input-field col s6">
                                <button class="btn waves-effect waves-light" type="submit" name="editUsersBtn" id="editUsersBtn" disabled>Edit
                                    <i class="material-icons right">edit</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="../js/materialize.min.js"></script>
    <script src="../js/ozForum.js"></script>
    
</body>
</html>

<?php
    } else {
        header('Location: index.php');
    }
?>