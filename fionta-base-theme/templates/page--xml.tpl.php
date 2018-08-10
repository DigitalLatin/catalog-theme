<?xml version="1.0" ?>

<metadata
  xmlns="http://example.org/myapp/"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:schemaLocation="http://example.org/myapp/ http://example.org/myapp/schema.xsd"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:dcterms="http://purl.org/dc/terms/">


<?php if (!empty($dll_template['title'])): ?>
  <dcterms:title><?= $dll_template['title']; ?></dcterms:title>
<?php endif; ?>
<?php if (!empty($dll_template['dc_coverage'])): ?>
  <?php foreach($dll_template['dc_coverage'] as $coverage): ?>
  <dcterms:coverage><?= $coverage; ?></dcterms:coverage>
  <?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($dll_template['dc_identifier'])): ?>
  <?php foreach($dll_template['dc_identifier'] as $identifier): ?>
  <dcterms:identifier><?= $identifier; ?></dcterms:identifier>
  <?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($dll_template['dc_creator'])): ?>
  <?php foreach($dll_template['dc_creator'] as $creator): ?>
  <dcterms:creator><?= $creator; ?></dcterms:creator>
  <?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($dll_template['dc_date'])): ?>
  <?php foreach($dll_template['dc_date'] as $date): ?>
  <dcterms:date><?= $date; ?></dcterms:date>
  <?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($dll_template['dc_source'])): ?>
  <?php foreach($dll_template['dc_source'] as $source): ?>
  <dcterms:source><?= $source; ?></dcterms:source>
  <?php endforeach; ?>
<?php endif; ?>

</metadata>