<?php
/**
 * @file
 * Abstract Task Class
 */

namespace Stanford\DrupalProfile\Install;

class FileSettings extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *  Installation arguments.
   */
  public function execute(&$args = array()) {

    $enable_s3fs = variable_get('enable_s3fs', 0);

    if ($enable_s3fs == 1) {
      module_enable(array('s3fs'));
      variable_set('s3fs_use_s3_for_public', 1);
      variable_set('s3fs_use_s3_for_private', 1);
    }
    else {
      // Set private directory.
      $private_directory = 'sites/default/files/private';
      variable_set('file_private_path', $private_directory);
      // system_check_directory() is expecting a $form_element array.
      $element = array();
      $element['#value'] = $private_directory;
      // Check that the public directory exists; create it if it does not.
      system_check_directory($element);

      // Set public directory.
      $public_directory = 'sites/default/files';
      variable_set('file_public_path', $public_directory);
      // Set default scheme to public file handling.
      variable_set('file_default_scheme', 'public');
      // system_check_directory() is expecting a $form_element array.
      $element = array();
      $element['#value'] = $public_directory;
      $element['#name'] = 'file_public_path';
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
