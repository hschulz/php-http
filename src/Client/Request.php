<?php

namespace hschulz\Http\Client;

use \hschulz\Http\HeaderCollection;
use const \CURLOPT_HTTPHEADER;
use const \CURLOPT_RETURNTRANSFER;
use const \CURLOPT_URL;
use function \curl_exec;
use function \curl_init;
use function \curl_setopt;

/**
 *
 */
class Request
{

    /**
     *
     * @var HeaderCollection
     */
    protected $header = null;

    /**
     *
     * @var resource
     */
    protected $channel = null;

    /**
     *
     * @param HeaderCollection $header
     */
    public function __construct(HeaderCollection $header)
    {
        $this->header = $header;
        $this->channel = curl_init();
    }

    /**
     *
     * @param string $url
     * @return mixed
     */
    public function exec(string $url)
    {

        /* Temporary header storage */
        $header = [];

        foreach ($this->header as $key => $value) {
            $header[] = $key . ': ' . $value;
        }

        curl_setopt($this->channel, CURLOPT_HTTPHEADER, $header);
        curl_setopt($this->channel, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->channel, CURLOPT_URL, $url);

        return curl_exec($this->channel);
    }

    /**
     *
     * @return HeaderCollection
     */
    public function getHeader(): HeaderCollection
    {
        return $this->header;
    }

    /**
     *
     * @return resource
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     *
     * @param HeaderCollection $header
     * @return void
     */
    public function setHeader(HeaderCollection $header): void
    {
        $this->header = $header;
    }

    /**
     *
     * @param resource $channel
     * @return void
     */
    public function setChannel($channel): void
    {
        $this->channel = $channel;
    }
}
