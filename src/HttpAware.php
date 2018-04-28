<?php

namespace hschulz\Http;

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
