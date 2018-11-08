<?php
declare(strict_types=1);

namespace hktr92\TestPilot\Primitives;

use hktr92\Primitives\ArrayUtil;
use PHPUnit\Framework\TestCase;

/**
 * Class ArrayUtilTest
 * @package hktr92\TestPilot\Primitives
 * @since   0.1
 */
final class ArrayUtilTest extends TestCase {
    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testFromString(): void {
        $this->assertInstanceOf(
            ArrayUtil::class,
            ArrayUtil::fromString('bla bla bla', ' ')
        );
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testFromJsonString(): void {
        $this->assertInstanceOf(
            ArrayUtil::class,
            ArrayUtil::fromJsonString('{"foo":"bar"}')
        );
    }
}