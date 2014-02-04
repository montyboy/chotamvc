<fieldset>
  <?php echo(isset($zf_error) ? $zf_error : (isset($error) ? $error : '')); ?>
	<div class="row">
      <div class="cell"><?php echo $label_firstname . $firstname?></div>
  	</div>
  	<div class="clear" style="margin-bottom:10px"></div>
  	
  	<div class="row">
      <div class="cell"><?php echo $label_lastname . $lastname?></div>
  	</div>
  	<div class="clear" style="margin-bottom:10px"></div>	
  	
  	<div class="row">
      <div class="cell"><?php echo $label_email. $email?></div>
  	</div>
  	<div class="clear" style="margin-bottom:10px"></div>

  	<div class="row">
    	<button type="submit" class="btn"><i class=" icon-ok-sign"></i>&nbsp;Update details</button>
    	<button type="button" class="btn"><i class="icon-ban-circle"></i>&nbsp;Cancel</button>
  	</div>
</fieldset>
