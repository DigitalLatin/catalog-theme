<?php

function dll_get_xml_format($node) {
  $formatted = _dll_format_xml_common($node);

  // This uses the Entity API - It could throw exceptions
  $wrapper = entity_metadata_wrapper('node', $node);

  switch ($node->type) {
    case 'dll_work':
      _dll_format_xml_work($wrapper, $formatted);
      break;
    case 'author_authorities':
      _dll_format_xml_author($wrapper, $formatted);
      break;
    case 'repository_item':
      _dll_format_xml_repository($wrapper, $formatted);
      break;
    case 'manuscript':
      _dll_format_xml_manuscript($wrapper, $formatted);
      break;
    case 'web_page':
      _dll_format_xml_webpage($wrapper, $formatted);
      break;
  }

  return $formatted;
}

function _dll_format_xml_common($node) {
  $formatted = [];

  $create = new DateTime("@{$node->created}");
  $modify = new DateTime("@{$node->changed}");

  $formatted['title'] = $node->title;
  $formatted['created'] = $create->format(DateTime::ISO8601);
  $formatted['modified'] = $modify->format(DateTime::ISO8601);

  $finfo = feeds_item_info_load('node', $node->nid);

  if (!empty($finfo)) {
    $formatted['feeds_guid'] = $finfo->guid;
  }

  return $formatted;
}

function _dll_format_xml_work($w, &$formatted) {
  
}

function _dll_format_xml_repository($w, &$formatted) {

}

function _dll_format_xml_manuscript($w, &$formatted) {

}

function _dll_format_xml_webpage($w, &$formatted) {

}

function _dll_format_xml_author($w, &$formatted) {
  
  $formatted['coverage'] = [
    $w->field_modern_geographic_identity->value(),
    $w->field_ancient_geographic_identit->value(),
    $w->field_time_period_authorities[0]->value()->name,
  ];

  $formatted['geography'] = [
    $w->field_modern_geographic_identity->value(),
    $w->field_ancient_geographic_identit->value(),
  ];

  $formatted['identifier'] = [
    'Library of Congress Catalog Page' => $w->field_lofc_uri->value()['url'],
    'phi'       => $w->field_phi_number->value(),
    //'digiliblt' => $w->field_digiliblt_number->value(),
    'stoa'      => $w->field_stoa_number->value(),
    'Library of Congress Authorities Page' => $w->field_locsource->value()['url'],
    'lccn'      => $w->field_loc_id->value(),
    'VIAF URL'  => $w->field_viaf_source->value()['url'],
    'viaf'      => $w->field_viaf_id->value(),
    'dll_author' => $w->field_dll_author_number->value(),
    'dll'        => $w->field_dll_identifier->value(),
    'DLL Catalog Link' => strip_tags($w->field_dll_page_link->value()),
  ];
  $formatted['creator'] = [
    $w->field_authorized_name->value(),
  ];
  $formatted['date'] = [
    'start' => $w->field_author_birth_date->value(),
    'end'   => $w->field_author_death_date->value(),
  ];

  $formatted['approximate_dates'] = [
    $w->field_floruit_active->value(),
    $w->field_time_period_authorities->value(),
  ];

  $formatted['source'] = [$w->field_viaf_source->value()->url];

  $formatted['author_name_latin'] = $w->field_author_name_latin->value()[0];
  $formatted['author_name_english'] = $w->field_author_name_english->value()[0];
  $formatted['author_name_native_language'] = $w->field_author_name_native_languag->value();
  $formatted['author_aka'] = $w->field_also_known_as->value()[0];

  $formatted = _dll_clean_formatted_array($formatted);
}

/**
 * Cleans up any extra stuff coming out of the dll fields.
 */
function _dll_clean_formatted_array($formatted) {
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