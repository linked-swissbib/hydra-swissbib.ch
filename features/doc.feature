Feature: documentation
  In order for developers to be able to get information about the API, the doc route should be available

  Scenario: Single work
    When I add "Accept" header equal to "text/html"
    And I send a "GET" request to "/doc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"
