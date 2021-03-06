Feature: Responses for documents
  In order to be able to retrieve documents the API should
  be able to respond with single documents or collections of documents.

  Scenario: Single person
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/person/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "http:\/\/example.com\/contexts\/Person",
      "@id": "http:\/\/example.com\/person\/88cacf50-bf67-34e5-aaac-d87982b8bd7a",
      "@type": "http:\/\/xmlns.com\/foaf\/0.1\/Person",
      "id": "88cacf50-bf67-34e5-aaac-d87982b8bd7a",
      "firstName": "Egon",
      "lastName": "Kornmann",
      "label": "Kornmann, Egon"
    }
    """

  Scenario: Collection of persons
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/person"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
      "@context": "http:\/\/example.com\/contexts\/Person",
      "@id": "http:\/\/example.com\/person",
      "@type": "hydra:Collection",
      "hydra:member": [
        {
          "@id": "http:\/\/example.com\/person\/88cacf50-bf67-34e5-aaac-d87982b8bd7a",
          "@type": "http:\/\/xmlns.com\/foaf\/0.1\/Person",
          "id": "88cacf50-bf67-34e5-aaac-d87982b8bd7a",
          "birthYear": "1934",
          "deathYear": "2000",
          "firstName": "Egon",
          "lastName": "Kornmann",
          "name": "TestName",
          "sameAs": "TestSameAs",
          "label": "Kornmann, Egon",
          "note": "Test Note",
          "birthPlace": "http:\/\/data.swissbib.ch\/testBirthPlace",
          "deathPlace": "http:\/\/data.swissbib.ch\/testDeathPlace",
          "birthDate": "2014-08-14T16:40:57+01:00",
          "deathDate": "2014-08-14T16:40:57+01:00",
          "genre": "Testgenre",
          "movement": "TestMovement",
          "nationality": "CH",
          "notableWork": "testNotableWork",
          "occupation": "TestOccupation",
          "thumbnail": "TestThubnail",
          "influencedBy": "TestInfluencedBy",
          "partner": "TestPartner",
          "pseudonym": "CH",
          "spouse": "TestSpouse",
          "influenced": "TestInfluenced",
          "alternateName": "TestAlternativeName",
          "familyName": "TestFamilyName",
          "givenName": "TestGivenName",
          "gender": "male",
          "abstract": "DE"
        },
        {
          "@id": "http:\/\/example.com\/person\/c3b60842-5100-3f20-b2de-27627309929c",
          "@type": "http:\/\/xmlns.com\/foaf\/0.1\/Person",
          "id": "c3b60842-5100-3f20-b2de-27627309929c",
          "firstName": "Wolfgang",
          "lastName": "Smejkal",
          "label": "Smejkal, Wolfgang"
        },
        {
          "@id": "http:\/\/example.com\/person\/c497b156-4a04-3922-a561-7c786bd21eb2",
          "@type": "http:\/\/xmlns.com\/foaf\/0.1\/Person",
          "id": "c497b156-4a04-3922-a561-7c786bd21eb2",
          "firstName": "Carsten",
          "lastName": "Colombier",
          "label": "Colombier, Carsten"
        },
        {
          "@id": "http:\/\/example.com\/person\/276481fd-ed5b-3efa-ae06-6716718dd354",
          "@type": "http:\/\/xmlns.com\/foaf\/0.1\/Person",
          "id": "276481fd-ed5b-3efa-ae06-6716718dd354",
          "firstName": "Roland",
          "lastName": "Fischer",
          "label": "Fischer, Roland"
        },
        {
          "@id": "http:\/\/example.com\/person\/e5582ee3-a173-38a7-8e2e-749b0a04f45d",
          "@type": "http:\/\/xmlns.com\/foaf\/0.1\/Person",
          "id": "e5582ee3-a173-38a7-8e2e-749b0a04f45d",
          "firstName": "Thomas",
          "lastName": "De Quincey",
          "label": "De Quincey, Thomas"
        }
      ],
      "hydra:totalItems": 5,
      "hydra:search": {
        "@type": "hydra:IriTemplate",
        "hydra:template": "http:\/\/example.com\/person{?q,fields}",
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
