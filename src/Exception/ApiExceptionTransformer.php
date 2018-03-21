<?php

namespace LinkedSwissbibBundle\Exception;

use Elasticsearch\Common\Exceptions\BadRequest400Exception;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Elasticsearch\Common\Exceptions\ServerErrorResponseException;
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
            throw new BadRequestHttpException('Bad Request', $e);
        }

        if ($e instanceof Missing404Exception) {
            throw new NotFoundHttpException('Not found', $e);
        }

        if ($e instanceof ServerErrorResponseException) {
            if (strpos($e->getMessage(), 'Result window is too large') !== false) {
                throw new BadRequestHttpException('Pagination is only allowed up to 10000 items.', $e);
            }
        }

        throw $e;
    }
}
