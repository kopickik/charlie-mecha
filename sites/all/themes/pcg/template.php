<?php

/**
 * @file
 * template.php
 */

function pcg_preprocess_page(&$variables) {
  if (isset($variables['node'])) {

    $suggests = &$variables['theme_hook_suggestions'];

    // Get path arguments.
    $args = arg();
    // Remove first argument of "node".
    unset($args[0]);

    // Set type.
    $type = "page__type_{$variables['node']->type}";

    // Bring it all together.
    $suggests = array_merge(
      $suggests,
      array($type),
      theme_get_suggestions($args, $type)
    );
  }
}

function pcg_preprocess_node(&$variables) {
  foreach (system_region_list($GLOBALS['theme']) as $region_key => $region_name) {
    // Get the content for each region and add it to the $region var
    if ($blocks = block_get_blocks_by_region($region_key)) {
      $variables['region'][$region_key] = $blocks;
    }
    else {
      $variables['region'][$region_key] = array();
    }
  }
  if (isset($variables['node'])) {
    $node_type = $variables['node']->type;
    $theme_path = drupal_get_path('theme', 'pcg');
    if ($node_type == 'case_study' || $node_type == 'full_width_page') {
      drupal_add_css($theme_path . '/bower_components/flexslider/flexslider.css', array('group' => CSS_THEME));
      drupal_add_css($theme_path . '/js/rs-plugin/css/settings.css', array('group' => CSS_THEME));
      drupal_add_js($theme_path . '/bower_components/flexslider/jquery.flexslider-min.js', array('group' => JS_THEME));
      drupal_add_js($theme_path . '/js/rs-plugin/js/jquery.themepunch.plugins.min.js', array('group' => JS_THEME));
      drupal_add_js($theme_path . '/js/rs-plugin/js/jquery.themepunch.revolution.min.js', array('group' => JS_THEME));
    }
  }
}

//function pcg_preprocess_image(&$variables) {
//    if ($variables['style_name'] == 'full_width_cover') {
//        $variables['attributes']['class'][] = 'img-responsive';
//    }
//}

/**
* Preprocess function for correct version of jQuery on front-end vs. back-end.
*
*/
function pcg_js_alter(&$js) {

    if (arg(0) != 'admin' || !(arg(1) == '1' && arg(2) == 'imce') || !(arg(1) == 'add' && arg(2) == 'edit') || arg(0) != 'panels' || arg(0) != 'ctools') {

    $theme_path = drupal_get_path('theme', 'pcg');
    $new_jquery = $theme_path . '/bower_components/jquery/jquery.min.js';
    //$new_jquery = $theme_path . '/bower_components/jquery/dist/jquery.min.js';
  
    // Copy the current jQuery file settings and change
    $js[$new_jquery] = $js['misc/jquery.js'];
  
    // Update necessary settings
    $js[$new_jquery]['version'] = 1.11;
    $js[$new_jquery]['data'] = $new_jquery;
  
    // Finally remove the original jQuery
    unset($js['misc/jquery.js']);
  }
}