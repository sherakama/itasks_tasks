<?php
/**
 * @file
 * Abstract Task Class
 */

namespace Drupal\Standard\Install;

class FullHTMLFormat extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *  Installation arguments.
   */
  public function execute(&$args = array()) {
    // Add text formats.
    $full_html_format = array(
      'format' => 'full_html',
      'name' => 'Full HTML',
      'weight' => 1,
      'filters' => array(
        // URL filter.
        'filter_url' => array(
          'weight' => 0,
          'status' => 1,
        ),
        // Line break filter.
        'filter_autop' => array(
          'weight' => 1,
          'status' => 1,
        ),
        // HTML corrector filter.
        'filter_htmlcorrector' => array(
          'weight' => 10,
          'status' => 1,
        ),
      ),
    );
    $full_html_format = (object) $full_html_format;
    filter_format_save($full_html_format);
  }

}
