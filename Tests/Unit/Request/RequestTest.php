<?php

declare(strict_types=1);

namespace Hschulz\Http\Response\Tests\Unit\Response;

use Hschulz\Http\HeaderCollection;
use Hschulz\Http\Request\Request;
use PHPUnit\Framework\TestCase;
use function time;

final class RequestTest extends TestCase
{
    /**
     *
     * @var Request
     */
    protected ?Request $request = null;

    protected function setUp(): void
    {
        $this->request = new Request();
        $this->request->setRequestUri('/test/unit');
        $this->request->setRequestTime(time());
    }

    protected function tearDown(): void
    {
        $this->request = null;
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

    public function testHasTime(): void
    {
        $this->assertLessThanOrEqual(time(), $this->request->getRequestTime());
    }
}
