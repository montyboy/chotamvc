<div class="span2">
  	<ul class="nav nav-pills nav-stacked">
  		<?php
  			global $adminmenu;
			if(is_array($adminmenu)){
  				foreach($adminmenu as $key => $values){
  					$class = ($modulename==$values)? " class=\"active\"" : "";	
  					echo "<li".$class."><a href=\"".$key."\">".$values."</a></li>";
  				}
  			}
  		?>
    </ul>
</div><!--/span-->