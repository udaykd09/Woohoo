<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
            <meta charset="utf-8">
                <title>Register User</title>
                <meta name="generator" content="Bootply" />
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                    <link href="css/bootstrap.min.css" rel="stylesheet">
                        <link href="css/styles.css" rel="stylesheet">
                            </head>
    <body>
        <!--login modal-->
        <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" title="Logout" class="close" data-dismiss="modal" aria-hidden="true"><a href="logout.php">×</a></button>
<div><br></div>
                        <h1 class="text-center"><img src='woohoo1.png' alt='Cinque Terre' width='160' height='70'></h1>
                    </div>
                    <div class="modal-body">
                        <form class="form col-md-12 center-block" action="insert.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" placeholder="Firstname" name="firstname" required="true">
                                    </div>
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" placeholder="Lastname" name="lastname" required="true">
                                    </div>
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" placeholder="Email" name="mail" required="true">
                                    </div>
                            <div class="form-group">
                                <input type="password" class="form-control input-lg" placeholder="Password" name="pass" required="true">
                                    </div>
                            <label class="radio-inline btn-lg">
                                <input type="radio" name="gender" id="inlineRadio1" value="male"> <font face="Helvetica Neue" size="3">Male</font>
                                    </label>
                            <label class="radio-inline btn-lg">
                                <input type="radio" name="gender" id="inlineRadio2" value="female"> <font face="Helvetica Neue" size="3">Female</font>
                                    </label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"><font face="Helvetica Neue" size="3"> I agree to share details with the company</font>
                                        </label>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="Signup" value="Sign Up" class="btn btn-primary btn-lg btn-block">
                                    <input type="reset" value="Reset" class="btn btn-primary btn-lg btn-block">
                                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12">
                        <?php 
                        $msg = $_GET['insertMsg'];
                        echo $msg;
                        
                        ?>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>