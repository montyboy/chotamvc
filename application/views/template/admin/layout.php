<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="public/cms/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="public/cms/css/admin.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery.js"></script>
<script src="public/cms/js/bootstrap.min.js"></script>
<div class="container-fluid">
<?php
include_partial("template/admin/header");
?>

<?php
//include content
include($content_page);
?>
<?php
//include footer partial
include_partial("template/admin/footer");
?>
</div>
</body>	
</html>