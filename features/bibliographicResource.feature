Feature: Responses for documents
  In order to be able to retrieve documents the API should
  be able to respond with single documents or collections of documents.

  Scenario: Single bibliographicResource
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/bibliographicResource/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "http:\/\/example.com\/contexts\/BibliographicResource",
      "@id": "http:\/\/example.com\/bibliographicResource\/023324791",
      "@type": "http:\/\/purl.org\/dc\/terms\/BibliographicResource",
      "id": "023324791",
      "title": "19 deadly sins of software security : programming flaws and how to fix them",
      "type": "http:\/\/purl.org\/ontology\/bibo\/Book",
      "language": "http:\/\/lexvo.org\/id\/iso639-3\/eng",
      "instanceOf": "dummy instanceOf",
      "format": "281 S : Ill ; 24 cm",
      "edition": "dummy edition",
      "isbn10": "0072260858",
      "isbn13": "9780072260854",
      "issn": "dummy issn",
      "originalLanguage": "dummy originalLanguage",
      "alternative": "dummy alternative",
      "bibliographicCitation": "dummy bibliographicCitation",
      "contributor": [
        "http:\/\/data.swissbib.ch\/person\/4a0ee4ca-254e-33e2-a957-245282075543",
        "http:\/\/data.swissbib.ch\/person\/7146e2b5-2b5c-3077-954b-d18b81c27238",
        "http:\/\/data.swissbib.ch\/person\/db5d4867-35b4-3991-b58b-5e037426e531"
      ],
      "hasPart": "dummy hasPart",
      "isPartOf": "dummy isPartOf",
      "issued": "2005",
      "subject": "http:\/\/d-nb.info\/gnd\/4274324-2",
      "p60049": "http:\/\/rdvocab.info\/termList\/RDAContentType\/1020",
      "p60050": "http:\/\/rdvocab.info\/termList\/RDAMediaType\/1007",
      "p60051": "dummy P60051",
      "p60163": "http:\/\/sws.geonames.org\/6252001\/",
      "p60333": "New York : McGraw-Hill, 2005",
      "p60339": "Michael Howard, David LeBlanc, John Viega",
      "p60470": "Formerly CIP. Uk",
      "p60489": "dummy P60489",
      "isDefinedBy": "http:\/\/data.swissbib.ch\/resource\/023324791\/about"
    }
    """

  Scenario: Collection of bibliographicResources
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/bibliographicResource"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "http:\/\/example.com\/contexts\/BibliographicResource",
      "@id": "http:\/\/example.com\/bibliographicResource",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "http:\/\/example.com\/bibliographicResource\/000000051",
          "@type": "http:\/\/purl.org\/dc\/terms\/BibliographicResource",
          "id": "000000051",
          "contributor": [
            "http:\/\/d-nb.info\/gnd\/1046905-9",
            "http:\/\/data.swissbib.ch\/agent\/ABN"
          ],
          "issued": "2016-04-26T08:41:49.227Z"
        },
        {
          "@id": "http:\/\/example.com\/bibliographicResource\/000000052",
          "@type": "http:\/\/purl.org\/dc\/terms\/BibliographicResource",
          "id": "000000052",
          "contributor": [
            "http:\/\/d-nb.info\/gnd\/1046905-9",
            "http:\/\/data.swissbib.ch\/agent\/ABN"
          ],
          "issued": "2016-04-26T08:41:49.227Z"
        }
      ],
      "hydra:totalItems": 12,
      "hydra:search": {
        "@type": "hydra:IriTemplate",
        "hydra:template": "\/bibliographicResource{?q,fields}",
        "hydra:variableRepresentation": "BasicRepresentation",
        "hydra:mapping": [
          {
            "@type": "IriTemplateMapping",
            "variable": "q",
            "property": "_all",
            "required": false
          },
          {
            "@type": "IriTemplateMapping",
            "variable": "fields",
            "property": "_fields",
            "required": false
          }
        ]
      }
    }
    """