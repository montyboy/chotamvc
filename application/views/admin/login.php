<div id="admin-login">
<form class="form-signin" method="post" action="">
	<h2 class="form-signin-heading">Admin Login</h2>
	<?php if(isset($error)): ?>
	<div class="alert alert-error"><?php echo $error;?></div>		
	<?php endif;?>	
	<input type="text" class="input-block-level" placeholder="Username" value="" name="username">
    <input type="password" class="input-block-level" placeholder="Password" value="" name="password">
    <img src="<?php echo BASEPATH."site/logincaptcha"; ?>" width="150" style="margin:0 0 15px 0;" />
    <input type="text" class="input-block-level" placeholder="Code" value="" name="code">
    <button class="btn btn-large btn-primary" type="submit">Login</button>
</form>
</div>
    