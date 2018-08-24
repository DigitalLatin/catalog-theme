<?php

require_once dirname(__FILE__) . '/DllFormatCommon.php';

class DllAuthorAuthoritiesFormatter extends DllFormatCommon {

  /**
   * Format Author XML
   */
  public function xml($w, &$formatted) {
    $modern = $w->field_modern_geographic_identity->value();
    $ancient = $w->field_ancient_geographic_identit->value();

    $formatted['coverage'] = [
      empty($modern) ? '' : $modern[0]->name,
      empty($ancient) ? '' : $ancient[0]->name,
    ];

    $formatted['time_period'] = $w->field_time_period[0]->value()->name;

    $formatted['authorities'] = [$w->field_time_period[0]->value()->name];

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
      $w->field_time_period->value()->name,
    ];

    $formatted['source'] = [$w->field_viaf_source->value()->url];

    $formatted['author_name_latin'] = $w->field_author_name_latin->value()[0];
    $formatted['author_name_english'] = $w->field_author_name_english->value()[0];
    $formatted['author_name_native_language'] = $w->field_author_name_native_languag->value();
    $formatted['author_aka'] = $w->field_also_known_as->value()[0];

    $formatted = _dll_clean_formatted_array($formatted);
  }

  /**
   * Format the Author Node with json
   */
  public function json($w, &$formatted) {
    $external_authority = [
      "VIAF" => $w->field_viaf_source->value() ? $w->field_viaf_source->value()['url'] : null,
      "LCCN" => $w->field_locsource->value() ? $w->field_locsource->value()['url'] : null,
      "LOC" => $w->field_lofc_uri->value() ? $w->field_lofc_uri->value()['url'] : null,
      "BNE" => $w->field_bne_url->value() ?$w->field_bne_url->value()['url'] : null,
      "BNF" => $w->field_bnf_url->value() ? $w->field_bnf_url->value()['url'] : null,
      "DNB" => $w->field_dnb_url->value() ? $w->field_dnb_url->value()['url'] : null,
      "ICCU" => $w->field_iccu_url->value() ? $w->field_iccu_url->value()['url'] : null,
      "ISNI" => $w->field_isni_url->value() ? $w->field_isni_url->value()['url'] : null,
      "Wikidata" => $w->field_wikidata_url->value() ? $w->field_wikidata_url->value()['url'] : null,
      "Wikipedia" => $w->field_wikipedia->value() ? $w->field_wikipedia->value()['url'] : null,
      "Worldcat" => $w->field_worldcat_identity->value() ? $w->field_worldcat_identity->value()['url'] : null,
    ];

    $external_authority = array_filter($external_authority, function ($i) {
      return !empty($i);
    });
    $external_authority = $this->urlMap($external_authority);
    $aka = $w->field_also_known_as->value();

    $name_variants = [
      "LatinVariant" => $w->field_author_name_latin->value(),
      "EnglishVariant" => $w->field_author_name_english->value(),
      "NativeLanguageVariant" => $w->field_author_name_native_languag->value(),
      "AlsoKnownAs" => !empty($aka[0]) ? $aka[0]->title : null,
      "BNEName" => $w->field_bne_url->value() ? $w->field_bne_url->value()['title'] : null,
      "BNFName" => $w->field_bnf_url->value() ? $w->field_bnf_url->value()['title'] : null,
      "DNBName" => $w->field_dnb_url->value() ? $w->field_dnb_url->value()['title'] : null,
      "ICCUName" => $w->field_iccu_url->value() ? $w->field_iccu_url->value()['title'] : null,
      "ISNIName" => $w->field_isni_url->value() ? $w->field_isni_url->value()['title'] : null,
    ];

    $name_variants = $this->flatten($name_variants);

    $res = [
      '@context' => [
        '@base' => $this->dll_base_url,
        'madsrdf' => $this->mads_url,
        'Name' =>  'madsrdf:PersonalName',
        'AuthorizedName' =>  'madsrdf:authoritativeLabel',
        'Variant' =>  'madsrdf:hasVariant',
        'LatinVariant' =>  'madsrdf:variantLabel',
        'EnglishVariant' =>  'madsrdf:variantLabel',
        'NativeLanguageVariant' =>  'madsrdf:variantLabel',
        'AlsoKnownAs' =>  'madsrdf:variantLabel',
        'BNEName' =>  'madsrdf:variantLabel',
        'BNFName' =>  'madsrdf:variantLabel',
        'DNBName' =>  'madsrdf:variantLabel',
        'ICCUName' =>  'madsrdf:variantLabel',
        'ISNIName' =>  'madsrdf:variantLabel',
        'ExactExternalAuthority' =>  'madsrdf:hasExactExternalAuthority',
        'BirthDate' =>  'madsrdf:birthDate',
        'DeathDate' =>  'madsrdf:deathDate',
        'Floruit' =>  'madsrdf:temporal',
        'TimePeriod' =>  'madsrdf:temporal',
        'Identifier' =>  [
            '@id' =>  'madsrdf:Identifier',
            '@type' =>  '@id'
        ],
        'DLLid' =>  'madsrdf:idValue',
        'VIAFid' =>  'madsrdf:idValue',
        'LOCid' =>  'madsrdf:idValue',
        'STOAid' =>  'madsrdf:idValue',
        'PHIid' =>  'madsrdf:idValue',
        'CTS' =>  'madsrdf:idValue'
      ],
      "@id" => strip_tags($w->field_dll_page_link->value()),
      "Name" => [
        "AuthorizedName" => $w->field_authorized_name->value(),
        "Variant" => $name_variants,
      ],
      "BirthDate" => $w->field_author_birth_date->value(),
      "DeathDate" => $w->field_author_death_date->value(),
      "Floruit" => $w->field_floruit_active->value(),
      "TimePeriod" => $w->field_time_period->value()->name,
      "ExactExternalAuthority" => $external_authority,
      "Identifier" => [
        "DLLid" => $w->field_dll_identifier->value(),
        "VIAFid" => $w->field_viaf_id->value(),
        "LOCid" => $w->field_loc_id->value(),
        "STOAid" => $w->field_stoa_number->value(),
        "PHIid" => $w->field_phi_number->value(),
        "CTS" => $w->field_cts_urn->value(),
      ]
    ];

    // Totally overwrite
    $formatted = $res;
  }
}
