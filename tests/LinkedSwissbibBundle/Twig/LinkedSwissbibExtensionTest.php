<?php
namespace Tests\LinkedSwissbibBundle\Twig;

use \LinkedSwissbibBundle\Twig\LinkedSwissbibExtension;
use PHPUnit\Framework\TestCase;

/**
 * LinkedSwissbibExtensionTest
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class LinkedSwissbibExtensionTest extends TestCase
{
    /**
     * @var LinkedSwissbibExtension
     */
    protected $extension;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->extension = new LinkedSwissbibExtension();
    }

    /**
     * @return void
     */
    public function testString()
    {
        $this->assertEquals('string', $this->extension->typeFunction('string test'));
    }

    /**
     * @return void
     */
    public function testNumber()
    {
        $this->assertEquals('number', $this->extension->typeFunction(1));
        $this->assertEquals('number', $this->extension->typeFunction(1.1));
        $this->assertEquals('number', $this->extension->typeFunction(0));
    }

    /**
     * @return void
     */
    public function testBool()
    {
        $this->assertEquals('bool', $this->extension->typeFunction(true));
        $this->assertEquals('bool', $this->extension->typeFunction(false));
    }

    /**
     * @return void
     */
    public function testObject()
    {
        $this->assertEquals('object', $this->extension->typeFunction(new \stdClass()));
    }

    /**
     * @return void
     */
    public function testArray()
    {
        $this->assertEquals('array', $this->extension->typeFunction([]));
        $this->assertEquals('array', $this->extension->typeFunction([1, 2, 3]));
    }

    /**
     * @return void
     */
    public function testUndefined()
    {
        $this->assertEquals('undefined', $this->extension->typeFunction(null));
    }
}
