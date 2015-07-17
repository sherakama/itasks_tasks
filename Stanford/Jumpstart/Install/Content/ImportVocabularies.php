<?php
/**
 * @file
 * Abstract Task Class.
 */

namespace Stanford\Jumpstart\Install\Content;
/**
 *
 */
class ImportVocabularies extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *   Installation arguments.
   */
  public function execute(&$args = array()) {

    $endpoint = "https://sites.stanford.edu/jsa-content/jsainstall";

    // Restrictions
    // These entities we do not want even if they appear in the feed.
    $restrict = array(
      'tags',              // tags vocabulary
      'sites_products',    // products vocabulary
    );

    // Vocabularies.
    $importer = new \SitesContentImporter();
    $importer->set_endpoint($endpoint);
    $importer->add_restricted_vocabularies($restrict);
    $importer->import_vocabulary_trees();

  }

}







