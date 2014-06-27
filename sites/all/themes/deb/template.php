<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */
/**
* Override Menu "The Quest" HTML output. 
*
*/
function pcgc_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      $element['#title'] .= ' <span class="caret"></span>';
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function pcgc_menu_tree(&$variables) {
  return '<ul class="nav navbar-nav navbar-right">' . $variables['tree'] . '</ul>';
}

function pcgc_preprocess_page(&$variables) {
  //$variables['logo2'] = base_path() . path_to_theme() . '/images/katech-logo-opt.png';
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-sm-8"';
  }
  elseif (!empty($variables['page']['sidebar_first']) ) {
    $variables['content_column_class'] = ' class="col-sm-10"';
  }
  elseif (!empty($variables['page']['sidebar_second']) ) {
    $variables['content_column_class'] = ' class="col-sm-10"';
  }
  else {
    $variables['content_column_class'] = ' class="col-sm-12"';
  }
  if($variables['is_front']) {
    $variables['title'] = '';
  }
  $search_box_var = drupal_get_form('search_form');
  $search_box = drupal_render($search_box_var);
  $variables['search_box'] = $search_box;
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

    // if the url is: 'http://domain.com/node/123/edit'
    // and node type is 'blog'..
    // 
    // This will be the suggestions:
    //
    // - page__node
    // - page__node__%
    // - page__node__123
    // - page__node__edit
    // - page__type_blog
    // - page__type_blog__%
    // - page__type_blog__123
    // - page__type_blog__edit
    // 
    // Which connects to these templates:
    //
    // - page--node.tpl.php
    // - page--node--%.tpl.php
    // - page--node--123.tpl.php
    // - page--node--edit.tpl.php
    // - page--type-blog.tpl.php          << this is what you want.
    // - page--type-blog--%.tpl.php
    // - page--type-blog--123.tpl.php
    // - page--type-blog--edit.tpl.php
    // 
    // Latter items take precedence.
  }
  $variables['primary_nav'] = FALSE;
  if ($variables['main_menu']) {
    $variables['primary_nav'] = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
    $variables['primary_nav']['#theme_wrappers'] = array('menu_tree__primary');
  }
}

function pcgc_preprocess_node(&$variables) {
  if ($variables['node']->type == 'page' && !drupal_is_front_page()) {
  }
}

function pcgc_form_alter(&$form, &$form_state, $form_id) {
  //dsm($form_id);
  switch ($form_id) {
    case 'search_block_form':
      $form['search_block_form']['#size'] = 34;
      $form['actions']['submit']['#class'] = t('btn');
      $form['actions']['submit']['#value'] = t('Search'); // Change the text on the submit button
      // $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search-button.png');
      $form['actions']['submit']['#attributes']['class'][] = 'btn btn-default';

      // Alternative (HTML5) placeholder attribute instead of using the javascript
      $form['search_block_form']['#attributes']['placeholder'] = t('Search...');
      $form['search_block_form']['#attributes']['class'][] = 'test';
    break;
    case 'user_login':
    case 'user_login_form':
    case 'user_login_block':
    case 'user_register':
    case 'user_register_form':
    case 'webform_client_form_23':
    case 'webform_client_form_24':
      $form['#prefix'] = '<div class="row"><div class="col-xs-6">';
      $form['#suffix'] = '</div></div>';
      $form['user_login']['#attributes']['class'][] = 'form-horizontal';
      $form['actions']['#theme_wrappers'] = array();
      $form['actions']['submit']['#attributes']['class'] = array('btn btn-default');
    break;
  }
}

/**
* Preprocess function for correct javascripts on front-end vs. back-end.
*
*/
function pcgc_js_alter(&$js) {

    if (arg(0) != 'admin' || !(arg(1) == '1' && arg(2) == 'imce') || !(arg(1) == 'add' && arg(2) == 'edit') || arg(0) != 'panels' || arg(0) != 'ctools') {

    $theme_path = drupal_get_path('theme', 'pcgc');
    $new_jquery = $theme_path . '/bower_components/jquery/dist/jquery.min.js';
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

function pcgc_multiexplode($delimiters,$string) {
  $ready = str_replace($delimiters, $delimiters[0], $string);
  $launch = explode($delimiters[0], $ready);
  return  $launch;
}

