Feature: Content negotiation for rdf-xml
  In order to be able to provide content in the rdf format rdf-xml
  the API should be able to encode responses to rdf-xml.

  Scenario: Simple rdfXML content negotiation
    When I add "Accept" header equal to "application/rdf+xml"
    And I send a "GET" request to "/document/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/rdf+xml; charset=utf-8"
    And the response should be equal to
    """
<?xml version="1.0" encoding="utf-8" ?>
  <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
             xmlns:bibo="http://purl.org/ontology/bibo/"
             xmlns:bf="http://bibframe.org/vocab/"
             xmlns:ns0="http://example.com/doc.jsonld##Document/"
             xmlns:dc="http://purl.org/dc/terms/"
             xmlns:foaf="http://xmlns.com/foaf/0.1/">

      <bibo:document rdf:about="http://example.com/document/000000051">
        <bf:local rdf:datatype="http://www.w3.org/2001/XMLSchema#string">OCoLC/775794624</bf:local>
        <bf:local rdf:datatype="http://www.w3.org/2001/XMLSchema#string">ABN/000300043</bf:local>
        <ns0:id rdf:datatype="http://www.w3.org/2001/XMLSchema#string">000000051</ns0:id>
        <dc:contributor rdf:resource="http://d-nb.info/gnd/1046905-9"/>
        <dc:contributor rdf:resource="http://data.swissbib.ch/agent/ABN"/>
        <dc:issued rdf:datatype="http://www.w3.org/2001/XMLSchema#dateTime">2016-04-26T08:41:49.227Z</dc:issued>
        <dc:modified rdf:datatype="http://www.w3.org/2001/XMLSchema#dateTime">2014-08-14T16:40:57+01:00</dc:modified>
        <foaf:primaryTopic rdf:resource="http://data.swissbib.ch/resource/000000051/about"/>
      </bibo:document>

</rdf:RDF>
    """