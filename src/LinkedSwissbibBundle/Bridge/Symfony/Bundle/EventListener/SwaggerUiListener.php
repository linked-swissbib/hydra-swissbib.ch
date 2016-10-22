<?php
namespace LinkedSwissbibBundle\Bridge\Symfony\Bundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * SwaggerUiListener
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
final class SwaggerUiListener
{
    /**
     * Decorates SwaggerUiListener to fix: https://github.com/api-platform/core/issues/804
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
