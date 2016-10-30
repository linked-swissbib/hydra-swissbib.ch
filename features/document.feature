Feature: Responses for documents
  In order to be able to retrieve documents the API should
  be able to respond with single documents or collections of documents.

  Scenario: Single document
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/document/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "http:\/\/example.com\/contexts\/Document",
        "@id": "http:\/\/example.com\/document\/000000051",
        "@type": "http:\/\/purl.org\/ontology\/bibo\/document",
        "id": "000000051",
        "local": [
            "OCoLC\/775794624",
            "ABN\/000300043"
        ],
        "contributor": [
            "http:\/\/d-nb.info\/gnd\/1046905-9",
            "http:\/\/data.swissbib.ch\/agent\/ABN"
        ],
        "issued": "2016-04-26T08:41:49.227Z",
        "modified": "2014-08-14T16:40:57+01:00",
        "primaryTopic": "http:\/\/data.swissbib.ch\/resource\/000000051\/about"
    }
    """

  Scenario: Collection of documents
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/document"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "http:\/\/example.com\/contexts\/Document",
        "@id": "http:\/\/example.com\/document",
        "@type": "hydra:Collection",
        "hydra:member": [
            {
                "@id": "http:\/\/example.com\/document\/000000051",
                "@type": "http:\/\/purl.org\/ontology\/bibo\/document",
                "id": "000000051",
                "local": [
                    "OCoLC\/775794624",
                    "ABN\/000300043"
                ],
                "contributor": [
                    "http:\/\/d-nb.info\/gnd\/1046905-9",
                    "http:\/\/data.swissbib.ch\/agent\/ABN"
                ],
                "issued": "2016-04-26T08:41:49.227Z",
                "modified": "2014-08-14T16:40:57+01:00",
                "primaryTopic": "http:\/\/data.swissbib.ch\/resource\/000000051\/about"
            },
            {
                "@id": "http:\/\/example.com\/document\/000000052",
                "@type": "http:\/\/purl.org\/ontology\/bibo\/document",
                "id": "000000052",
                "local": [
                    "OCoLC\/775794624",
                    "ABN\/000300043"
                ],
                "contributor": [
                    "http:\/\/d-nb.info\/gnd\/1046905-9",
                    "http:\/\/data.swissbib.ch\/agent\/ABN"
                ],
                "issued": "2016-04-26T08:41:49.227Z",
                "modified": "2014-08-14T16:40:57+01:00",
                "primaryTopic": "http:\/\/data.swissbib.ch\/resource\/000000051\/about"
            }
        ],
        "hydra:totalItems": 2
    }
    """