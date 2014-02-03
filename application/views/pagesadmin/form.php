<fieldset>
  <div class="row">
      <div class="cell"><?php echo $label_headline . $headline?></div>
  </div>
  <div class="clear" style="margin-bottom:10px"></div>

  <div class="row">
      <div class="cell"><?php echo $label_description.$description;?></div>
  </div>
  <div class="clear" style="margin-bottom:10px"></div>

  <div class="row">
      <div class="cell">
        <?php
          echo $label_status;
        ?>
      </div>
      <div class="clear" style="margin-bottom:5px"></div>
      <div class="cell">
        <?php
        echo $status_1." Active";
        echo "&nbsp;&nbsp;&nbsp;";
        echo $status_0." Inactive";
        ?>
      </div>
  </div>
  <div class="clear" style="margin-bottom:10px"></div>

  <div class="row">
    <button type="submit" class="btn"><i class=" icon-ok-sign"></i>&nbsp;Save</button>
    <button type="button" class="btn"><i class="icon-ban-circle"></i>&nbsp;Cancel the changes</button>
  </div>
</fieldset>
