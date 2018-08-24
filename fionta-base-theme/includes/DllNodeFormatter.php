<?php

require_once dirname(__FILE__) . '/DllAuthorAuthoritiesFormatter.php';
require_once dirname(__FILE__) . '/DllRepositoryItemFormatter.php';
require_once dirname(__FILE__) . '/DllWebPageFormatter.php';
require_once dirname(__FILE__) . '/DllDllWorkFormatter.php';

class DLLNodeFormatter {
  private $node;
  private $format;

  private $formatter;

  public function __construct($node, $format) {
    $this->node = $node;
    $this->format = $format;
  }

  public static function isFormattable() {
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

  public function modifyDisplay(&$vars) {
    // TODO: This will probably be subsumed by yonder subclasses
    switch ($this->format) {
      case 'xml':
        drupal_add_http_header('Content-Type', 'text/xml');
        $vars['theme_hook_suggestions'][] = 'page__xmlmads';
        break;
      case 'json':
        $vars['theme_hook_suggestions'][] = 'page__json';
        drupal_add_http_header('Content-Type', 'application/json');
        break;
      case 'rdf':
        $vars['theme_hook_suggestions'][] = 'page__rdfmads';
        drupal_add_http_header('Content-Type', 'text/xml');
        break;
    }

    $vars['dll_template'] = $this->getFormatted();
  }


  /**
   * Gets the formatter class based on the existant node type.
   */
  private function getFormatter() {
    if (!empty($this->formatter)) {
      return $this->formatter;
    }
    
    $type = $this->snakeToCamel($this->node->type);

    $class_name = "Dll{$type}Formatter";

    if (!class_exists($class_name)) {
      
      $formatter->{$format}($wrapper, $formatted);
    }

    $this->formatter = new $class_name();
    return $this->formatter;
  }

  /**
   * Returns the formatted version of the array for use in the templating functions.
   */
  public function getFormatted() {
    $type = $this->snakeToCamel($this->node->type);
    $format = $this->format;

    $formatted = $this->formatCommon();

    $wrapper = entity_metadata_wrapper('node', $this->node);

    $class_name = "Dll{$type}Formatter";
    $formatter = $this->getFormatter();
    $formatter->{$format}($wrapper, $formatted);

    return $formatted;
  }

  /**
   * There are definitely composer packages that do this but eh.
   */
  protected function snakeToCamel($word) {
    $words = explode('_', $word);
    $words = array_map(function($word) {
      return ucfirst($word);
    }, $words);

    return implode('', $words);
  }

  /**
   * Clears out any empty values so they won't be rendered.
   */
  protected function cleanArray(&$formatted) {
    $filtered = [];
    foreach ($formatted as $key => $value) {
      if (!is_array($value)) {
        $filtered[$key] = $value; continue;
      }

      $filtered[$key] = array_filter($value, function($item) {
        return !empty($item);
      });
    }

    return $filtered;
  }

  /**
   * Formats common elements.
   */
  protected function formatCommon() {
    $formatted = [];

    $create = new DateTime("@{$this->node->created}");
    $modify = new DateTime("@{$this->node->changed}");

    $formatted['title'] = $this->node->title;
    $formatted['created'] = $create->format(DateTime::ISO8601);
    $formatted['modified'] = $modify->format(DateTime::ISO8601);

    $finfo = feeds_item_info_load('node', $this->node->nid);

    if (!empty($finfo)) {
      $formatted['feeds_guid'] = $finfo->guid;
    }

    return $formatted;
  }

}