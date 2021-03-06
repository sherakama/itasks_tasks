<?php
/**
 * @file
 * Abstract Task Class
 */

namespace Environment\Local\Install;

class GeneralSettings extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *  Installation arguments.
   */
  public function execute(&$args = array()) {
    variable_set("site_name", "Local Install");
  }

  /**
   * @param array $tasks
   */
  public function requirements() {
    return array(
    );
  }

}
