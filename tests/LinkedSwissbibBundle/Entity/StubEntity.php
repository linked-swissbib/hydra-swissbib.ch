<?php

namespace Tests\LinkedSwissbibBundle\Entity;

/**
 * StubEntity
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class StubEntity
{
    /**
     * @var string
     */
    protected $attrA;

    /**
     * @var string
     */
    protected $attrB;

    /**
     * @param string $attrA
     *
     * @return string
     */
    public function setAttrA($attrA)
    {
        $this->attrA = $attrA;
    }

    /**
     * @return string
     */
    public function getAttrA()
    {
        return $this->attrA;
    }

    /**
     * @param string $attrB
     *
     * @return string
     */
    public function setAttrB($attrB)
    {
        $this->attrB = $attrB;
    }

    /**
     * @return string
     */
    public function getAttrB()
    {
        return $this->attrB;
    }
}
