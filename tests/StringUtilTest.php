<?php
declare(strict_types=1);

namespace hktr92\TestPilot\Primitives;

use hktr92\Primitives\StringUtil;
use PHPUnit\Framework\TestCase;

/**
 * Class StringUtilTests
 * @package hktr92\TestPilot\Primitives
 * @since   0.1
 */
final class StringUtilTest extends TestCase {
    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testInit(): void {
        $this->assertInstanceOf(
            StringUtil::class,
            StringUtil::init('foo')
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function test__ToString(): void {
        $this->assertEquals(
            'foo',
            StringUtil::init('foo')
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testGet(): void {
        $Mock = StringUtil::init('foo');

        $this->assertEquals(
            $Mock,
            $Mock->get()
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testToUpperCase(): void {
        $this->assertEquals(
            'FOO',
            StringUtil::init('foo')->toUpperCase()
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testToLowerCase(): void {
        $this->assertEquals(
            'foo',
            StringUtil::init('fOo')->toLowerCase()
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testToTitleCase(): void {
        $this->assertEquals(
            'Foo Bar',
            StringUtil::init('fOo baR')->toTitleCase()
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testLength(): void {
        $this->assertEquals(
            3,
            StringUtil::init('foo')->length()
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testFormat(): void {
        $this->assertEquals(
            'foo is true and false',
            StringUtil::init('foo is %s and %s')->format('true', 'false')
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testSplit(): void {
        $this->assertCount(
            3,
            StringUtil::init('foo')->split()
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testToArray(): void {
        $this->assertCount(
            3,
            StringUtil::init('foo bar-tender, buzz_aldrin')->toArray(' ')
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testStartsWith(): void {
        $this->assertTrue(StringUtil::init('foobar')->startsWith('foo'));
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testEndsWith(): void {
        $this->assertTrue(StringUtil::init('foobar')->endsWith('bar'));
    }
}