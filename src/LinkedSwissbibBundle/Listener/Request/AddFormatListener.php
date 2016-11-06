<?php

namespace LinkedSwissbibBundle\Listener\Request;

use ApiPlatform\Core\EventListener\AddFormatListener as ApiPlatformAddFormatListner;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * AddFormatListener
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
final class AddFormatListener
{
    /**
     * @var ApiPlatformAddFormatListner
     */
    protected $addFormatListener;

    /**
     * @param ApiPlatformAddFormatListner $addFormatListener
     */
    public function __construct(ApiPlatformAddFormatListner $addFormatListener)
    {
        $this->addFormatListener = $addFormatListener;
    }

    /**
     * Fixes the issue that the swagger doc is not available if request format json is not supported
     *
     * @param GetResponseEvent $event
     *
     * @throws NotFoundHttpException
     * @throws NotAcceptableHttpException
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($request->getPathInfo() === '/doc.json') {
            $request->setRequestFormat('json');
        } else {
            $this->addFormatListener->onKernelRequest($event);
        }
    }
}
