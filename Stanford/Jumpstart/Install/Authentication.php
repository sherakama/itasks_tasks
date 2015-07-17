<?php
/**
 * @file
 * Abstract Task Class.
 */

namespace Stanford\Jumpstart\Install;
/**
 *
 */
class Authentication extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *   Installation arguments.
   */
  public function execute(&$args = array()) {

    // Check our chosen authentication scheme.
    $auth_method = variable_get('stanford_sites_auth_method', 'webauth');

    // If we're using WMD, enable the webauth_extras module.
    if ($auth_method == 'webauth') {
      module_enable(array('webauth_extras'));
      variable_set('webauth_link_text', "SUNetID Login");
      variable_set('webauth_allow_local', 0);
    }

    // Map itservices:webservices to administrator role
    // drush wamr itservices:webservices administrator.
    if(module_exists('webauth_extras')) {
      module_load_include('inc', 'webauth_extras', 'webauth_extras.drush');
      drush_webauth_extras_webauth_map_role('itservices:webservices', 'administrator');
    }

  }

}
