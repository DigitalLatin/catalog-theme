<?php

require_once dirname(__FILE__) . '/DllFormatCommon.php';

class DllDllWorkFormatter extends DllFormatCommon
{
  public function xml()
  {

  }

  public function json($w, &$formatted)
  {
    // Prepare Author field.
    $author = $w->field_author->value();
    $author_result = [];
    foreach($author as $auth) {
      $author_result[] = $auth->title;
    }// $author_result now is a list of all the authors.
    
    // Prepare the HasPart field.
    $haspart = $w->field_has_part->value();
    $hp_result = [];
    foreach ($haspart as $part) {
        $hp_result[] = $part->title;
        }// $hp_result now is a list of all the titles.
        
     //Prepare the PartOf field.
     $partof = $w->field_part_of->value();
     $po_result = [];
    foreach ($partof as $part) {
        $po_result[] = $part->title;
        }// $po_result now is a list of all the titles.
        
     $references = $w->field_references->value();
     $ref_result = [];
     foreach ($references as $ref) {
         $ref_result[] = $ref->title;
         }// $ref_result now is a list of all the references.
        
    $res = [
      "@context" => [
        "@base" => "https://hobbes.rccc.ou.edu/dll-biblio",
        "madsrdf" => "http://www.loc.gov/mads/rdf/v1#",
        "Title" => "madsrdf:Title",
        "Variant" => "madsrdf:hasVariant",
        "VariantTitle" => "madsrdf:variantLabel",
        "WorkAuthority" => "madsrdf:isMemberOfMADSCollection",
        "Abbreviation" => "madsrdf:hasAbbreviationVariant",
        "HasPart" => "dcterms:hasPart",
        "PartOf" => "dcterms:isPartOf",
        "References" => "dcterms:references",
        "Author" => "madsrdf:Authority",
        "AuthorName" => [
          "@id" => "madsrdf:PersonalName",
          "@type" => "@id"
        ],
        "AuthorizedName" => "madsrdf:authoritativeLabel",
        "Attribution" => "madsrdf:editorialNote",
        "AttributedName" => [
          "@id" => "madsrdf:PersonalName",
          "@type" => "@id"
        ],
        "AttributedAuthorName" => "madsrdf:Name",
        "Dubious" => "madsrdf:hasChararacteristic",
        "Identifier" => [
          "@id" => "madsrdf:Identifier",
          "@type" => "@id"
        ],
        "DLLid" => "madsrdf:idValue",
        "STOAid" => "madsrdf:idValue",
        "PHIid" => "madsrdf:idValue",
        "CTS-ID" => "madsrdf:idValue",
        "CTS-URN" => "madsrdf:idValue"
      ],
      "@id" => strip_tags($w->field_dll_page_link->value()),
      "Title" => $w->field_work_name->value(),
      "Variant" => ["VariantTitle" => [$w->field_alternative_title->value()]],
      "WorkAuthority" => [$w->field_work_authority->value()[0]->name],
      "Abbreviation" => $w->field_work_abbreviated->value(),
      "HasPart" => $hp_result,
      "PartOf" => $po_result,
      "References" => $ref_result,
      "Author" => $author_result,
      "AttributedName" => ["AttributedName" => [
        "Dubious" => $w->field_dubious_spurious_attributi->value(),
        "Attribution" => "This work has been attributed by some to this author.",
        "AttributedAuthorName" => $w->field_attributed_to->value() ? $w->field_attributed_to->value()->title : null,
      ]],
      "Identifier" => [
        "DLLid" => $w->field_dll_identifier->value(),
        "STOAid" => $w->field_stoa_number->value(),
        "PHIid" => $w->field_phi_number->value(),
        "CTS-ID" => $w->field_identifier->value(),
        "CTS-URN" => $w->field_cts_urn->value(),
      ]
    ];

    $formatted = $res;
  }
}
