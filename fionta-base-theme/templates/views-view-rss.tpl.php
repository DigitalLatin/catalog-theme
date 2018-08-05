<?php

/**
 * @file
 * Default template for feed displays that use the RSS style.
 *
 * @ingroup views_templates
 *
 * This template was customized to now include an atom link
 */

function url_prefix() {
  if ($_SERVER['SERVER_PORT'] == 443) return "https://";
  else return "http://";
}

?>
<?php print "<?xml"; ?> version="1.0" encoding="utf-8" <?php print "?>"; ?>
<rss version="2.0" xml:base="<?php print $link; ?>"<?php print $namespaces; ?> xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
	<atom:link href="<?php print url_prefix()."$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" rel="self" type="application/rss+xml" />
    <title><?php print $title; ?></title>
    <link><?php print $link; ?></link>
    <description><?php print $description; ?></description>
    <language><?php print $langcode; ?></language>
    <?php print $channel_elements; ?>
    <?php print $items; ?>
  </channel>
</rss>
