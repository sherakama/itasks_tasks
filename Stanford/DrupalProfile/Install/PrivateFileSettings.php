<?php
/**
 * @file
 * Abstract Task Class
 */

namespace Stanford\DrupalProfile\Install;

class PrivateFileSettings extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *  Installation arguments.
   */
  public function execute(&$args = array()) {

    $enable_s3fs = variable_get('enable_s3fs', 0);

    if ($enable_s3fs !== 1) {
      // Set private directory.
      $private_directory = 'sites/default/files/private';
      variable_set('file_private_path', $private_directory);
      // system_check_directory() is expecting a $form_element array.
      $element = array();
      $element['#value'] = $private_directory;
      // Check that the public directory exists; create it if it does not.
      system_check_directory($element);
    }

  }

  /**
   * @param array $tasks
   */
  public function requirements() {
    return array(
      'file',
    );
  }

}