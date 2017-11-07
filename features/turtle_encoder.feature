Feature: Content negotiation for turtle
  In order to be able to provide content in the rdf format turtle
  the API should be able to encode responses to turtle.

  Scenario: Simple content negotiation
    When I add "Accept" header equal to "text/turtle"
    And I send a "GET" request to "/document/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "text/turtle; charset=utf-8"
    And the response should be equal to
    """
    @prefix bibo: <http://purl.org/ontology/bibo/> .
    @prefix bf: <http://bibframe.org/vocab/> .
    @prefix xsd: <http://www.w3.org/2001/XMLSchema#> .
    @prefix ns0: <http://example.com/docs.jsonld#Document/> .
    @prefix dc: <http://purl.org/dc/terms/> .
    @prefix foaf: <http://xmlns.com/foaf/0.1/> .

    <http://example.com/document/000000051>
      a bibo:document ;
      bf:local "OCoLC/775794624"^^xsd:string, "ABN/000300043"^^xsd:string ;
      ns0:id "000000051"^^xsd:string ;
      dc:contributor <http://d-nb.info/gnd/1046905-9>, <http://data.swissbib.ch/agent/ABN> ;
      dc:issued "2016-04-26T08:41:49.227Z"^^xsd:dateTime ;
      dc:modified "2014-08-14T16:40:57+01:00"^^xsd:dateTime ;
      foaf:primaryTopic <http://data.swissbib.ch/resource/000000051/about> .
    """