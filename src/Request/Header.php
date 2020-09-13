<?php

declare(strict_types=1);

namespace Hschulz\Http\Request;

/**
 * Contains HTTP request headers as constants.
 */
interface Header
{
    /**
     * Content-Types that are acceptable.
     * @example Accept: text/plain
     * @var string
     */
    public const ACCEPT = 'Accept';

    /**
     * Character sets that are acceptable.
     * @example Accept-Charset: utf-8
     * @var string
     */
    public const CHARSET = 'Accept-Charset';

    /**
     * Acceptable encodings.
     * @example Accept-Encoding: <compress | gzip | deflate | sdch | identity>
     * @var string
     */
    public const ENCODING = 'Accept-Encoding';

    /**
     * Acceptable languages for response.
     * @example Accept-Language: en-US
     * @var string
     */
    public const LANGUAGE = 'Accept-Language';

    /**
     * Authentication credentials for HTTP authentication
     * @example Authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==
     * @var string
     */
    public const AUTHORIZATION = 'Authorization';

    /**
     * Used to specify directives that MUST be obeyed by all caching
     * mechanisms along the request/response chain.
     * @example Cache-Control: no-cache
     * @var string
     */
    public const CACHE_CONTROL = 'Cache-Control';

    /**
     * What type of connection the user-agent would prefer.
     * @example Connection: close
     * @var string
     */
    public const CONNECTION = 'Connection';

    /**
     * An HTTP cookie previously sent by the server with Set-Cookie.
     * @example Cookie: $Version=1; Skin=new;
     * @var string
     */
    public const COOKIE = 'Cookie';

    /**
     * The length of the request body in octets (8-bit bytes).
     * @example Content-Length: 348
     * @var string
     */
    public const CONTENT_LENGTH = 'Content-Length';

    /**
     * A Base64-encoded binary MD5 sum of the content of the request body.
     * @example Content-MD5: Q2hlY2sgSW50ZWdyaXR5IQ==
     * @var string
     */
    public const CONTENT_MD5 = 'Content-MD5';

    /**
     * The mime type of the body of the request (used with POST and PUT requests).
     * @example Content-Type: application/x-www-form-urlencoded
     * @var string
     */
    public const CONTENT_TYPE = 'Content-Type';

    /**
     * The date and time that the message was sent.
     * @example Date: Tue, 15 Nov 1994 08:12:31 GMT
     * @var string
     */
    public const DATE = 'Date';

    /**
     * Indicates that particular server behaviors are required by the client.
     * @example Expect: 100-continue
     * @var string
     */
    public const EXPECT = 'Expect';

    /**
     * The email address of the user making the request.
     * @example From: user@example.com
     * @var string
     */
    public const FROM = 'From';

    /**
     * The domain name of the server (for virtual hosting), mandatory since HTTP/1.1
     * @example Host: en.wikipedia.org
     * @var string
     */
    public const HOST = 'Host';

    /**
     * Only perform the action if the client supplied entity matches the
     * same entity on the server. This is mainly for methods like PUT to
     * only update a resource if it has not been modified since the user
     * last updated it.
     * @example If-Match: "737060cd8c284d8af7ad3082f209582d"
     * @var string
     */
    public const IF_MATCH = 'If-Match';

    /**
     * Allows a 304 Not Modified to be returned if content is unchanged.
     * @example If-Modified-Since: Sat, 29 Oct 1994 19:43:31 GMT
     * @var string
     */
    public const IF_MODIFIED_SINCE = 'If-Modified-Since';

    /**
     * Allows a 304 Not Modified to be returned if content is unchanged
     * @example If-None-Match: "737060cd8c284d8af7ad3082f209582d"
     * @var string
     */
    public const IF_NONE_MATCH = 'If-None-Match';

    /**
     * If the entity is unchanged, send me the part(s) that I am missing;
     * otherwise, send me the entire new entity.
     * @example If-Range: "737060cd8c284d8af7ad3082f209582d"
     * @var string
     */
    public const IF_RANGE = 'If-Range';

    /**
     * Only send the response if the entity has not been modified since
     * a specific time.
     * @example If-Unmodified-Since: Sat, 29 Oct 1994 19:43:31 GMT
     * @var string
     */
    public const IF_UNMODIFIED_SINCE = 'If-Unmodified-Since';

    /**
     * Limit the number of times the message can be forwarded through
     * proxies or gateways.
     * @example Max-Forwards: 10
     * @var string
     */
    public const MAX_FORWARDS = 'Max-Forwards';

    /**
     * Implementation-specific headers that may have various effects
     * anywhere along the request-response chain.
     * @example Pragma: no-cache
     * @var string
     */
    public const PRAGMA = 'Pragma';

    /**
     * Authorization credentials for connecting to a proxy.
     * @example	Proxy-Authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==
     * @var string
     */
    public const PROXY_AUTHORIZATION = 'Proxy-Authorization';

    /**
     * Request only part of an entity. Bytes are numbered from 0.
     * @example Range: bytes=500-999
     * @var string
     */
    public const RANGE = 'Range';

    /**
     * This is the address of the previous web page from which a link to
     * the currently requested page was followed.
     * @example Referer: http://en.wikipedia.org/wiki/Main_Page
     * @var string
     */
    public const REFERER = 'Referer';

    /**
     * The transfer encodings the user agent is willing to accept:
     * the same values as for the response header Transfer-Encoding
     * can be used, plus the "trailers" value (related to the "chunked"
     * transfer method) to notify the server it expects to receive
     * additional headers (the trailers) after the last, zero-sized, chunk.
     * @example TE: trailers, deflate
     * @var string
     */
    public const TE = 'TE';

    /**
     * Ask the server to upgrade to another protocol.
     * @example Upgrade: HTTP/2.0, SHTTP/1.3, IRC/6.9, RTA/x11
     * @var string
     */
    public const UPGRADE = 'Upgrade';

    /**
     * The user agent string of the user agent.
     * @example User-Agent: Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)
     * @var string
     */
    public const USER_AGENT = 'User-Agent';

    /**
     * Informs the server of proxies through which the request was sent.
     * @example Via: 1.0 fred, 1.1 nowhere.com (Apache/1.1)
     * @var string
     */
    public const VIA = 'Via';

    /**
     * A general warning about possible problems with the entity body.
     * @example Warning: 199 Miscellaneous warning
     * @var string
     */
    public const WARNING = 'Warning';

    /**
     * mainly used to identify Ajax requests. Most JavaScript frameworks
     * send this header with value of XMLHttpRequest.
     * @example X-Requested-With: XMLHttpRequest
     * @var string
     */
    public const X_REQUESTED_WITH = 'X-Requested-With';

    /**
     * A de facto standard for identifying the originating IP address of
     * a client connecting to a web server through an HTTP proxy or
     * load balancer
     * @example X-Forwarded-For: client1, proxy1, proxy2
     * @var string
     */
    public const X_FORWARDED_FOR = 'X-Forwarded-For';

    /**
     * Allows easier parsing of the MakeModel/Firmware that is usually
     * found in the User-Agent String of AT&T Devices.
     * @example x-att-deviceid: MakeModel/Firmware
     * @var string
     */
    public const X_ATT_DEVICE_ID = 'x-att-deviceid';

    /**
     * Links to an XML file on the Internet with a full description and
     * details about the device currently connecting.
     * @example x-wap-profile: http://wap.samsungmobile.com/uaprof/SGH-I777.xml
     * @var string
     */
    public const X_WAP_PROFILE = 'x-wap-profile';
}
