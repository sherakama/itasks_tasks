<?php
/**
 * @file
 * Abstract Task Class.
 */

namespace Stanford\DrupalCamp\Install;
/**
 *
 */
class GeneralConfiguration extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *   Installation arguments.
   */
  public function execute(&$args = array()) {
    // Set the home page.
    variable_set("site_frontpage", drupal_get_normal_path("welcome-stanford-drupalcamp"));
    module_disable(array("dashboard"), TRUE);
  }

  /**
   * Dependencies.
   */
  public function requirements() {
    return array(
      'adminimal_admin_menu',
      'admin_menu',
    );
  }

}
