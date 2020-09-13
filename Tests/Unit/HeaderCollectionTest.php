<?php

namespace Hschulz\Http\Tests\Unit;

use Hschulz\Http\HeaderCollection;
use Hschulz\Http\Request\Header as RequestHeader;
use Hschulz\Http\Response\Header as ResponseHeader;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;

final class HeaderCollectionTest extends TestCase
{
    /**
     *
     * @var HeaderCollection
     */
    protected ?HeaderCollection $headers = null;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->headers = new HeaderCollection();
        $this->headers[RequestHeader::ACCEPT] = 'text/plain';
        $this->headers[RequestHeader::CACHE_CONTROL] = 'no-cache';
    }

    /**
     *
     */
    protected function tearDown(): void
    {
        $this->headers = null;
    }

    /**
     *
     */
    public function testCanAddHeader(): void
    {
        $this->headers->addHeader(RequestHeader::CHARSET, 'utf-8');
        $this->headers[RequestHeader::HOST] = 'localhost';

        $this->assertEquals('utf-8', $this->headers[RequestHeader::CHARSET]);
        $this->assertEquals('utf-8', $this->headers->getHeader(RequestHeader::CHARSET));

        $this->assertEquals('localhost', $this->headers[RequestHeader::HOST]);
        $this->assertEquals('localhost', $this->headers->getHeader(RequestHeader::HOST));
    }

    /**
     *
     */
    public function testCanModifyHeader(): void
    {
        $this->headers[ResponseHeader::PRAGMA] = 'no-cache';

        $this->assertEquals('no-cache', $this->headers[ResponseHeader::PRAGMA]);
        $this->assertEquals('no-cache', $this->headers->getHeader(ResponseHeader::PRAGMA));

        $this->headers->addHeader(ResponseHeader::PRAGMA, 'cache');

        $this->assertEquals('cache', $this->headers[ResponseHeader::PRAGMA]);
        $this->assertEquals('cache', $this->headers->getHeader(ResponseHeader::PRAGMA));
    }

    public function testCanDeleteHeader(): void
    {
        $this->expectError(Error::class);

        $this->headers->deleteHeader(RequestHeader::ACCEPT);
        $this->assertEmpty($this->headers[RequestHeader::ACCEPT]);

        unset($this->headers[RequestHeader::CACHE_CONTROL]);
        $this->assertEmpty($this->headers[RequestHeader::CACHE_CONTROL]);
    }

    /**
     *
     */
    public function testCanResetHeaders(): void
    {
        $this->headers->resetHeaders();

        $this->assertEmpty($this->headers->getArrayCopy());
        $this->assertEmpty($this->headers->getHeaders());
        $this->assertEmpty((array) $this->headers);
        $this->assertEmpty((string) $this->headers);
    }

    public function testCanGetStringRepresentation(): void
    {
        $this->headers->resetHeaders();

        $this->headers['Test'] = 'test';

        $this->assertEquals('Test: test' . HeaderCollection::CRLF, (string) $this->headers);
    }

    /**
     * @runInSeparateProcess
     */
    public function testCanEmitHeaders(): void
    {
        $expected = ['Accept: text/plain', 'Cache-Control: no-cache'];

        $this->headers->emitHeaders();

        $headers = xdebug_get_headers();

        $this->assertEquals($expected, $headers);
    }
}
