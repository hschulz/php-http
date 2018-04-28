<?php

namespace hschulz\Http\Request;

use \hschulz\Http\HeaderCollection;
use \hschulz\Http\Request\Header;
use \hschulz\Network\AbstractIPAddress;
use \hschulz\Network\IPv4;
use \hschulz\Network\Port;
use function \filter_input_array;
use function \gethostbyname;
use function \ini_get;
use function \is_callable;
use function \shell_exec;
use function \stripos;
use function \trim;

/**
 *
 */
class Request
{
    const SERVER_FILTER = [
        'HTTP_HOST' => 0,
        'HTTP_USER_AGENT' => 0,
        'HTTP_ACCEPT' => 0,
        'HTTP_ACCEPT_LANGUAGE' => 0,
        'HTTP_ACCEPT_ENCODING' => 0,
        'HTTP_CONNECTION' => 0,
        'SERVER_ADDRESS' => 0,
        'SERVER_NAME' => 0,
        'REMOTE_ADDR' => 0,
        'SERVER_PORT' => 0,
        'SERVER_PROTOCOL' => 0,
        'REQUEST_METHOD' => 0,
        'REQUEST_URI' => 0,
        'REQUEST_TIME' => 0,
        'HTTPS' => 0
    ];

    /**
     * The protocol used to connect.
     * @var string
     */
    protected $protocol = '';

    /**
     * The method used to connect.
     * @var string
     */
    protected $requestMethod = '';

    /**
     * The requested uri.
     * @var string
     */
    protected $requestUri = '';

    /**
     * The request timestamp when the server startet the process.
     * @var int
     */
    protected $requestTime = '';

    /**
     * The raw body of the request.
     * @var string
     */
    protected $rawBody = '';

    /**
     * Determines if the request uses a secure protocol.
     * @var bool
     */
    protected $isSecure = false;

    /**
     * The request headers.
     * @var HeaderCollection
    */
    protected $header = null;

    /**
     * The server ip address.
     * @var AbstractIPAddress
     */
    protected $serverIp = null;

    /**
     * The client ip address.
     * @var AbstractIPAddress
     */
    protected $remoteIp = null;

    /**
     * The server port.
     * @var Port
     */
    protected $port = null;

    /**
     *
     */
    public function __construct()
    {
        $this->header = new HeaderCollection();
        $this->parseHeaders();
        $this->parseBody();
    }

    protected function parseHeaders(): void
    {
        $isParsed = $this->parseApacheHeaders();

        if ($isParsed) {
            return;
        }

        $data = filter_input_array(INPUT_SERVER, self::SERVER_FILTER, true);

        if ($data['HTTP_HOST'] !== null) {
            $this->header->addHeader(Header::HOST, $data['HTTP_HOST']);
        }

        if ($data['HTTP_USER_AGENT'] !== null) {
            $this->header->addHeader(Header::USER_AGENT, $data['HTTP_USER_AGENT']);
        }

        if ($data['HTTP_ACCEPT'] !== null) {
            $this->header->addHeader(Header::ACCEPT, $data['HTTP_ACCEPT']);
        }

        if ($data['HTTP_ACCEPT_LANGUAGE'] !== null) {
            $this->header->addHeader(Header::ACCEPT_LANGUAGE, $data['HTTP_ACCEPT_LANGUAGE']);
        }

        if ($data['HTTP_ACCEPT_ENCODING'] !== null) {
            $this->header->addHeader(Header::ACCEPT_ENCODING, $data['HTTP_ACCEPT_ENCODING']);
        }

        if ($data['HTTP_CONNECTION'] !== null) {
            $this->header->addHeader(Header::CONNECTION, $data['HTTP_CONNECTION']);
        }

        if ($data['SERVER_NAME'] !== null) {
            $this->header->addHeader(Header::HOST, $data['SERVER_NAME']);
        }

        $this->serverIp = new IPv4($data['SERVER_ADDRESS'] ?? $this->getServerAddr() ?? '');

        $this->remoteIp = new IPv4($data['REMOTE_ADDR'] ?? '');

        $this->port = new Port($data['SERVER_PORT'] ?? 0);

        $this->protocol = $data['SERVER_PROTOCOL'] ?? '';

        $this->requestMethod = $data['REQUEST_METHOD'] ?? '';

        $this->requestUri = $data['REQUEST_URI'] ?? '';

        $this->requestTime = $data['REQUEST_TIME'] ?? '';

        $this->isSecure = empty($data['HTTPS']) ? false : true;
    }

    protected function parseApacheHeaders(): bool
    {
        if (!function_exists('apache_request_headers')) {
            return false;
        }

        $headers = apache_request_headers();

        foreach ($headers as $name => $value) {
            $this->header->addHeader($name, $value);
        }

        return true;
    }

    /**
     *
     * @return string
     */
    protected function getServerAddr(): string
    {
        $isAvailable = is_callable('shell_exec');

        $isEnabled = stripos(ini_get('disable_functions'), 'shell_exec') === false;

        if ($isAvailable && $isEnabled) {
            return gethostbyname(trim(shell_exec('hostname')));
        }

        return '';
    }

    /**
     *
     * @return void
     */
    protected function parseBody(): void
    {
        $sBody = file_get_contents('php://input');

        $this->rawBody = empty($sBody) ? '' : $sBody;
    }

    /**
     * Returns the raw request body.
     * @return string
     */
    public function getRawBody(): string
    {
        return $this->rawBody;
    }

    /**
     * Returns the request header collection.
     * @return HeaderCollection
     */
    public function getHeader(): HeaderCollection
    {
        return $this->header;
    }

    /**
     *
     * @param HeaderCollection $header
     * @return void
     */
    public function setHeader(HTTPHeaderCollection $header): void
    {
        $this->header = $header;
    }

    /**
     *
     * @return AbstractIPAddress
     */
    public function getServerAddress(): AbstractIPAddress
    {
        return $this->serverIp;
    }

    /**
     *
     * @param AbstractIPAddress $address
     * @return void
     */
    public function setServerAddress(AbstractIPAddress $address): void
    {
        $this->serverIp = $address;
    }

    /**
     *
     * @return Port
     */
    public function getPort(): Port
    {
        return $this->port;
    }

    /**
     *
     * @param Port $port
     * @return void
     */
    public function setPort(Port $port): void
    {
        $this->port = $port;
    }

    /**
     *
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     *
     * @param string $protocol
     * @return void
     */
    public function setProtocol(string $protocol): void
    {
        $this->protocol = $protocol;
    }

    /**
     *
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    /**
     *
     * @param string $method
     * @return void
     */
    public function setRequestMethod(string $method): void
    {
        $this->requestMethod = $method;
    }

    /**
     *
     * @return string
     */
    public function getRequestUri(): string
    {
        return $this->requestUri;
    }

    /**
     *
     * @param string $uri
     */
    public function setRequestUri(string $uri)
    {
        $this->requestUri = $uri;
    }

    /**
     *
     * @return string
     */
    public function getRequestTime()
    {
        return $this->requestTime;
    }

    /**
     *
     * @param string $sRequestTime
     */
    public function setRequestTime($sRequestTime)
    {
        $this->requestTime = $sRequestTime;
    }

    /**
     *
     * @return bool If it is a secure request
     */
    public function isSecure(): bool
    {
        return $this->isSecure;
    }

    /**
     *
     * @param bool $isSecure
     */
    public function setSecure(bool $isSecure): void
    {
        $this->isSecure = $isSecure;
    }
}
