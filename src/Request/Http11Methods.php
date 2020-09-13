<?php

declare(strict_types=1);

namespace Hschulz\Http\Request;

/**
 * Contains all HTTP/1.1 request methods as constants.
 * @link http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html
 */
interface Http11Methods extends Http10Methods
{
    /**
     * The OPTIONS method represents a request for information about the
     * communication options available on the request/response chain identified
     * by the Request-URI. This method allows the client to determine the
     * options and/or requirements associated with a resource, or the
     * capabilities of a server, without implying a resource action or
     * initiating a resource retrieval.
     * @var string
     */
    public const HTTP_METHOD_OPTIONS = 'OPTIONS';

    /**
     * The PUT method requests that the enclosed entity be stored under the
     * supplied Request-URI. If the Request-URI refers to an already existing
     * resource, the enclosed entity SHOULD be considered as a modified version
     * of the one residing on the origin server. If the Request-URI does not
     * point to an existing resource, and that URI is capable of being defined
     * as a new resource by the requesting user agent, the origin server can
     * create the resource with that URI. If a new resource is created,
     * the origin server MUST inform the user agent via the 201 (Created)
     * response. If an existing resource is modified, either the 200 (OK)
     * or 204 (No Content) response codes SHOULD be sent to indicate successful
     * completion of the request. If the resource could not be created or
     * modified with the Request-URI, an appropriate error response SHOULD be
     * given that reflects the nature of the problem. The recipient of the
     * entity MUST NOT ignore any Content-* (e.g. Content-Range) headers that
     * it does not understand or implement and MUST return a 501 (Not Implemented)
     * response in such cases.
     * @var string
     */
    public const HTTP_METHOD_PUT = 'PUT';

    /**
     * The DELETE method requests that the origin server delete the resource
     * identified by the Request-URI. This method MAY be overridden by human
     * intervention (or other means) on the origin server. The client cannot
     * be guaranteed that the operation has been carried out, even if the status
     * code returned from the origin server indicates that the action has been
     * completed successfully. However, the server SHOULD NOT indicate success
     * unless, at the time the response is given, it intends to delete the
     * resource or move it to an inaccessible location.
     * @var string
     */
    public const HTTP_METHOD_DELETE = 'DELETE';

    /**
     * The TRACE method is used to invoke a remote, application-layer loop- back
     * of the request message. The final recipient of the request SHOULD reflect
     * the message received back to the client as the entity-body of a 200 (OK)
     * response.
     * @var string
     */
    public const HTTP_METHOD_TRACE = 'TRACE';

    /**
     * This specification reserves the method name CONNECT for use with a proxy
     * that can dynamically switch to being a tunnel.
     * @var string
     */
    public const HTTP_METHOD_CONNECT = 'CONNECT';
}
