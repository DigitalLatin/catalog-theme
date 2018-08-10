<?php

require_once dirname(__FILE__) . '/DllFormatCommon.php';

class DllWebPageFormatter extends DllFormatCommon
{

  public function xml()
  {

  }

  public function json($w, &$formatted)
  {
    $res = [
      '@context' => [
        '@base' => 'https://hobbes.rccc.ou.edu/dll-biblio',
        'dcterms' => 'http://purl.org/dc/terms/',
        'foaf' => 'http://xmlns.com/foaf/spec/',
        'frbr' => 'http://purl.org/vocab/frbr/core#',
        'schema' => 'http://schema.org/',
        'Title' => 'dcterms:title',
        'Author' => 'dcterms:creator',
        'SourceEdition' => 'dcterms:source',
        'EditionURI' => 'dcterms:URI',
        'Publisher' => 'dcterms:publisher',
        'AccessDate' => 'dcterms:date',
        'Repository' => 'schema:WebSite',
        'DLLAuthor' => 'dcterms:creator',
        'Source' => 'frbr:exemplarOf',
        'DLLid' => 'dcterms:identifier',
        'Rights' => 'dcterms:rights'
      ],
      '@id' => strip_tags($w->field_dll_page_link->value()),
      'Title' => $w->field_record_title->value(),
      'Author' => $w->field_creator->value(),
      'DLLAuthor' => $w->field_dll_creator->value()[0]->title,
      'SourceEdition' => $w->field_source_edition->value(),
      'EditionURI' => $w->field_source_work->value() ? $w->field_source_work->value()['url'] : '',
      'Publisher' => $w->field_publisher->value(),
      'AccessDate' => $w->field_access_date->value(),
      'Repository' => $w->field_repository_source->value(),
      'Source' => $w->field_work_reference->value()[0]->title,
      'DLLid' => $w->field_dll_identifier->value(),
      'Rights' => $w->field_rights->value(),
    ];

    $formatted = $res;
  }
}