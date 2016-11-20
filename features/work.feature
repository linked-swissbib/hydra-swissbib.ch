Feature: Responses for documents
  In order to be able to retrieve documents the API should
  be able to respond with single documents or collections of documents.

  Scenario: Single work
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/work/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "http:\/\/example.com\/contexts\/Work",
      "@id": "http:\/\/example.com\/work\/025316931",
      "@type": "http:\/\/bibframe.org\/vocab\/Work",
      "id": "025316931",
      "hasInstance": [
        "http:\/\/data.swissbib.ch\/resource\/025316931",
        "http:\/\/data.swissbib.ch\/resource\/061176214"
      ],
      "contributor": [
        "http:\/\/data.swissbib.ch\/person\/3006dad4-7737-390a-9621-47d3266d2c1f",
        "http:\/\/data.swissbib.ch\/person\/3006dad4-7737-390a-9621-47d3266d2c1f"
      ],
      "title": [
        "Die Lage von 100 Bergbauernfamilien im Bezirk Einsiedeln und den Gemeinden Alphthal und Unteryberg",
        "Die Lage von 100 Bergbauernfamilien im Bezirk Einsiedeln und den Gemeinden Alpthal und Unteryberg \/ Margrit Ruhstaller"
      ]
    }
    """

  Scenario: Collection of works
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/work"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "http:\/\/example.com\/contexts\/Work",
      "@id": "http:\/\/example.com\/work",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "http:\/\/example.com\/work\/025316931",
          "@type": "http:\/\/bibframe.org\/vocab\/Work",
          "id": "025316931",
          "hasInstance": [
            "http:\/\/data.swissbib.ch\/resource\/025316931",
            "http:\/\/data.swissbib.ch\/resource\/061176214"
          ],
          "contributor": [
            "http:\/\/data.swissbib.ch\/person\/3006dad4-7737-390a-9621-47d3266d2c1f",
            "http:\/\/data.swissbib.ch\/person\/3006dad4-7737-390a-9621-47d3266d2c1f"
          ],
          "title": [
            "Die Lage von 100 Bergbauernfamilien im Bezirk Einsiedeln und den Gemeinden Alphthal und Unteryberg",
            "Die Lage von 100 Bergbauernfamilien im Bezirk Einsiedeln und den Gemeinden Alpthal und Unteryberg \/ Margrit Ruhstaller"
          ]
        },
        {
          "@id": "http:\/\/example.com\/work\/025316958",
          "@type": "http:\/\/bibframe.org\/vocab\/Work",
          "id": "025316958",
          "hasInstance": [
            "http:\/\/data.swissbib.ch\/resource\/025316958",
            "http:\/\/data.swissbib.ch\/resource\/260254770"
          ],
          "contributor": [
            "http:\/\/data.swissbib.ch\/person\/1cdb0b9f-1905-3e2c-82b2-33b4dc6db701",
            "http:\/\/data.swissbib.ch\/person\/1cdb0b9f-1905-3e2c-82b2-33b4dc6db701"
          ],
          "title": [
            "Das Innerschweizer Heimatwerk 1932-1947 \/ Margrit S\u00fcess",
            "Das Innerschweizer Heimatwerk 1932-1947 \/ hrrg. vom Innerschweizer Heimatwerk"
          ]
        }
      ],
      "hydra:totalItems": 2744928,
      "hydra:view": {
        "@id": "\/work?page=1",
        "@type": "hydra:PartialCollectionView",
        "hydra:first": "\/work?page=1",
        "hydra:last": "\/work?page=137247",
        "hydra:next": "\/work?page=2"
      },
      "hydra:search": {
        "@type": "hydra:IriTemplate",
        "hydra:template": "\/work{?q,fields}",
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