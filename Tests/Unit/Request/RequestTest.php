<?php

namespace hschulz\Http\Response\Tests\Unit\Response;

use \hschulz\Http\HeaderCollection;
use \hschulz\Http\Request\Request;
use \PHPUnit\Framework\TestCase;
use function \time;

final class RequestTest extends TestCase
{

    /**
     *
     * @var Request
     */
    protected $request = null;

    protected function setUp()
    {
        $this->request = new Request();
        $this->request->setRequestUri('/test/unit');
        $this->request->setRequestTime(time());
    }

    protected function tearDown()
    {
    }

    public function testCanParseHeaders(): void
    {
        $this->assertNotNull($this->request->getHeader());
    }

    public function testCanSetEmptyHeaders(): void
    {
        $header = new HeaderCollection();

        $this->request->setHeader($header);

        $this->assertEquals($header, $this->request->getHeader());
    }

    public function testCanParseRawBody(): void
    {
        $this->assertEquals('', $this->request->getRawBody());
    }

    public function testCanSetRequestUri(): void
    {
        $this->assertEquals('/test/unit', $this->request->getRequestUri());
    }

    public function testHas(): void
    {
        $this->assertLessThanOrEqual(time(), $this->request->getRequestTime());
    }
}
