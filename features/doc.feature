Feature: documentation
  In order for developers to be able to get information about the API, the doc route should be available

  Scenario: Swagger UI
    When I add "Accept" header equal to "text/html"
    And I send a "GET" request to "/docs"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"

  Scenario: Swagger doc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/docs.json"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"

  Scenario: Hydra doc
    When I add "Accept" header equal to "application/ld+json"
    And I send a "GET" request to "/docs"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/ld+json; charset=utf-8"
