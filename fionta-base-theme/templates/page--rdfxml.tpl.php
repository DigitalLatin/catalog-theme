<?xml version="1.0"?>

<rdf:RDF
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:si="https://www.w3schools.com/rdf/">

<rdf:Description rdf:about="https://www.w3schools.com">
  <si:title>
    <?php echo $node->title; ?>
  </si:title>
  <si:author>
    <?php echo $node->author; ?>
  </si:author>
</rdf:Description>
</rdf:RDF>