<?php if(isset($coremessages)):?>
<div class="alert alert-success"><?php echo $coremessages;?></div>
<?php endif;?>

<a href="add" class="btn"><i class="icon-plus-sign"></i>&nbsp;Add new page</a>
<br/>
<?php

$listObj = new Grid("pages");

$listObj->model = Pages::getInstance();
			
#Format 
#$listObj->caption[] = "[LABEL][FIELDTYPE][DBFIELD][ORDER (Y/N)][WIDTH][EXTRACSS][STYLE]"; 
$listObj->ItemArr[0] = "{[Headline][headline][Y:headline][350][#][][]}"; 
$listObj->ItemArr[1] = "{[Status][status][Y:status][70][#][center][]}"; 
$listObj->ItemArr[2] = "{[Edit][NULL:editField][N][70][/pagesadmin/edit][center][]}";
$listObj->ItemArr[3] = "{[Delete][NULL:deleteField][N][70][/pagesadmin/delete][center][]}";
$listObj->listWidth = "760";

$listObj->tableName = "pages";
$listObj->whereCond = "";
$listObj->orderBy = (!empty($_GET['orderBy'])) ? $_GET['orderBy'] : "headline";
$listObj->orderTyp = (!empty($_GET['orderTyp'])) ? $_GET['orderTyp'] : "asc";
$listObj->pageNavigator = true;
$listObj->showPerPage = "10";
$listObj->createList();

?>