<?php

declare(strict_types=1);

namespace Hschulz\Http\Response;

use Hschulz\Http\HeaderCollection;

/**
 *
 */
class Response
{
    /**
     * The response headers sent when sending the response.
     * @var HeaderCollection|null
     */
    protected ?HeaderCollection $header = null;

    /**
     *
     * @var string
     */
    protected string $body = '';

    /**
     *
     */
    public function __construct(string $body = '', ?HeaderCollection $header = null)
    {
        $this->body   = $body;
        $this->header = $header ?? new HeaderCollection();
    }

    /**
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->header . $this->body;
    }

    /**
     *
     * @param string $content
     * @return void
     */
    public function setBody($content): void
    {
        $this->body = $content;
    }

    /**
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
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
     * @return HeaderCollection
     */
    public function getHeader(): HeaderCollection
    {
        return $this->header;
    }

    /**
     *
     * @return void
     */
    public function send(): void
    {
        $this->header->emitHeaders();

        echo $this->body ?? '';
    }
}
