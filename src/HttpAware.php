<?php

declare(strict_types=1);

namespace Hschulz\Http;

/**
 *
 */
interface HttpAware
{
    /**
     *
     * @param IncomingHTTPRequest $request
     * @return void
     */
    public function setRequest(IncomingHTTPRequest $request): void;

    /**
     *
     * @return IncomingHTTPRequest
     */
    public function getRequest(): IncomingHTTPRequest;
}
