<?php

namespace hschulz\Http;

use \hschulz\Http\HttpAware;

/**
 *
 */
interface HTTPEnabled extends HTTPAware {

    /**
     *
     */
    public function sendRequest();

    /**
     *
     */
    public function sendResponse();
}
