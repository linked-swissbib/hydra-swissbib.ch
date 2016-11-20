Feature: Responses for documents
  In order to be able to retrieve documents the API should
  be able to respond with single documents or collections of documents.

  Scenario: Single item
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/item/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context":"http:\/\/example.com\/contexts\/Item",
        "@id":"http:\/\/example.com\/item\/IDSLU-37610588-eb60-3689-ab25-23d7e11259a7",
        "@type":"http:\/\/bibframe.org\/vocab\/HeldItem",
        "id":"IDSLU-37610588-eb60-3689-ab25-23d7e11259a7",
        "holdingFor":"http:\/\/data.swissbib.ch\/resource\/023321059",
        "subLocation":"Aussenmagazin, bestellt bis 9.00\/14.30: bereit ab 11.30 (Mo-Sa)\/17.00 (Mo-Fr)",
        "locator":"E.b 15096","owner":"http:\/\/data.swissbib.ch\/organisation\/IDSLU-LUZHB",
        "page":"http:\/\/ilu.zhbluzern.ch\/F?func=item-global\u0026doc_library=ILU01\u0026doc_number=000492361\u0026sub_library=LUZHB"
    }
    """

  Scenario: Collection of items
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/item"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "http:\/\/example.com\/contexts\/Item",
      "@id": "http:\/\/example.com\/item",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "http:\/\/example.com\/item\/IDSLU-37610588-eb60-3689-ab25-23d7e11259a7",
          "@type": "http:\/\/bibframe.org\/vocab\/HeldItem",
          "id": "IDSLU-37610588-eb60-3689-ab25-23d7e11259a7",
          "holdingFor": "http:\/\/data.swissbib.ch\/resource\/023321059",
          "subLocation": "Aussenmagazin, bestellt bis 9.00\/14.30: bereit ab 11.30 (Mo-Sa)\/17.00 (Mo-Fr)",
          "locator": "E.b 15096",
          "owner": "http:\/\/data.swissbib.ch\/organisation\/IDSLU-LUZHB",
          "page": "http:\/\/ilu.zhbluzern.ch\/F?func=item-global\u0026doc_library=ILU01\u0026doc_number=000492361\u0026sub_library=LUZHB"
        },
        {
          "@id": "http:\/\/example.com\/item\/IDSLU-ec014b0b-efca-3cf5-8c25-e656a46915d1",
          "@type": "http:\/\/bibframe.org\/vocab\/HeldItem",
          "id": "IDSLU-ec014b0b-efca-3cf5-8c25-e656a46915d1",
          "holdingFor": "http:\/\/data.swissbib.ch\/resource\/023321199",
          "subLocation": "Aussenmagazin, bestellt bis 9.00\/14.30: bereit ab 11.30 (Mo-Sa)\/17.00 (Mo-Fr)",
          "locator": "G.b 15303",
          "owner": "http:\/\/data.swissbib.ch\/organisation\/IDSLU-LUZHB",
          "page": "http:\/\/ilu.zhbluzern.ch\/F?func=item-global\u0026doc_library=ILU01\u0026doc_number=000492388\u0026sub_library=LUZHB"
        },
        {
          "@id": "http:\/\/example.com\/item\/IDSLU-b6e1bd07-27fc-31f4-9549-12f4224b57c5",
          "@type": "http:\/\/bibframe.org\/vocab\/HeldItem",
          "id": "IDSLU-b6e1bd07-27fc-31f4-9549-12f4224b57c5",
          "holdingFor": "http:\/\/data.swissbib.ch\/resource\/023321245",
          "subLocation": "Aussenmagazin, bestellt bis 9.00\/14.30: bereit ab 11.30 (Mo-Sa)\/17.00 (Mo-Fr)",
          "locator": "E.b 15095",
          "owner": "http:\/\/data.swissbib.ch\/organisation\/IDSLU-LUZHB",
          "page": "http:\/\/ilu.zhbluzern.ch\/F?func=item-global\u0026doc_library=ILU01\u0026doc_number=000492414\u0026sub_library=LUZHB"
        }
      ],
      "hydra:totalItems": 3,
      "hydra:search": {
        "@type": "hydra:IriTemplate",
        "hydra:template": "\/item{?q,fields}",
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