<?php

class DllFormatCommon {
  protected $dll_base_url = 'https://hobbes.rccc.ou.edu/dll-biblio/';
  protected $mads_url = 'http://www.loc.gov/mads/rdf/v1#';

  protected function urlMap($arr) {
    return array_map(function ($i) {
      if (empty($i['url'])) {
        return $i;
      }
      return $i['url'];
    }, $arr);
  }

  /**
   * Takes the first element of the array if this is an array.
   */
  protected function flatten($arr) {
    return array_map(function($i) {
      if (is_array($i) && !empty($i[0])) {
        return $i[0];
      }

      return $i;
    }, $arr);
  }

}