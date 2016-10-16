<?php
namespace LinkedSwissbibBundle\Bridge\Symfony\Bundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

final class SwaggerUiListener
{
    /**
     * Sets SwaggerUiAction as controller if the requested format is HTML.
     *
     * @param $event GetResponseEvent
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ('html' !== $request->getRequestFormat(null) || $request->getPathInfo() !== '/doc') {
            return;
        }

        $request->attributes->set('_controller', 'api_platform.swagger.action.ui');
    }
}
