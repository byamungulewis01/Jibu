<?php require 'top-layout.php'; ?>
<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				
				<img src="../Images/Logo.png" width="200" height="200">
                <h3>PLEASE LOGIN TO APP</h3>
			</div>
			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                        <form action="config/Admin_login.php" method="post">
                            <?php if(isset($_GET['session'])) { ?>
                                <div class="alert alert-warning">Please login First</div>
                                <?php } ?>
                            <?php if(isset($_GET['fail'])) { ?>
                                <div class="alert alert-warning">Wrong username or Password</div>
                                <?php } ?>
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="Username" title="Please enter you username" required="" name="username"  class="form-control">
                                <span class="help-block small">Your unique Email</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required=""  name="password" class="form-control">
                                <span class="help-block small">Your password</span>
                            </div>
                           
                            <button class="btn btn-success btn-block loginbtn" name="submit">Login</button>
                           
                        </form>
                    </div>
                </div>
                
			</div>

		</div>   
    </div>
    <?php require 'bottom-layout.php'; ?>