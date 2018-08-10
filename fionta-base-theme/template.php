<?php

include_once __DIR__ . "/functions_standard.php";
include_once __DIR__ . "/includes/dll_node_formatter.php";

function fionta_base_theme_preprocess_page(&$vars)
{
  if ($format = _fionta_getFormat() and _fionta_isFormattableNodeType()) {
    $node_type = $vars['node']->type;

    switch ($format) {
      case 'xml':
        drupal_add_http_header('Content-Type', 'text/xml');
        $vars['theme_hook_suggestion'] = 'page__xmlmads';
        $vars['dll_template'] = dll_get_xml_format($vars['node']);
        return;
      case 'rdf':
        drupal_add_http_header('Content-Type', 'text/xml');
        $vars['theme_hook_suggestion'] = 'page__rdfxml';
        return;
      case 'json':
        drupal_add_http_header('Content-Type', 'application/json');
        $vars['theme_hook_suggestion'] = 'page__json';
        return;
    }
  }

  if (isset($vars['node'])) {
    $vars['theme_hook_suggestion'] = 'page__' . $vars['node']->type;
  }
}
