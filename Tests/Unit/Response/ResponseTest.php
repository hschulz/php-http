<?php

namespace hschulz\Http\Response\Tests;

use \PHPUnit\Framework\TestCase;
use \hschulz\Http\Response\Response;
use \hschulz\Http\HeaderCollection;
use \hschulz\Http\Response\Header;
use function \ob_start;
use function \ob_get_contents;
use function \ob_end_clean;
use function \xdebug_get_headers;

final class ResponseTest extends TestCase {

    public function testCanBeCreatedWithoutArguments() {

        $res = new Response();

        $this->assertEmpty((string) $res);
    }

    public function testCanBeCreatedWithBodyOnly() {

        $res = new Response('test');

        $this->assertEquals('test', (string) $res);
    }

    public function testCanBeCreatedWithHeaderOnly() {

        $header = new HeaderCollection();
        $header->addHeader(Header::SERVER, 'localhost');

        $res = new Response('', $header);

        $this->assertEquals((string) $header, (string) $res);
    }

    public function testCanSetBody() {

        $res = new Response();

        $res->setBody('test');

        $this->assertEquals('test', (string) $res);
    }

    public function testCanGetBody() {

        $res = new Response('test');

        $body = $res->getBody();

        $this->assertEquals('test', $body);
    }

    public function testCanSetHeaders() {

        $header = new HeaderCollection();
        $header->addHeader(Header::X_POWERED_BY, 'phpunit');

        $res = new Response();

        $res->setHeader($header);

        $this->assertEquals((string) $header, (string) $res);
    }

    public function testCanGetHeaders() {

        $header = new HeaderCollection();

        $header->addHeader(Header::CONTENT_TYPE, 'text/plain');

        $res = new Response('', $header);

        $this->assertEquals('text/plain', $res->getHeader()->getHeader(Header::CONTENT_TYPE));
    }

    /**
     * @runInSeparateProcess
     */
    public function testCanSendResponse() {

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
