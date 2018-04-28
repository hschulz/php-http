<?php

namespace hschulz\Http\Response;

/**
 *
 */
interface Header
{
    /**
     * What partial content range types this server supports.
     * @example Accept-Ranges: bytes
     * @var string
     */
    const ACCEPT_RANGES = 'Accept-Ranges';

    /**
     * The age the object has been in a proxy cache in seconds.
     * @example Age: 12
     * @var string
     */
    const AGE = 'Age';

    /**
     * Valid actions for a specified resource.
     * To be used for a 405 Method not allowed.
     * @example Allow: GET, HEAD
     * @var string
     */
    const ALLOW = 'Allow';

    /**
     * Tells all caching mechanisms from server to client whether they
     * may cache this object. It is measured in seconds.
     * @example Cache-Control: max-age=3600
     * @var string
     */
    const CACHE_CONTROL = 'Cache-Control';

    /**
     * Options that are desired for the connection.
     * @example Connection: close
     * @var string
     */
    const CONNECTION = 'Connection';

    /**
     * The type of encoding used on the data.
     * @example Content-Encoding: gzip
     * @var string
     */
    const CONTENT_ENCODING = 'Content-Encoding';

    /**
     * The language the content is in.
     * @example Content-Language: da
     * @var string
     */
    const CONTENT_LANGUAGE = 'Content-Language';

    /**
     * The length of the response body in octets (8-bit bytes).
     * @example Content-Length: 348
     * @var string
     */
    const CONTENT_LENGTH = 'Content-Length';

    /**
     * An alternate location for the returned data.
     * @example Content-Location: /index.htm
     * @var string
     */
    const CONTENT_LOCATION = 'Content-Location';

    /**
     * A Base64-encoded binary MD5 sum of the content of the response,
     * @example Content-MD5: Q2hlY2sgSW50ZWdyaXR5IQ==
     * @var string
     */
    const CONTENT_MD5 = 'Content-MD5';

    /**
     * An opportunity to raise a "File Download" dialogue box for
     * a known MIME type,
     * @example Content-Disposition: attachment; filename=fname.ext
     * @var string
     */
    const CONTENT_DISPOSITION = 'Content-Disposition';

    /**
     * Where in a full body message this partial message belongs,
     * @example Content-Range: bytes 21010-47021/47022
     * @var string
     */
    const CONTENT_RANGE = 'Content-Range';

    /**
     * The mime type of this content.
     * @example Content-Type: text/html; charset=utf-8
     * @var string
     */
    const CONTENT_TYPE = 'Content-Type';

    /**
     * The date and time that the message was sent.
     * @example Date: Tue, 15 Nov 1994 08:12:31 GMT
     * @var string
     */
    const DATE = 'Date';

    /**
     * An identifier for a specific version of a resource,
     * often a message digest.
     * @example ETag: "737060cd8c284d8af7ad3082f209582d"
     * @var string
     */
    const E_TAG = 'ETag';

    /**
     * Gives the date/time after which the response is considered stale.
     * @example Expires: Thu, 01 Dec 1994 16:00:00 GMT
     * @var string
     */
    const EXPIRES = 'Expires';

    /**
     * (de)<br/>
     * (en) The last modified date for the requested object, in RFC 2822 format
     * @var string
     * @example Last-Modified: Tue, 15 Nov 1994 12:45:26 GMT
     */
    const LAST_MODIFIED = 'Last-Modified';

    /**
     * (de)<br/>
     * (en) Used to express a typed relationship with another resource,
     *      where the relation type is defined by RFC 5988
     * @var string
     * @example Link: </feed>; rel="alternate"
     */
    const LINK = 'Link';

    /**
     * (de)<br/>
     * (en) Used in redirection, or when a new resource has been created.
     * @var string
     * @example Location: http://www.w3.org/pub/WWW/People.html
     */
    const LOCATION = 'Location';

    /**
     * (de)<br/>
     * (en) This header is supposed to set P3P policy, in the form of
     *      P3P:CP="your_compact_policy". However, P3P did not take off,
     *      most browsers have never fully implemented it, a lot of websites set
     *      this header with fake policy text, that was enough to fool browsers
     *      the existence of P3P policy and grant permissions for third party
     *      cookies.
     * @var string
     * @example P3P: CP="This is not a P3P policy!
     * @see http://www.google.com/support/accounts/bin/answer.py?hl=en&answer=151657
     */
    const P3P = 'P3P';

    /**
     * (de)<br/>
     * (en) Implementation-specific headers that may have various effects
     *      anywhere along the request-response chain.
     * @var string
     * @example Pragma: no-cache
     */
    const PRAGMA = 'Pragma';

    /**
     * (de)<br/>
     * (en) Request authentication to access the proxy.
     * @var string
     * @example Proxy-Authenticate: Basic
     */
    const PROXY_AUTHENTICATE = 'Proxy-Authenticate';

    /**
     * (de)<br/>
     * (en) Used in redirection, or when a new resource has been created.
     * @var string
     * @example Refresh: 5; url=http://www.w3.org/pub/WWW/People.html
     */
    const REFRESH = 'Refresh';

    /**
     * (de)<br/>
     * (en) If an entity is temporarily unavailable, this instructs the client
     *      to try again after a specified period of time (seconds).
     * @var string
     * @example Retry-After: 120
     */
    const RETRY_AFTER = 'Retry-After';

    /**
     * (de)<br/>
     * (en) A name for the server
     * @var string
     * @example Server: Apache/1.3.27 (Unix) (Red-Hat/Linux)
     */
    const SERVER = 'Server';

    /**
     * (de)<br/>
     * (en) an HTTP cookie
     * @var string
     * @example Set-Cookie: UserID=JohnDoe; Max-Age=3600; Version=1
     */
    const SET_COOKIE = 'Set-Cookie';

    /**
     * (de)<br/>
     * (en) A HSTS Policy informing the HTTP client how long to cache the HTTPS
     *      only policy and whether this applies to subdomains.
     * @var string
     * @example Strict-Transport-Security: max-age=16070400; includeSubDomains
     */
    const STRICT_TRANSPORT_SECURITY = 'Strict-Transport-Security';

    /**
     * (de)<br/>
     * (en) The Trailer general field value indicates that the given set of
     *      header fields is present in the trailer of a message encoded with
     *      chunked transfer-coding.
     * @var string
     * @example Trailer: Max-Forwards
     */
    const TRAILER = 'Trailer';

    /**
     * (de)<br/>
     * (en) The form of encoding used to safely transfer the entity to the user.
     *      Currently defined methods are:
     *      chunked, compress, deflate, gzip, identity.
     * @var string
     * @example Transfer-Encoding: chunked
     */
    const TRANSFER_ENCODING = 'Transfer-Encoding';

    /**
     * (de)<br/>
     * (en) Tells downstream proxies how to match future request headers to
     *      decide whether the cached response can be used rather than
     *      requesting a fresh one from the origin server.
     * @var string
     * @example Vary: *
     */
    const VARY = 'Vary';

    /**
     * (de)<br/>
     * (en) Informs the client of proxies through which the response was sent.
     * @var string
     * @example Via: 1.0 fred, 1.1 nowhere.com (Apache/1.1)
     */
    const VIA = 'Via';

    /**
     * (de)<br/>
     * (en) A general warning about possible problems with the entity body.
     * @var string
     * @example Warning: 199 Miscellaneous warning
     */
    const WARNING = 'Warning';

    /**
     * (de)<br/>
     * (en) Indicates the authentication scheme that should be used to access
     *      the requested entity.
     * @var string
     * @example WWW-Authenticate: Basic
     */
    const WWW_AUTHENTICATE = 'WWW-Authenticate';

    /**
     * (de)<br/>
     * (en) Clickjacking protection: "deny" - no rendering within a frame,
     *      "sameorigin" - no rendering if origin mismatch
     * @var string
     * @example X-Frame-Options: deny
     */
    const X_FRAME_OPTIONS = 'X-Frame-Options';

    /**
     * (de)<br/>
     * (en) Cross-site scripting (XSS) filter
     * @var string
     * @example X-XSS-Protection: 1; mode=block
     */
    const X_XSS_PROTECTION = 'X-XSS-Protection';

    /**
     * (de)<br/>
     * (en) the only defined value, "nosniff", prevents Internet Explorer from
     *      MIME-sniffing a response away from the declared content-type
     * @var string
     * @example X-Content-Type-Options: nosniff
     */
    const X_CONTENT_TYPE_OPTIONS = 'X-Content-Type-Options';

    /**
     * (de)<br/>
     * (en) a de facto standard for identifying the originating protocol of an
     *      HTTP request, since a reverse proxy (load balancer) may communicate
     *      with a web server using HTTP even if the request to the reverse
     *      proxy is HTTPS
     * @var string
     * @example X-Forwarded-Proto: https
     */
    const X_FORWARDED_PROTO = 'X-Forwared-Proto';

    /**
     * (de)<br/>
     * (en) specifies the technology (e.g. ASP.NET, PHP, JBoss) supporting the
     *      web application (version details are often in X-Runtime, X-Version,
     *      or X-AspNet-Version)
     * @var string
     * @example X-Powered-By: PHP/5.2.1
     */
    const X_POWERED_BY = 'X-Powered-By';

    /**
     * (de)<br/>
     * (en) Recommends the preferred rendering engine (often a
     *      backward-compatibility mode) to use to display the content.
     *      Also used to activate Chrome Frame in Internet Explorer.
     * @var string
     * @example X-UA-Compatible: IE=EmulateIE7 X-UA-Compatible:
     *          IE=edge X-UA-Compatible: Chrome=1
     */
    const X_UA_COMPATIBLE = 'X-UA-Compatible';
}
