<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="brand" href="#"><?php echo SITE_NAME;?></a>
      <?php if($user->isLoggedIn()):?>
      <div class="pull-right nav-collapse collapse">
        <ul class="nav nav-pills">
			<li class="dropdown">
            	<a class="dropdown-toggle" data-toggle="dropdown" href="#">My Account<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/admin/editprofile">Update Profile</a></li>
                  <li><a href="/admin/changepassword">Change Password</a></li>
                  <li><a href="/admin/logout">Logout</a></li>
                </ul>
             </li>
         </ul>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>