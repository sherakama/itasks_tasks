<?php
/**
 * @file
 * Abstract Task Class
 */

namespace Drupal\Standard\Install;

class GeneralConfig extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *  Installation arguments.
   */
  public function execute(&$args = array()) {

    // Enable default permissions for system roles.
    $filtered_html_permission = "use text format filtered_html";
    user_role_grant_permissions(DRUPAL_ANONYMOUS_RID, array('access content', 'access comments', $filtered_html_permission));
    user_role_grant_permissions(DRUPAL_AUTHENTICATED_RID, array('access content', 'access comments', 'post comments', 'skip comment approval', $filtered_html_permission));

    // Enable the admin theme.
    db_update('system')
      ->fields(array('status' => 1))
      ->condition('type', 'theme')
      ->condition('name', 'seven')
      ->execute();

    variable_set('admin_theme', 'seven');
    variable_set('node_admin_theme', '1');

  }

  /**
   * [requirements description]
   * @return [type] [description]
   */
  public function requirements() {
    return  array(
      'comment',
      'filter',
    );
  }

}
