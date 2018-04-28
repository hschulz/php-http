<?php

namespace hschulz\Http\Request;

/**
 * Contains HTTP/1.0 request methods as constants.
 * @link http://www.w3.org/Protocols/HTTP/1.0/draft-ietf-http-spec.html#Methods
 */
interface Http10Methods
{
    /**
     * The GET method means retrieve whatever information (in the form of
     * an entity) is identified by the Request-URI.
     * @var string
     */
    const HTTP_METHOD_GET = 'GET';

    /**
     * The HEAD method is identical to GET except that the server must not
     * return any Entity-Body in the response.
     * @var string
     */
    const HTTP_METHOD_HEAD = 'HEAD';

    /**
     * The POST method is used to request that the destination server
     * accept the entity enclosed in the request as a new subordinate
     * of the resource identified by the Request-URI in the Request-Line.
     * @var string
     */
    const HTTP_METHOD_POST = 'POST';
}
