<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oz Forum - Admin Login</title>
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../fonts/material-icons.css">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            background: #ecf0f3;
        }
        .login-div {
            width: 370px;
            height: 550px;
            padding: 60px 35px 35px 35px;
            border-radius: 40px;
            background: #ecf0f3;
            box-shadow: 13px 13px 20px #cbced1,
                        -13px -13px 20px #ffffff;  
            position: relative;
            bottom: 21px;          
        }
        .logo {
            background: url();
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto;
            box-shadow: 0px 0px 2px #5f5f5f,/*logo shadow*/
                        0px 0px 0px 5px #ecf0f3,/*Offset*/
                        8px 8px 15px #a7aaaf,/*Bottom Right*/
                        -8px -8px 15px #fff;/*Top Left*/

        }
        .centre {
            text-align: center;
        }
        .title {
            font-size: 1.5rem;
        }
        .adminLoginGutter {
            margin-top: 8vh;
            margin-top: 6px;
        }
        .reg-div {
            background-color: rgb(17, 91, 114);
            width: 40%;
            height: 85vh;
            overflow-x: hidden;
        }
        .whiteTxt {
            color: white;
        }
        .successToast{
            background-color: green;
            color: white;
            font-style: bold;
        }
        .errorToast{
            background-color: red;
            color: black;
            font-style: bold;
        }
    </style>
</head>
<body>
    
    <!-- Admin Login Form -->
    <div class="login-div">
        <!-- <div class="logo"></div> -->
        <div class="title centre">Login</div>
        <div class="row adminLoginGutter">
            <form class="col s12" id="loginForm">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="uName" name="uName" type="text" class="validate" required>
                        <label for="uName">Username</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="pass" type="password" name="pass" class="validate" required>
                        <label for="pass">Password</label>
                    </div>
                </div>
                <div class="row">
                    <p>
                        <label>
                            <input type="radio" value="A" name="who" class="with-gap">
                            <span>Admin</span>
                        </label>
                        <label>
                            <input type="radio" value="G" name="who" class="with-gap">
                            <span>User</span>
                        </label>
                    </p>
                </div> 
                <div class="row">
                    <div class="col s12 centre">
                        <button class="col s12 btn waves-effect waves-light" type="submit" name="loginAction">Login
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <p class="centre">
                <small>
                    Don't have an account? <a href="#" id="toRegister">Create Account</a>
                </small>
            </p>
            <p class="centre">
                <small>
                    Forgot Account details? <a href="">Recover Account</a>
                </small>
            </p>
        </div>
    </div>
    
    <!-- Users Register Form -->
    <div class="reg-div hide">
        <!-- <div class="logo"></div> -->
        <div class="title centre whiteTxt">Create Account</div>
    
        <form class="row" id="regForm">
            <div class="">

                <div class="input-field col s6">
                    <input id="fName" name="fName" type="text" class="validate" require>
                    <label for="fName">Firstname</label>
                </div>
                <div class="input-field col s6">
                    <input id="lName" type="text" name="lName" class="validate" require>
                    <label for="lName">Lastname</label>
                </div>
                
                <div class="">
                    <div class="input-field col s6">
                        <input id="oName" name="oName" type="text" class="validate" require>
                        <label for="oName">othernames</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="email" type="email" name="email" class="validate" require>
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="">
                    <div class="input-field col s6">
                        <input id="securityPass" type="password" name="securityPass" class="validate" require>
                        <label for="securityPass">Password</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="cPassword" type="password" name="cPassword" class="validate" require>
                        <label for="cPassword">Confirm Password</label>
                    </div>
                </div>
                <div class="">
                    <div class="input-field col s12">
                        <input id="dob" type="date" name="dob" class="datepicker" require>
                        <label for="dob">Date of Birth</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="phone" type="number" name="phone" class="validate" minlength="11" maxlength="11" require>
                        <label for="phone">Phone Number</label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <input id="username" type="text" name="username">
                    <label for="username">Username</label>
                </div>
                <div class="input-field col s12">
                    <input id="regPass" type="password" name="regPass">
                    <label for="regPass">Password</label>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="addr" id="addr" class="validate">
                        <label for="addr">Address</label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <p class="col s6 centre">
                        <label>
                            <input class="with-gap" name="group3" value="M" type="radio" class="validate" checked />
                            <span>Male</span>
                        </label>
                    </p>
                    <p class="col s6 centre">
                        <label>
                            <input class="with-gap" name="group3" value="F" type="radio" class="validate"/>
                            <span>Female</span>
                        </label>
                    </p>
                </div>
                
                <div class="col s12 center">
                    <button class="btn waves-effect waves-light" id="regAction" type="submit" name="regAction">Submit
                        <i class="material-icons right">send</i>
                    </button>
                <div>
                
            </div>
            <div class="row">
                <p class="centre">
                    <small class="whiteTxt">
                        Already have an account? <a href="#" id="toLogin">Login</a>
                    </small>
                </p>
            </div>
        </form>            
       
    </div>

    

    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="../js/materialize.min.js"></script>
    <script src="../js/ozForum.js"></script>
</body>
</html>