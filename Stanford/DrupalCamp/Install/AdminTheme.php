<?php
/**
 * @file
 * Abstract Task Class.
 */

namespace Stanford\DrupalCamp\Install;
/**
 *
 */
class AdminTheme extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *   Installation arguments.
   */
  public function execute(&$args = array()) {
    // Enable themes.
    $themes = array('adminimal_theme');
    theme_enable($themes);
    variable_set('admin_theme', 'adminimal_theme');
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
