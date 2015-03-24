<?php
    include "functions.php";
    include "header.php";

?>    
    <body>
    <div id="container">
	<div class="row">
	    <div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
		    <div class="panel-heading"><center><strong>Member Login</center></div> 
		    <div class="panel-body">
			<form name="loginForm" role="form" id="login_form" action="login_proc.php" method="post" novalidate >
			    <div ng-class="{'has-error': loginForm.user_name.$invalid && loginForm.user_name.$dirty}" class="form-group">	
					<label for="user_name">User name</label>
					<input type="email" class="form-control" ng-maxlength=20 ng-model="user_name" id="user_name" name="user_name" placeholder="Enter user name" required >
						<!-- ERRORS ASSOCIATED WITH USERNAME INPUT -->
						<span class="help-block" ng-show="loginForm.user_name.$error.required && loginForm.user_name.$dirty">
							<small>Please enter username</small>
						</span>
						<span class="help-block" ng-show="loginForm.user_name.$error.email && loginForm.user_name.$dirty">
							<small>Invalid user name: should be email</small>
						</span>
						<span class="help-block" ng-show="loginForm.user_name.$error.maxlength && loginForm.user_name.$dirty">
							<small>Username can not be more than 20 characters</small>
						</span>
			    </div>
			    <div class="form-group" ng-class="{'has-error': loginForm.user_pass.$invalid && loginForm.user_pass.$dirty}">	
					<label for="user_pass">Password</label>
					<input type="password" class="form-control"	ng-model="user_pass" id="user_pass" name="user_pass" placeholder="Enter password" required >
						<!-- ERRORS ASSOCIATED WITH PASSWORD INPUT -->
						<span class="help-block" ng-show="loginForm.user_pass.$error.required && loginForm.user_pass.$dirty">
							<small>Please enter Password</span></small>
						</span>
			    </div>
			    <div class="form-group">
			    	<button type="submit" class="btn btn-primary" ng-disabled="!loginForm.$valid" name="submit" id="submit" value="Login"><span class="glyphicon glyphicon-log-in"></span> Login</button>
				</div>
			</form>
		    </div> <!-- end panel body -->
		</div> <!-- end panel -->
	    </div> <!-- end column --> 
	</div> <!-- end row -->		     
    </div> <!-- end container -->
    </body> <!-- end body -->
</html> <!-- end html -->



