Feature: Depending on the error, the API should be able to respond with different error codes

  Scenario: Ok GET
    And I send a "GET" request to "/document"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"

  Scenario: Ok HEAD
    And I send a "GET" request to "/document"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"

  Scenario: Not Found
    And I send a "GET" request to "/invalid_url"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"

  Scenario: Method not allowed
    And I send a "POST" request to "/document"
    Then the response status code should be 405
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"

  Scenario: Method not allowed
    And I send a "DELETE" request to "/document"
    Then the response status code should be 405
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"

  Scenario: Ok GET
    And I send a "GET" request to "/document/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"

  Scenario: Ok HEAD
    And I send a "GET" request to "/document/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"

  Scenario: Not Found
    And I send a "GET" request to "/invalid_url/1"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"

  Scenario: Method not allowed
    And I send a "POST" request to "/document/1"
    Then the response status code should be 405
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"

  Scenario: Method not allowed
    And I send a "DELETE" request to "/document/1"
    Then the response status code should be 405
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"