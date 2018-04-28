<?php

namespace hschulz\Http\Tests\Unit;

use \hschulz\Http\HeaderCollection;
use \hschulz\Http\Request\Header as RequestHeader;
use \hschulz\Http\Response\Header as ResponseHeader;
use \PHPUnit\Framework\Error\Error;
use \PHPUnit\Framework\TestCase;

final class HeaderCollectionTest extends TestCase
{

    /**
     *
     * @var HeaderCollection
     */
    protected $headers = null;

    /**
     *
     */
    protected function setUp()
    {
        $this->headers = new HeaderCollection();
        $this->headers[RequestHeader::ACCEPT] = 'text/plain';
        $this->headers[RequestHeader::CACHE_CONTROL] = 'no-cache';
    }

    /**
     *
     */
    protected function tearDown()
    {
        $this->headers = null;
    }

    /**
     *
     */
    public function testCanAddHeader()
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
    public function testCanModifyHeader()
    {
        $this->headers[ResponseHeader::PRAGMA] = 'no-cache';

        $this->assertEquals('no-cache', $this->headers[ResponseHeader::PRAGMA]);
        $this->assertEquals('no-cache', $this->headers->getHeader(ResponseHeader::PRAGMA));

        $this->headers->addHeader(ResponseHeader::PRAGMA, 'cache');

        $this->assertEquals('cache', $this->headers[ResponseHeader::PRAGMA]);
        $this->assertEquals('cache', $this->headers->getHeader(ResponseHeader::PRAGMA));
    }

    public function testCanDeleteHeader()
    {
        $this->expectException(Error::class);

        $this->headers->deleteHeader(RequestHeader::ACCEPT);
        $this->assertEmpty($this->headers[RequestHeader::ACCEPT]);

        unset($this->headers[RequestHeader::CACHE_CONTROL]);
        $this->assertEmpty($this->headers[RequestHeader::CACHE_CONTROL]);
    }

    /**
     *
     */
    public function testCanResetHeaders()
    {
        $this->headers->resetHeaders();

        $this->assertEmpty($this->headers->getArrayCopy());
        $this->assertEmpty($this->headers->getHeaders());
        $this->assertEmpty((array) $this->headers);
        $this->assertEmpty((string) $this->headers);
    }

    public function testCanGetStringRepresentation()
    {
        $this->headers->resetHeaders();

        $this->headers['Test'] = 'test';

        $this->assertEquals('Test: test' . HeaderCollection::CRLF, (string) $this->headers);
    }

    /**
     * @runInSeparateProcess
     */
    public function testCanEmitHeaders()
    {
        $expected = ['Accept: text/plain', 'Cache-Control: no-cache'];

        $this->headers->emitHeaders();

        $headers = xdebug_get_headers();

        $this->assertEquals($expected, $headers);
    }
}
