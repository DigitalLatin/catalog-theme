<?php

/**
 *  Wrapper for drupal_get_path_alias which handles front page exception better
 *
 */
function fionta_current_alias_path() {
	return (drupal_is_front_page() ? '' : drupal_get_path_alias(current_path()));
}


/**
 *  Implements hook_preprocess_html
 *
 *  Adds a theme specific class to the body of the page, which is helpful for CSS selecting
 *  
 */
function fionta_base_theme_preprocess_html(&$vars) {
    $vars['classes_array'][] = 'fionta_base_theme';

    if ($format = _fionta_getFormat() and _fionta_isFormattableNodeType()) {
        $vars['theme_hook_suggestion'] = 'html__blank';
    }
}

/**
 * Figures out the output format from globals and whatnot.
 */
function _fionta_getFormat() {
    $allowed_formats = ['xml', 'json', 'rdf'];

    if (isset($_GET['format']) && in_array($_GET['format'], $allowed_formats)) {
        return $_GET['format'];
    }

    return false;

    // TODO: Path manipulation?
}

function _fionta_isFormattableNodeType() {
    if (!$node = menu_get_object()) {
        return false;
    }

    $allowed_node_types = [
        'author_authorities',
        'dll_work',
        'repository_item',
        'manuscript',
        'web_page',
    ];

    return isset($node->type) && in_array($node->type, $allowed_node_types);
}


/**
 *  Will generate html and print it to screen for a block
 *  
 *  @param $module, the module which owns the block.  Standard editable blocks are owned by the "block" module.
 *  @param $delta, the unique identifier the module has for the block.  Is numeric for editable blocks.
 *
 */
function fionta_render_block ($module, $delta) {	
	// Alternative way
	//   $block = module_invoke('md_slider', 'block_view', 'home');
	//   print render($block['content']);
	$block = block_load($module, $delta);
	$renderable_array = _block_get_renderable_array(_block_render_blocks(array($block)));
	print drupal_render($renderable_array);
}


/**
 *  Will return and print(optional) a menu
 *  
 *  @param $menu_name string, the menu to be rendered
 *  @param $max_depth int, the maximum depth you'd like the rendering to go into the menu
 *  @param $print boolean, print $html if true
 *
 *  @return $html string, the menu rendered as html
 */
function fionta_render_menu($menu_name, $max_depth=10, $print=true) {
    $html = fionta_print_menu_tree(menu_build_tree($menu_name), $max_depth);
    if ($print) print $html;
    return $html;
}


function fionta_get_menu_tree_html($menu_tree, $max_depth=10) {
    $html = "";
    $depth = reset($menu_tree)['link']['depth'];
    $html.= "<ul class='depth-$depth'>";
    foreach($menu_tree as $item) {

        if (isset($item['link']['hidden']) and $item['link']['hidden']) continue;
        
        $url = drupal_get_path_alias($item['link']['link_path']);
        $text = $item['link']['link_title'];
        $html.= "<li>";
        $html.= "<a href='$url'><div>$text</div></a>";
        if(count($item['below']) and $depth<$max_depth) {
            fionta_print_menu_tree($item['below'], $max_depth);
        }
        $html.= "</li>";

    }
    $html.= "</ul>";
    return $html;
}

