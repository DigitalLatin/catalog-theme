<?xml version="1.0" encoding="UTF-8"?>
<rdf:RDF xmlns:skos="http://www.w3.org/2004/02/skos/core#"
    xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:madsrdf="http://www.loc.gov/mads/rdf/v1#" 
    xmlns:owl="http://www.w3.org/2002/07/owl#">
    <!-- Value of rdf:about should be field_dll_page_link -->
    <madsrdf:PersonalName rdf:about="field_dll_page_link">       
        <rdf:type rdf:resource="http://www.loc.gov/mads/rdf/v1#Authority"/>
        
        <madsrdf:authoritativeLabel xml:lang="en"><!-- Value should be field_authorized_name --></madsrdf:authoritativeLabel>
        
        <madsrdf:elementList rdf:parseType="Collection">
            <madsrdf:FullNameElement>
                <madsrdf:elementValue xml:lang="en">
                <!-- Value should be field_authorized_name  for now, but it should eventually be just the name parts of the authorized name. -->
                <?= implode(', ', $dll_template['creator']); ?>
                </madsrdf:elementValue>
            </madsrdf:FullNameElement>
        </madsrdf:elementList>
        <madsrdf:RWO rdf:ID="birth_date">
            <!-- Value of attribute should be field_author_birth_date. -->
            <madsrdf:birthDate rdf:value="<?= $dll_template['date']['start']; ?>"/>
        </madsrdf:RWO>
        <madsrdf:RWO rdf:ID="death_date">
            <madsrdf:deathDate rdf:value="<?= $dll_template['date']['end']; ?>"/>
        </madsrdf:RWO>
        
        <?php if(empty($dll_template['date']['start']) && empty($dll_template['date']['end'])): ?>
        <madsrdf:RWO rdf:ID="floruit_start">
            <madsrdf:activityStartDate rdf:property="foo"/>
        </madsrdf:RWO>
        <madsrdf:RWO rdf:ID="floruit_end">
            <madsrdf:activityEndDate rdf:property="bar"/>
        </madsrdf:RWO> 
        <?php endif; ?>
        
        <?php foreach($dll_template['approximate_dates'] as $key => $appx): ?>
        <madsrdf:MADSType>
            <madsrdf:SimpleType>
                <madsrdf:Temporal id="<?= $key; ?>" rdf:value="<?= $appx; ?>"/>
            </madsrdf:SimpleType>
        </madsrdf:MADSType>
        <?php endforeach; ?>
        
        <?php foreach($dll_template['coverage'] as $coverage): ?>
        <madsrdf:MADSType>
            <madsrdf:SimpleType>
                <madsrdf:Geographic rdf:value="<?= $coverage; ?>"/>
            </madsrdf:SimpleType>
        </madsrdf:MADSType>
        <?php endforeach; ?>

        <madsrdf:MADSType>
            <madsrdf:SimpleType>
                <!-- Value: field_time_period_authorities -->
                <madsrdf:Temporal rdf:value="<?= $dll_template['authorities'][0]; ?>"/>
            </madsrdf:SimpleType>
        </madsrdf:MADSType>

        
        <!-- Latin variant of author's name (field_author_name_latin) -->
        <madsrdf:hasVariant>
            <madsrdf:PersonalName>
                <rdf:type rdf:resource="http://www.loc.gov/mads/rdf/v1#Variant"/>
                <madsrdf:variantLabel xml:lang="en">Latin Name</madsrdf:variantLabel>
                <madsrdf:elementList rdf:parseType="Collection">
                    <madsrdf:FullNameElement>
                        <madsrdf:elementValue xml:lang="lat"><?= $dll_template['author_name_latin']; ?></madsrdf:elementValue>
                    </madsrdf:FullNameElement>
                </madsrdf:elementList>
            </madsrdf:PersonalName>
        </madsrdf:hasVariant>
        
        <!-- English variant of author's name (field_author_name_english) -->
        <madsrdf:hasVariant>
            <madsrdf:PersonalName>
                <rdf:type rdf:resource="http://www.loc.gov/mads/rdf/v1#Variant"/>
                <madsrdf:variantLabel xml:lang="en">English Name</madsrdf:variantLabel>
                <madsrdf:elementList rdf:parseType="Collection">
                    <madsrdf:FullNameElement>
                        <madsrdf:elementValue xml:lang="en"><?= $dll_template['author_name_english']; ?></madsrdf:elementValue>
                    </madsrdf:FullNameElement>
                </madsrdf:elementList>
            </madsrdf:PersonalName>
        </madsrdf:hasVariant>
        
        <!-- Native language variant of author's name (field_author_name_native_languag) -->
        <madsrdf:hasVariant>
            <madsrdf:PersonalName>
                <rdf:type rdf:resource="http://www.loc.gov/mads/rdf/v1#Variant"/>
                <madsrdf:variantLabel xml:lang="en">Native Language Name</madsrdf:variantLabel>
                <madsrdf:elementList rdf:parseType="Collection">
                    <madsrdf:FullNameElement>
                        <madsrdf:elementValue><?= $dll_template['author_name_native_language']; ?></madsrdf:elementValue>
                    </madsrdf:FullNameElement>
                </madsrdf:elementList>
            </madsrdf:PersonalName>
        </madsrdf:hasVariant>
        
        <!-- Also known as (field_also_known_as) -->
        <madsrdf:hasVariant>
            <madsrdf:PersonalName>
                <rdf:type rdf:resource="http://www.loc.gov/mads/rdf/v1#Variant"/>
                <madsrdf:variantLabel xml:lang="en">Native Language Name</madsrdf:variantLabel>
                <madsrdf:elementList rdf:parseType="Collection">
                    <madsrdf:FullNameElement>
                        <madsrdf:elementValue><?= $dll_template['author_aka']; ?></madsrdf:elementValue>
                    </madsrdf:FullNameElement>
                </madsrdf:elementList>
            </madsrdf:PersonalName>
        </madsrdf:hasVariant>
 
 <!-- URLs/URIs -->
        <!-- VIAF (field_viaf_source) -->
        <madsrdf:hasExactExternalAuthority rdf:resource="<?= $dll_template['identifier']['VIAF URL']; ?>" />
        <!-- https://lccn.loc.gov (field_locsource) -->
        <madsrdf:hasExactExternalAuthority rdf:resource="<?= $dll_template['identifier']['Library of Congress Authorities Page']; ?>" />
        <!-- http://id.loc.gov/authorities/names/ (field_lofc_uri) -->
        <madsrdf:hasExactExternalAuthority rdf:resource="<?= $dll_template['identifier']['Library of Congress Catalog Page']; ?>" />
        
<!-- ID's -->
        <!-- DLL -->
        <madsrdf:hasIdentifier>
            <madsrdf:Identifier>
                <madsrdf:idScheme>DLL</madsrdf:idScheme>
                <!-- Value: field_dll_identifier -->
                <madsrdf:idValue><?= $dll_template['identifier']['dll']; ?></madsrdf:idValue>
            </madsrdf:Identifier>
        </madsrdf:hasIdentifier>
        
        <!-- VIAF -->
        <madsrdf:hasIdentifier>
            <madsrdf:Identifier>
                <madsrdf:idScheme>VIAF</madsrdf:idScheme>
                <!-- Value:  field_viaf_id-->
                <madsrdf:idValue><?= $dll_template['identifier']['viaf']; ?></madsrdf:idValue>
            </madsrdf:Identifier>
        </madsrdf:hasIdentifier>
        
        <!-- LOC -->
        <madsrdf:hasIdentifier>
            <madsrdf:Identifier>
                <madsrdf:idScheme>LCCN</madsrdf:idScheme>
                <!-- Value: field_loc_id -->
                <madsrdf:idValue><?= $dll_template['identifier']['lccn']; ?></madsrdf:idValue>
            </madsrdf:Identifier>
        </madsrdf:hasIdentifier>
        
        <!-- STOA -->
        <madsrdf:hasIdentifier>
            <madsrdf:Identifier>
                <madsrdf:idScheme>STOA</madsrdf:idScheme>
                <!-- Value: field_stoa_number -->
                <madsrdf:idValue><?= $dll_template['identifier']['stoa']; ?></madsrdf:idValue>
            </madsrdf:Identifier>
        </madsrdf:hasIdentifier>
        
        <!-- PHI -->
        <madsrdf:hasIdentifier>
            <madsrdf:Identifier>
                <madsrdf:idScheme>PHI</madsrdf:idScheme>
                <!-- Value: field_phi_number -->
                <madsrdf:idValue><?= $dll_template['identifier']['phi']; ?></madsrdf:idValue>
            </madsrdf:Identifier>
        </madsrdf:hasIdentifier>
        
        <madsrdf:isMemberOfMADSScheme rdf:resource="http://id.loc.gov/authorities/names"/>
        
    </madsrdf:PersonalName>
</rdf:RDF>
