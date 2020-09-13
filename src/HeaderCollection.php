<?php

declare(strict_types=1);

namespace Hschulz\Http;

use ArrayObject;
use function header;

/**
 *
 */
class HeaderCollection extends ArrayObject
{
    /**
     *
     * @var string
     */
    public const CRLF = "\r\n";

    /**
     *
     * @return string
     */
    public function __toString(): string
    {
        $out = '';

        foreach ($this as $name => $value) {
            $out .= $name . ': ' . $value . self::CRLF;
        }

        return $out;
    }

    /**
     * Adds a new Header. If the header already exists it is overwritten.
     *
     * @param string $name
     * @param string $value
     * @return bool
     */
    public function addHeader(string $name, string $value): bool
    {
        /* Initialize the return value */
        $isSet = false;

        /* If the given parameters aren't empty */
        if (!empty($name) && !empty($value)) {

            /* Assign the values */
            $this->offsetSet($name, $value);
            $isSet = true;
        }

        return $isSet;
    }

    /**
     * Returns the given headers value.
     *
     * @param string $name
     * @return string
     */
    public function getHeader(string $name): string
    {
        /* If the parameter is found it is returned */
        return $this[$name] ?? '';
    }

    /**
     * Returns an array of all headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * Deletes the given header.
     *
     * @param string $name
     * @return void
     */
    public function deleteHeader(string $name): void
    {
        $this->offsetUnset($name);
    }

    /**
     * Deletes all headers.
     *
     * @return void
     */
    public function resetHeaders(): void
    {
        $this->exchangeArray([]);
    }

    /**
     *
     * @return void
     */
    public function emitHeaders(): void
    {
        foreach ($this as $name => $value) {
            header($name . ': ' . $value);
        }
    }
}
