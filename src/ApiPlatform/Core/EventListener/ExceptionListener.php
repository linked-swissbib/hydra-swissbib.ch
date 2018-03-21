<?php

namespace LinkedSwissbibBundle\ApiPlatform\Core\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener as BaseExceptionListener;

/**
 * ExceptionListener
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class ExceptionListener extends BaseExceptionListener
{
    /**
     * Changing API-Platform default behaviour in order to be able to serialize errors to html
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $request = $event->getRequest();

        if (!$request->attributes->has('_api_resource_class') && !$request->attributes->has('_api_respond')) {
            return;
        }

        parent::onKernelException($event);
    }
}
