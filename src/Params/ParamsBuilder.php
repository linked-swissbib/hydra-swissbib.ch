<?php

namespace LinkedSwissbibBundle\Params;

use ElasticsearchAdapter\Params\Params;
use Symfony\Component\HttpFoundation\Request;

/**
 * ParamsBuilder
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
interface ParamsBuilder
{
    /**
     * @param Request $request
     *
     * @return Params
     */
    public function buildItemParams(Request $request) : Params;

    /**
     * @param Request $request
     *
     * @return Params
     */
    public function buildCollectionParams(Request $request) : Params;
}
