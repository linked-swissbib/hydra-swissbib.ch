Feature: Content negotiation for n-triples
  In order to be able to provide content in the rdf format n-triples    
  the API should be able to encode responses to n-triples.


  Scenario: Simple n-triples content negotiation
    When I add "Accept" header equal to "text/html"
    And I send a "GET" request to "/document/1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "text/html; charset=utf-8"
    And the response should be equal to
    """
    <div class="rdfa-object"
                vocab="http://example.com/contexts/Document"
                    resource="http://example.com/document/000000051"
                    typeof="http://purl.org/ontology/bibo/document"
            >
                            <div class="rdfa-element">
                    <div class="rdfa-property rdfa-jsonld">@context:&nbsp;</div>
                    <div class="rdfa-value">
                                                <div class="rdfa-literal">
                <div class="rdfa-literal-value">
                <a href="http://example.com/contexts/Document" >http://example.com/contexts/Document</a>
            </div>
        </div>                                    </div>
                </div>
                        <div class="rdfa-element">
                    <div class="rdfa-property rdfa-jsonld">@id:&nbsp;</div>
                    <div class="rdfa-value">
                                                <div class="rdfa-literal">
                <div class="rdfa-literal-value">
                <a href="http://example.com/document/000000051" >http://example.com/document/000000051</a>
            </div>
        </div>                                    </div>
                </div>
                        <div class="rdfa-element">
                    <div class="rdfa-property rdfa-jsonld">@type:&nbsp;</div>
                    <div class="rdfa-value">
                                                <div class="rdfa-literal">
                <div class="rdfa-literal-value">
                <a href="http://purl.org/ontology/bibo/document" >http://purl.org/ontology/bibo/document</a>
            </div>
        </div>                                    </div>
                </div>
                        <div class="rdfa-element">
                    <div class="rdfa-property">id:&nbsp;</div>
                    <div class="rdfa-value">
                                                <div class="rdfa-literal">
                <div class="rdfa-literal-value rdfa-string">
                                <span>"</span><span property="id">000000051</span><span>"</span>
                        </div>
        </div>                                    </div>
                </div>
                        <div class="rdfa-element">
                    <div class="rdfa-property">local:&nbsp;</div>
                    <div class="rdfa-value">
                                                                            <div class="rdfa-array">
                <div class="rdfa-object"
                    >
                <div class="rdfa-literal">
                <div class="rdfa-literal-value rdfa-string">
                                <span>"</span><span property="local">OCoLC/775794624</span><span>"</span>
                        </div>
        </div>    </div>            <div class="rdfa-object"
                    >
                <div class="rdfa-literal">
                <div class="rdfa-literal-value rdfa-string">
                                <span>"</span><span property="local">ABN/000300043</span><span>"</span>
                        </div>
        </div>    </div>    </div>                                                            </div>
                </div>
                        <div class="rdfa-element">
                    <div class="rdfa-property">contributor:&nbsp;</div>
                    <div class="rdfa-value">
                                                                            <div class="rdfa-array">
                <div class="rdfa-object"
                    >
                <div class="rdfa-literal">
                <div class="rdfa-literal-value">
                <a href="http://d-nb.info/gnd/1046905-9" property="contributor">http://d-nb.info/gnd/1046905-9</a>
            </div>
        </div>    </div>            <div class="rdfa-object"
                    >
                <div class="rdfa-literal">
                <div class="rdfa-literal-value">
                <a href="http://data.swissbib.ch/agent/ABN" property="contributor">http://data.swissbib.ch/agent/ABN</a>
            </div>
        </div>    </div>    </div>                                                            </div>
                </div>
                        <div class="rdfa-element">
                    <div class="rdfa-property">issued:&nbsp;</div>
                    <div class="rdfa-value">
                                                <div class="rdfa-literal">
                <div class="rdfa-literal-value rdfa-string">
                                <span>"</span><span property="issued">2016-04-26T08:41:49.227Z</span><span>"</span>
                        </div>
        </div>                                    </div>
                </div>
                        <div class="rdfa-element">
                    <div class="rdfa-property">modified:&nbsp;</div>
                    <div class="rdfa-value">
                                                <div class="rdfa-literal">
                <div class="rdfa-literal-value rdfa-string">
                                <span>"</span><span property="modified">2014-08-14T16:40:57+01:00</span><span>"</span>
                        </div>
        </div>                                    </div>
                </div>
                        <div class="rdfa-element">
                    <div class="rdfa-property">primaryTopic:&nbsp;</div>
                    <div class="rdfa-value">
                                                <div class="rdfa-literal">
                <div class="rdfa-literal-value">
                <a href="http://data.swissbib.ch/resource/000000051/about" property="primaryTopic">http://data.swissbib.ch/resource/000000051/about</a>
            </div>
        </div>                                    </div>
                </div>
                </div>
    """
