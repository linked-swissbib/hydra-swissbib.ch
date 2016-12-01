Feature: entrypoint

  Scenario: JSON-LD response
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "@context": "http:\/\/example.com\/contexts/Entrypoint",
        "@id": "http:\/\/example.com\/",
        "@type": "Entrypoint",
        "bibliographicResource": "http:\/\/example.com\/bibliographicResource",
        "document": "http:\/\/example.com\/document",
        "item": "http:\/\/example.com\/item",
        "organisation": "http:\/\/example.com\/organisation",
        "person": "http:\/\/example.com\/person",
        "work": "http:\/\/example.com\/work"
    }
    """