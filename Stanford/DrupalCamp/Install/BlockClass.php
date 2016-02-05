<?php
/**
 * @file
 * Abstract Task Class.
 */

namespace Stanford\DrupalCamp\Install;
/**
 *
 */
class BlockClass extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *   Installation arguments.
   */
  public function execute(&$args = array()) {

    $fields = array('module', 'delta', 'css_class');
    $values = array(
      array("bean", "drupalcamp-propose-a-session-but", "well"),
    );

    // Key all the values.
    $insert = db_insert('block_class')->fields($fields);
    foreach ($values as $k => $value) {
      $db_values = array_combine($fields, $value);
      $insert->values($db_values);
    }
    $insert->execute();

  }

  /**
   * Dependencies.
   */
  public function requirements() {
    return array(
      'block_class',
    );
  }

}
