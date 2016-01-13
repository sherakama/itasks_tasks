<?php
/**
 * @file
 * Abstract Task Class.
 */

namespace Stanford\DrupalCamp\Install;
/**
 *
 */
class MenuSettings extends \AbstractInstallTask {

  /**
   * Set the site name.
   *
   * @param array $args
   *   Installation arguments.
   */
  public function execute(&$args = array()) {

    $items = array();

    // Rebuild the menu cache before starting this.
    drupal_static_reset();
    menu_cache_clear_all();
    menu_rebuild();

    $items['about'] = array(
      'link_path' => drupal_get_normal_path('about/what-to-expect'),
      'link_title' => 'About',
      'menu_name' => 'main-menu',
      'weight' => -8,
    );

    $items['about/what-to-expect'] = array(
      'link_path' => drupal_get_normal_path('about/what-to-expect'),
      'link_title' => 'What to expect',
      'menu_name' => 'main-menu',
      'parent' => 'about',
      'weight' => -9,
      'expanded' => TRUE,
    );

    $items['about/organizing-committee'] = array(
      'link_path' => drupal_get_normal_path('about/organizing-committee'),
      'link_title' => 'Organizing Committee',
      'menu_name' => 'main-menu',
      'weight' => -8,
      'parent' => 'about',
    );

    $items['about/past-camps'] = array(
      'link_path' => drupal_get_normal_path('about/past-camps'),
      'link_title' => 'Past Camps',
      'menu_name' => 'main-menu',
      'weight' => -7,
      'parent' => "about",
    );

    $items['venue'] = array(
      'link_path' => drupal_get_normal_path('venue'),
      'link_title' => 'Location',
      'menu_name' => 'main-menu',
      'weight' => -4,
    );

    $items['stanford-jobs'] = array(
      'link_path' => drupal_get_normal_path('stanford-jobs'),
      'link_title' => 'Stanford Jobs',
      'menu_name' => 'main-menu',
      'weight' => -3,
    );

    // Loop through each of the items and save them.
    foreach ($items as $k => $v) {

      // Check to see if there is a parent declaration. If there is then find
      // the mlid of the parent item and attach it to the menu item being saved.
      if (isset($v['parent'])) {
        $v['plid'] = $items[$v['parent']]['mlid'];
        unset($v['parent']); // Remove fluff before save.
      }

      // Save the menu item.
      $mlid = menu_link_save($v);
      $v['mlid'] = $mlid;
      $items[$k] = $v;
    }

    // The home link weight needs to change so that it is in front..
    $home_search = db_select('menu_links', 'ml')
      ->fields('ml', array('mlid'))
      ->condition('menu_name', 'main-menu')
      ->condition('link_path', '<front>')
      ->condition('link_title', 'Home')
      ->execute()
      ->fetchAssoc();

    if (is_numeric($home_search['mlid'])) {
      $menu_link = menu_link_load($home_search['mlid']);
      $menu_link['weight'] = -50;
      menu_link_save($menu_link);
    }

  }

}
