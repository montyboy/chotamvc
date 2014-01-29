<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vinayak_bhomkar
 * Date: 1/29/14
 * Time: 7:12 PM
 * To change this template use File | Settings | File Templates.
 */

class user extends Model {

  public function setTableDefinition() {
    $this->hasColumn('username', 'string', 255);
    $this->hasColumn('password', 'string', 255);
    $this->hasColumn('first_name', 'string', 255);
    $this->hasColumn('last_name', 'string', 255);
  }
}