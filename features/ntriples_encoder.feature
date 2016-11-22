Feature: Content negotiation for n-triples
  In order to be able to provide content in the rdf format n-triples
  the API should be able to encode responses to n-triples.


  Scenario: Simple n-triples content negotiation
    When I add "Accept" header equal to "application/n-triples"
    And I send a "GET" request to "/document/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/n-triples; charset=utf-8"
    And the response should be equal to
    """
    <http://example.com/document/000000051> <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://purl.org/ontology/bibo/document> .
    <http://example.com/document/000000051> <http://bibframe.org/vocab/local> "OCoLC/775794624"^^<http://www.w3.org/2001/XMLSchema#string> .
    <http://example.com/document/000000051> <http://bibframe.org/vocab/local> "ABN/000300043"^^<http://www.w3.org/2001/XMLSchema#string> .
    <http://example.com/document/000000051> <http://example.com/docs.jsonld##Document/id> "000000051"^^<http://www.w3.org/2001/XMLSchema#string> .
    <http://example.com/document/000000051> <http://purl.org/dc/terms/contributor> <http://d-nb.info/gnd/1046905-9> .
    <http://example.com/document/000000051> <http://purl.org/dc/terms/contributor> <http://data.swissbib.ch/agent/ABN> .
    <http://example.com/document/000000051> <http://purl.org/dc/terms/issued> "2016-04-26T08:41:49.227Z"^^<http://www.w3.org/2001/XMLSchema#dateTime> .
    <http://example.com/document/000000051> <http://purl.org/dc/terms/modified> "2014-08-14T16:40:57+01:00"^^<http://www.w3.org/2001/XMLSchema#dateTime> .
    <http://example.com/document/000000051> <http://xmlns.com/foaf/0.1/primaryTopic> <http://data.swissbib.ch/resource/000000051/about> .
    """