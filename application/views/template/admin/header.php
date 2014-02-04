<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="brand" href="#"><?php echo SITE_NAME;?></a>
      <?php if($user->isLoggedIn()):?>
      	<div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="icon-user"></i> <?php echo $user->username;?><span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="/adminuser/editprofile">Update Profile</a></li>
                 <li><a href="/adminuser/changepassword">Change Password</a></li>
                <li><a href="/admin/logout">Logout</a></li>
            </ul>
        </div>
      <?php endif;?>
    </div>
  </div>
</div>