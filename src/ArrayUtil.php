<?php
declare(strict_types=1);

namespace hktr92\Primitives;

use ArrayIterator;
use Countable;
use Exception;
use InvalidArgumentException;
use IteratorAggregate;
use function file_get_contents;

/**
 * Class ArrayUtil
 * @package hktr92\Primitives
 */
class ArrayUtil implements IteratorAggregate, Countable {
    /**
     * @var array
     */
    private $array = [];

    /**
     * ArrayUtil constructor.
     *
     * @param array $array
     */
    public function __construct(array $array = []) {
        $this->array = $array;
    }

    /**
     * @param string $text
     * @param string $splitBy
     *
     * @return ArrayUtil
     */
    public static function fromString(string $text, string $splitBy): ArrayUtil {
        return new self(explode($splitBy, $text));
    }

    /**
     * @param string $jsonFile
     *
     * @return ArrayUtil
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public static function fromJsonFile(string $jsonFile): ArrayUtil {
        if (false === realpath($jsonFile)) {
            throw new InvalidArgumentException("Json file '{$jsonFile} does not exist.");
        }

        return self::fromJsonString(file_get_contents($jsonFile));
    }

    /**
     * @param string $jsonString
     *
     * @return ArrayUtil
     * @throws InvalidArgumentException
     */
    public static function fromJsonString(string $jsonString): ArrayUtil {
        $parsedJson = json_decode($jsonString, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException("Invalid JSON String: {$jsonString}");
        }

        return new self($parsedJson);
    }

    /**
     * @param int|string $index
     *
     * @return array|mixed|null
     */
    public function get($index = null) {
        if (null === $index) {
            return $this->array;
        }

        return $this->array[$index] ?? null;
    }

    /**
     * @param $index
     *
     * @return bool
     */
    public function exists($index): bool {
        return array_key_exists($index, $this->array);
    }

    /**
     * @param      $element
     * @param bool $strict
     *
     * @return bool
     */
    public function contains($element, bool $strict = true): bool {
        return in_array($element, $this->array, $strict);
    }

    /**
     * @return bool
     */
    public function empty(): bool {
        return count($this->array) === 0;
    }

    /**
     * @param $element
     */
    public function add($element): void {
        array_push($this->array, $element);
    }

    /**
     * @param $offset
     * @param $value
     */
    public function set($offset, $value): void {
        $this->array[$offset] = $value;
    }

    /**
     * @param $offset
     */
    public function unset($offset): void {
        unset($this->array[$offset]);
    }

    /**
     * @return int
     */
    public function count(): int {
        return count($this->array);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator {
        return new ArrayIterator($this);
    }

    /**
     * @param array $array
     *
     * @return ArrayUtil
     */
    public function merge(array $array): ArrayUtil {
        return new self(array_merge($this->array, $array));
    }

    /**
     * @param array $array
     *
     * @return ArrayUtil
     */
    public function diff(array $array): ArrayUtil {
        return new self(array_diff($this->array, $array));
    }
}