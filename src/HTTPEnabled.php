<?php

namespace hschulz\Http;

/**
 *
 */
interface HTTPEnabled extends HTTPAware
{

    /**
     *
     */
    public function sendRequest();

    /**
     *
     */
    public function sendResponse();
}
