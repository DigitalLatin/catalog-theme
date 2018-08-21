<?php

require_once dirname(__FILE__) . '/DllFormatCommon.php';

class DllRepositoryItemFormatter extends DllFormatCommon
{
  public function xml()
  {

  }

  public function json($w, &$formatted)
  {
    $res = [
      "@context" => [
        "dcterms" => "http://purl.org/dc/terms/",
        "foaf" => "http://xmlns.com/foaf/spec/",
        "frbr" => "http://purl.org/vocab/frbr/core#",
        "schema" => "http://schema.org/",
        "Title" => "dcterms:title",
        "Author" => "dcterms:creator",
        "Source" => "frbr:exemplarOf",
        "Editor" => "dcterms:contributor",
        "Publisher" => "dcterms:publisher",
        "Place" => "schema:City",
        "Date" => "dcterms:date",
        "OriginalURI" => "dcterms:URI",
        "Repository" => "schema:Library",
        "DLLid" => "dcterms:identifier",
        "Rights" => "dcterms:rights"
      ],
      "@id" => $w->field_dll_page_link->value(),
      "Title" => $w->field_record_title->value(),
      "Author" => [
        $w->field_dll_creator->value() ? $w->field_dll_creator->value()[0]->title : null,
      ],
      "Editor" => [
        $w->field_contributor->value(),
      ],
      "Publisher" => $w->field_publisher->value(),
      "Place" => $w->field_place_of_publication->value(),
      "Date" => $w->field_date->value(),
      "Source" => $w->field_work_reference->value() ? $w->field_work_reference->value()[0]->title : null,
      "OriginalURI" => $w->field_source_work->value() ? $w->field_source_work->value()['url'] : null,
      "Repository" => $w->field_repository_source->value(),
      "DLLid" => $w->field_dll_identifier->value(),
      "Rights" => $w->field_rights->value(),
    ];

    $formatted = $res;
  }
}
