<?php

namespace Tests\LinkedSwissbibBundle\Entity;

use LinkedSwissbibBundle\Entity\EntityBuilder;
use LinkedSwissbibBundle\Entity\SimpleEntityBuilder;
use PHPUnit_Framework_MockObject_MockObject;

class SimpleEntityBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EntityBuilder
     */
    private $entityBuilder;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $mockLogger;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->mockLogger = $this->getMockBuilder('Monolog\Logger')
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityBuilder = new SimpleEntityBuilder($this->mockLogger);
    }

    /**
     * @return void
     */
    public function testNotExistingEntity()
    {
        $this->mockLogger->expects($this->once())->method('error');

        $entity = $this->entityBuilder->build('Tests\\LinkedSwissbibBundle\\NonExistingEntityName', ['attrA' => 'attrAValue']);

        $this->assertNull($entity);
    }

    /**
     * @return void
     */
    public function testExistingEntity()
    {
        $this->mockLogger->expects($this->never())->method('warning');
        $this->mockLogger->expects($this->never())->method('error');

        /** @var StubEntity $entity */
        $entity = $this->entityBuilder->build(
            'Tests\\LinkedSwissbibBundle\\Entity\\StubEntity',
            [
                'attrA' => 'attrAValue',
                'attrB' => 'attrBValue',
            ]
        );

        $this->assertNotNull($entity);
        $this->assertEquals('attrAValue', $entity->getAttrA());
        $this->assertEquals('attrBValue', $entity->getAttrB());
    }

    /**
     * @return void
     */
    public function testWarningOnNonExistingAttribute()
    {
        $this->mockLogger->expects($this->once())->method('warning');

        $this->entityBuilder->build(
            'Tests\\LinkedSwissbibBundle\\Entity\\StubEntity',
            [
                'attrA' => 'attrAValue',
                'attrB' => 'attrBValue',
                'attrC' => 'attrCValue',
            ]
        );
    }
}
