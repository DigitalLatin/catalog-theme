<?php

include_once __DIR__ . "/functions_standard.php";
include_once __DIR__ . "/includes/DllNodeFormatter.php";

function fionta_base_theme_preprocess_page(&$vars)
{
  if ($format = _fionta_getFormat() and DLLNodeFormatter::isFormattable()) {
    $node_type = $vars['node']->type;

    $formatter = new DLLNodeFormatter($vars['node'], $format);
    $formatter->modifyDisplay($vars);
  }

   if (isset($vars['node'])) {
    $vars['theme_hook_suggestion'] = 'page__' . $vars['node']->type;
  }
}
