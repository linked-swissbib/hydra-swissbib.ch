Feature: Responses for documents
  In order to be able to retrieve documents the API should
  be able to respond with single documents or collections of documents.

  Scenario: Single organisation
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/organisation/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
        "@context":"http:\/\/example.com\/contexts\/Organisation",
        "@id":"http:\/\/example.com\/organisation\/38bc8e24-b064-3fa0-b336-d2b680da66ab",
        "@type":"http:\/\/xmlns.com\/foaf\/0.1\/Organization",
        "id":"38bc8e24-b064-3fa0-b336-d2b680da66ab",
        "label":"Produce Marketing Association"
      }
    """

  Scenario: Collection of organisations
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/organisation"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "http:\/\/example.com\/contexts\/Organisation",
      "@id": "http:\/\/example.com\/organisation",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "http:\/\/example.com\/organisation\/IDSLU-37610588-eb60-3689-ab25-23d7e11259a7",
          "@type": "http:\/\/xmlns.com\/foaf\/0.1\/Organization",
          "id": "IDSLU-37610588-eb60-3689-ab25-23d7e11259a7"
        },
        {
          "@id": "http:\/\/example.com\/organisation\/IDSLU-ec014b0b-efca-3cf5-8c25-e656a46915d1",
          "@type": "http:\/\/xmlns.com\/foaf\/0.1\/Organization",
          "id": "IDSLU-ec014b0b-efca-3cf5-8c25-e656a46915d1"
        },
        {
          "@id": "http:\/\/example.com\/organisation\/IDSLU-b6e1bd07-27fc-31f4-9549-12f4224b57c5",
          "@type": "http:\/\/xmlns.com\/foaf\/0.1\/Organization",
          "id": "IDSLU-b6e1bd07-27fc-31f4-9549-12f4224b57c5"
        }
      ],
      "hydra:totalItems": 3,
      "hydra:search": {
        "@type": "hydra:IriTemplate",
        "hydra:template": "http:\/\/example.com\/organisation{?q,fields}",
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