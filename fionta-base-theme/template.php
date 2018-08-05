<?php

include_once __DIR__."/functions_standard.php";

function fionta_base_theme_preprocess_page(&$vars) {
 if (isset($vars['node'])) {
$vars['theme_hook_suggestion'] = 'page__'.$vars['node']->type;
 }
}
