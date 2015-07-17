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
    }
  }

}
