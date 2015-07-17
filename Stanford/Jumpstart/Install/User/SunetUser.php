<?php
/**
 * @file
 * Abstract Task Class.
 */

namespace Stanford\Jumpstart\Install\User;
/**
 *
 */
class SunetUser extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *   Installation arguments.
   */
  public function execute(&$args = array()) {

    $install_state = $args['install_state'];

    // Need this for UI install.
    require_once DRUPAL_ROOT . '/includes/password.inc';
    $config_form_data = $install_state['forms']['install_configure_form'];

    $sunetid    = "webservices";

    $sunet = strtolower(trim($sunetid));
    $authname = $sunet . '@stanford.edu';
    $sunet_role = user_role_load_by_name('SUNet User');
    $owner_role = user_role_load_by_name('site owner');

    // Change the sunet requester user to site owner.
    $edit = array();
    $user3 = user_load_by_mail($authname);

    if ($user3) {
      $roles = array(DRUPAL_AUTHENTICATED_RID => TRUE, $sunet_role->rid => TRUE, $owner_role->rid => TRUE);
      $edit['roles'] = $roles;
      $user3 = user_save($user3, $edit);

      // Check our chosen authentication scheme.
      $auth_method = variable_get('stanford_sites_auth_method', 'webauth');

      if ($auth_method == 'simplesamlphp') {
        user_set_authmaps($user3, array('authname_simplesamlphp_auth' => $authname));
      }
      elseif ($authname == "webauth") {
        user_set_authmaps($user3, array('authname_webauth' => $authname));
      }

    }

  }

  /**
   * [requirements description].
   *
   * @return [type] [description]
   */
  public function requirements() {
    return array(
      'user',
    );
  }

}
