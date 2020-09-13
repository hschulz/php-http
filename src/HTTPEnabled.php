<?php

declare(strict_types=1);

namespace Hschulz\Http;

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
