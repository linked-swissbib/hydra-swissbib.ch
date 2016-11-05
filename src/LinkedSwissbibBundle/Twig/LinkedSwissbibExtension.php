<?php
namespace LinkedSwissbibBundle\Twig;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * LinkedSwissbibExtension
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class LinkedSwissbibExtension extends Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('type', [$this, 'typeFunction']),
            new Twig_SimpleFunction('rdfaProperty', [$this, 'rdfaPropertyFunction'], ['is_safe' => ['html']]),
        );
    }

    /**
     * @param $input
     *
     * @return string
     */
    public function typeFunction($input)
    {
        if (is_string($input)) {
            return 'string';
        } elseif (is_int($input) || is_float($input)) {
            return 'number';
        } elseif (is_bool($input)) {
            return 'bool';
        } elseif (is_object($input)) {
            return 'object';
        } elseif (is_array($input)) {
            return 'array';
        }

        return 'undefined';
    }

    /**
     * @param $input
     *
     * @return string
     */
    public function rdfaPropertyFunction($input)
    {
        if (isset($input[0]) && $input[0] === '@') {
            return '';
        } else {
            return 'property="' . htmlspecialchars($input, ENT_QUOTES) . '"';
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'linked_swissbib_extension';
    }
}
