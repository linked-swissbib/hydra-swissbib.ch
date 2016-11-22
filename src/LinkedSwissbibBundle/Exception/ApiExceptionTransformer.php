<?php

namespace LinkedSwissbibBundle\Exception;

use Elasticsearch\Common\Exceptions\BadRequest400Exception;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * ApiExceptionTransformer
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class ApiExceptionTransformer
{
    /**
     * @param Exception $e
     *
     * @throws Exception
     */
    public function transformException(Exception $e)
    {
        if ($e instanceof BadRequest400Exception) {
            throw new BadRequestHttpException(null, $e);
        }

        if ($e instanceof Missing404Exception) {
            throw new NotFoundHttpException(null, $e);
        }

        throw $e;
    }
}
