<?php
/**
 * @file
 * Abstract Task Class.
 */
namespace Drupal\Standard\Update;
/**
 *
 */
class Example extends \AbstractUpdateTask {

  protected $description = "Change the site name to my new site name";

  /**
   * Set the site name.
   *
   * @param array $args
   *   Installation arguments.
   */
  public function execute(&$args = array()) {
    variable_set("site_name", "My New Site Name IS: " . md5(time()));
  }
  
}
