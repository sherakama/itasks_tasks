<?php
/**
 * @file
 * Abstract Task Class.
 */

namespace Stanford\Jumpstart\Install;
/**
 *
 */
class ThemeSettings extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *   Installation arguments.
   */
  public function execute(&$args = array()) {

    // Enable themes.
    $themes = array('stanford_framework', 'stanford_seven');
    theme_enable($themes);

    variable_set('theme_default', 'stanford_framework');
    variable_set('admin_theme', 'stanford_seven');
    variable_set('node_admin_theme', 1);

  }

}
