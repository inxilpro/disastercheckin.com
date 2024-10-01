<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpFoundation\Response;

class ReadOnlySesssionMiddleware
{
    public function __construct(
        protected ViewFactory $view,
        protected StartSession $session,
    ) {}

    public function handle($request, Closure $next): Response
    {
        return $this->isSessionStarted($request)
            ? $this->handleWithSession($request, $next)
            : $this->handleWithoutSession($request, $next);
    }

    protected function handleWithoutSession($request, Closure $next): Response
    {
        $this->view->share('errors', new ViewErrorBag);

        return $next($request);
    }

    protected function handleWithSession($request, Closure $next): Response
    {
        return $this->session->handle($request, function ($request) use ($next) {
            $this->view->share('errors', $request->session()->get('errors') ?: new ViewErrorBag);

            return $next($request);
        });
    }

    protected function isSessionStarted(Request $request): bool
    {
        return $request->cookies->has(Session::getName());
    }
}
