<!-- Author: Susan Jang(sj7yj)
Login Form on home page -->

<!DOCTYPE html>
<html>
<div class="ml-auto p-2" id="login">
                <!-- login form -->
                <div class="wrapper">
                    <form class="form-signin" name="loginForm" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" style="padding:15px;">
                        <h4 class="form-signin-heading">Login</h4>

                        <!-- email input -->
                        <input style="margin-bottom:2px;" id="email" type="text" class="form-control" name="email" placeholder="Email" />
                        <span style="color:red;font-size:12px;" ><?php echo $username_err; ?></span>

                        <!-- password input -->
                        <input style="margin-bottom:2px;" id="password" type="password" class="form-control" name="password" placeholder="Password" />
                        <span style="color:red;font-size:12px;"><?php echo $password_err; ?></span>

                        <div class="text-center" style="margin-top:10px">
                            <input type="submit" id="loginBtn" name="submit" class="btn btn-primary" value="submit">
                        </div>

                        <p style ="font-size:15px;" class="d-flex justify-content-center"><a href="http://localhost:4200">Sign Up</a></p>
                    </form>
                </div>
            </div>
            </html>