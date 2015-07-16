<?php
/**
 * @file
 * Abstract Task Class
 */

namespace Stanford\Jumpstart\Install;

class SiteName extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *  Installation arguments.
   */
  public function execute(&$args = array()) {
    variable_set("site_name", "My New Site Name");
  }

  /**
   * @param array $tasks
   */
  public function requirements() {
    return array(
      'block',
    );
  }

}
