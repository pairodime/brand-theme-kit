<?php

/**
* Preprocess variables for  html.tpl.php.
* template_preprocess_html
*/
function brandtheme_preprocess_html(&$variables) {
  // Ensure that the $vars['rdf'] variable is an object.
 if (!isset($variables['rdf']) || !is_object($variables['rdf'])) {
    $variables['rdf'] = new StdClass();
 }
 if (module_exists('rdf')) {
     $variables['doctype'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML+RDFa 1.1//EN">' . "\n";
     $variables['rdf']->version = ' version="HTML+RDFa 1.1"';
     $variables['rdf']->namespaces = $variables['rdf_namespaces'];
     $variables['rdf']->profile = ' profile="' . $variables['grddl_profile'] . '"';
 } else {
     $variables['doctype'] = '<!DOCTYPE html>' . "\n";
     $variables['rdf']->version = '';
     $variables['rdf']->namespaces = '';
     $variables['rdf']->profile = '';
 }
 // Add Page Title to body.class array
 if (isset($variables['head_title_array']['title'])){
    $variables['classes_array'][] = 'page-' .drupal_html_class($variables['head_title_array']['title']);
 }

 // External CSS
 drupal_add_css('//fast.fonts.net/t/1.css?apiType=css&projectid=4908638c', array('type' => 'external'));

 // External JS
// drupal_add_js('http://fast.fonts.net/jsapi/1375f3ab-ae06-409d-9307-ef74f4f15eb7.js', array('type' => 'external'));

 //print kpr($variables);
}

/**
* Preprocess = Page
*/
function brandtheme_preprocess_page(&$variables, $hook) {
   // Page template suggestions based off of content types
   if (isset($variables['node'])) {
      $variables['theme_hook_suggestions'][] = 'page__type__'. $variables['node']->type;
      $variables['theme_hook_suggestions'][] = "page__node__" . $variables['node']->nid;
   }

   // Page template suggestions based off URL alias
   if (module_exists('path')) {
    $alias = drupal_get_path_alias(str_replace('/edit','',$_GET['q']));
    if ($alias != $_GET['q']) {
      $template_filename = 'page';
      foreach (explode('/', $alias) as $path_part) {
        $template_filename = $template_filename . '__' . $path_part;
        $variables['theme_hook_suggestions'][] = $template_filename;
      }
    }
  }
}

/**
* theme_menu_link()
*/
function brandtheme_menu_link(array $variables) {
//add class for li
   $variables['element']['#attributes']['class'][] = 'menu-' . $variables['element']['#original_link']['mlid'];
//add class for a
   $variables['element']['#localized_options']['attributes']['class'][] = 'menu-' . $variables['element']['#original_link']['mlid'];
//dvm($variables['element']);
  return theme_menu_link($variables);
}