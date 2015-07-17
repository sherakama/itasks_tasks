<?php
/**
 * @file
 * Abstract Task Class.
 */

namespace Stanford\Jumpstart\Install;
/**
 *
 */
class GeneralSettings extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *   Installation arguments.
   */
  public function execute(&$args = array()) {

    // $site_name  = variable_get('site_name', "Stanford Jumpstart");
    // variable_set('site_name', $site_name);

    $four_oh_four = drupal_get_normal_path('404');
    variable_set('site_404', $four_oh_four);

    // Turn views into more developer like.
    module_load_include('inc', 'views', 'drush/views.drush');
    views_development_settings();

    // Unset user menu as secondary links.
    variable_set('menu_secondary_links_source', "");

  }

}
