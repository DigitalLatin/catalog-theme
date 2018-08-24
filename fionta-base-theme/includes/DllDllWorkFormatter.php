<?php

require_once dirname(__FILE__) . '/DllFormatCommon.php';

class DllDllWorkFormatter extends DllFormatCommon
{
  public function xml()
  {

  }

  public function json($w, &$formatted)
  {
    $res = [
      "@context" => [
        "@base" => "https://hobbes.rccc.ou.edu/dll-biblio",
        "madsrdf" => "http://www.loc.gov/mads/rdf/v1#",
        "rdf" => "http://www.w3.org/1999/02/22-rdf-syntax-ns#",
        "dcterms" => "http://www.w3.org/1999/02/22-rdf-syntax-ns#",
        "Title" => "madsrdf:Title",
        "Variant" => "madsrdf:hasVariant",
        "VariantTitle" => "madsrdf:variantLabel",
        "WorkAuthority" => "madsrdf:isMemberOfMADSCollection",
        "Abbreviation" => "madsrdf:hasAbbreviationVariant",
        "HasPart" => [
          "@id" => "dcterms:hasPart",
          "@type" => "@id"
        ],
        "PartOf" => [
          "@id" => "dcterms:isPartOf",
          "@type" => "@id"
        ],
        "References" => "dcterms:references",
        "Author" => "madsrdf:Authority",
        "AuthorName" => [
          "@id" => "madsrdf:PersonalName",
          "@type" => "@id"
        ],
        "AuthorizedName" => "madsrdf:authoritativeLabel",
        "DubiousAttribution" => "madsrdf:editorialNote",
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
      "WorkAuthority" => $w->field_work_authority->value()->name(),
      "Author" => ["AuthorName" => ["AuthorizedName" => $w->field_author->value()[0]->title]],
      "Abbreviation" => $w->field_work_abbreviated->value(),
      "HasPart" => ["HasPart" => [$w->field_has_part->value()]],
      "PartOf" => ["PartOf" => [$w->field_part_of->value()]],
      "References" => ["References" => [$w->field_references->value()]],
      "AttributedName" => ["AttributedName" => [
        "Dubious" => $w->field_dubious_spurious_attributi->value(),
        "Attribution" => "If there is a value here, this work has been attributed by some to this author.",
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
