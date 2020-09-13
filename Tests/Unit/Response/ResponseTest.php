<?php

namespace Hschulz\Http\Response\Tests\Unit\Response;

use Hschulz\Http\HeaderCollection;
use Hschulz\Http\Response\Header;
use Hschulz\Http\Response\Response;
use PHPUnit\Framework\TestCase;
use function ob_end_clean;
use function ob_get_contents;
use function ob_start;
use function xdebug_get_headers;

final class ResponseTest extends TestCase
{
    public function testCanBeCreatedWithoutArguments(): void
    {
        $res = new Response();

        $this->assertEmpty((string) $res);
    }

    public function testCanBeCreatedWithBodyOnly(): void
    {
        $res = new Response('test');

        $this->assertEquals('test', (string) $res);
    }

    public function testCanBeCreatedWithHeaderOnly(): void
    {
        $header = new HeaderCollection();
        $header->addHeader(Header::SERVER, 'localhost');

        $res = new Response('', $header);

        $this->assertEquals((string) $header, (string) $res);
    }

    public function testCanSetBody(): void
    {
        $res = new Response();

        $res->setBody('test');

        $this->assertEquals('test', (string) $res);
    }

    public function testCanGetBody(): void
    {
        $res = new Response('test');

        $body = $res->getBody();

        $this->assertEquals('test', $body);
    }

    public function testCanSetHeaders(): void
    {
        $header = new HeaderCollection();
        $header->addHeader(Header::X_POWERED_BY, 'phpunit');

        $res = new Response();

        $res->setHeader($header);

        $this->assertEquals((string) $header, (string) $res);
    }

    public function testCanGetHeaders(): void
    {
        $header = new HeaderCollection();

        $header->addHeader(Header::CONTENT_TYPE, 'text/plain');

        $res = new Response('', $header);

        $this->assertEquals('text/plain', $res->getHeader()->getHeader(Header::CONTENT_TYPE));
    }

    /**
     * @runInSeparateProcess
     */
    public function testCanSendResponse(): void
    {
        $expected = ['Allow: GET', 'Cache-Control: max-age=3600'];

        $header = new HeaderCollection();
        $header->addHeader(Header::ALLOW, 'GET');
        $header->addHeader(Header::CACHE_CONTROL, 'max-age=3600');

        $res = new Response('phpunit test', $header);

        ob_start();
        $res->send();
        $content = ob_get_contents();
        ob_end_clean();

        $headers = xdebug_get_headers();

        $this->assertEquals($expected, $headers);

        $this->assertEquals('phpunit test', $content);
    }
}
