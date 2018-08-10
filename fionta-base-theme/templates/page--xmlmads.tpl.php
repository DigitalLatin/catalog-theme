<?xml version="1.0"?>
<mads:mads xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:mods="http://www.loc.gov/mods/v3"
    xmlns:mads="http://www.loc.gov/mads/v2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.loc.gov/mads/ http://www.loc.gov/standards/mads/mads.xsd http://www.loc.gov/mods/v3 http://www.loc.gov/standards/mods/v3/mods-3-2.xsd"
    version="2.0">
    <!-- The value for the xlink attribute should be the node title. -->
    <mads:authority xlink:href="title">
        <mads:name type="personal" authority="naf">
            <mads:namePart><?= implode(', ', $dll_template['creator']); ?></mads:namePart>
        </mads:name>

        <?php foreach($dll_template['geography'] as $geo): ?>
        <mads:geographic><?= $geo; ?></mads:geographic>
        <?php endforeach; ?>

        <!-- The following three fields are tricky. Where there are known birth and death dates, they are listed. Otherwise, we use a floruit value, or a general century. -->
        <mads:temporal point="start"><?= $dll_template['date']['start']; ?></mads:temporal>
        <mads:temporal point="end"><?= $dll_template['date']['end']; ?></mads:temporal>

        <?php if(empty($dll_template['date']['start']) && empty($dll_template['date']['end'])): ?>
            <?php foreach($dll_template['approximate_dates'] as $appx): ?>
            <mads:temporal qualifier="approximate"><?= $appx; ?></mads:temporal>
            <?php endforeach; ?>
        <?php endif; ?>
        
    </mads:authority>
    
    <!-- The following variants may or may not have values, or they might have multiple values. -->
    <mads:variant type="other" lang="lat">
        <mads:name type="personal">
            <mads:namePart><?= $dll_template['author_name_latin']; ?></mads:namePart>
        </mads:name>
    </mads:variant>
    <mads:variant type="other" lang="eng">
        <mads:name type="personal">
            <mads:namePart><?= $dll_template['author_name_english']; ?></mads:namePart>
        </mads:name>
    </mads:variant>
    <mads:variant type="other">
        <mads:name type="personal">
            <mads:namePart><?= $dll_template['author_name_native_language']; ?></mads:namePart>
        </mads:name>
    </mads:variant>
    <mads:variant type="other">
        <mads:name type="personal">
            <mads:namePart><?= $dll_template['author_aka']; ?></mads:namePart>
        </mads:name>
    </mads:variant>
    
    <?php foreach($dll_template['identifier'] as $type => $value): ?>
      <mads:identifier type="<?= $type; ?>"><?= $value; ?></mads:identifier>
    <?php endforeach; ?>

    <!-- I need to figure out what to do here. In any case, the value is composed of other fields. The one listed here is for a specific author (Alcuin). -->
    <mads:identifier type="citeurn">urn:cite:perseus:author.58.1</mads:identifier>
    
    <mads:recordInfo>
        <mads:recordContentSource authority="">DLC<!-- Don't know what to put here. --></mads:recordContentSource>
        <mads:recordCreationDate encoding="iso8601"><?= $dll_template['created']; ?></mads:recordCreationDate>
        <mads:recordChangeDate encoding="iso8601"><?= $dll_template['modified']; ?></mads:recordChangeDate>
        <mads:recordIdentifier><?= $dll_template['feeds_guid']; ?></mads:recordIdentifier>
    </mads:recordInfo>
</mads:mads>
