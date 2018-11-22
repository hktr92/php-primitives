<?php
declare(strict_types=1);

namespace hktr92\Primitives;

use function explode;
use function mb_convert_case;
use function mb_internal_encoding;
use function mb_strcut;
use function mb_strpos;
use function mb_substr;
use function str_split;
use function vsprintf;

/**
 * Class StringUtil
 * @package hktr92\Primitives
 * @since   0.1
 */
class StringUtil {
    /**
     * @var string|null
     */
    private $text;

    /**
     * @var null|string
     */
    private $encoding;

    /**
     * StringUtil constructor.
     *
     * @param string      $text
     * @param string|null $encoding
     */
    public function __construct(string $text, string $encoding = null) {
        $this->text = $text;

        $this->setEncoding($encoding ?? 'UTF-8');
    }

    /**
     * @param string $encoding
     */
    public function setEncoding(string $encoding): void {
        $this->encoding = $encoding;

        mb_internal_encoding($encoding);
    }

    /**
     * @return string
     */
    public function getEncoding(): string {
        return $this->encoding;
    }

    /**
     * @param int $case
     *
     * @return string
     */
    private function caseConverter(int $case): string {
        return mb_convert_case($this->text, $case);
    }

    /**
     * @return string
     */
    public function toUpperCase(): string {
        return $this->caseConverter(MB_CASE_UPPER);
    }

    /**
     * @return string
     */
    public function toLowerCase(): string {
        return $this->caseConverter(MB_CASE_LOWER);
    }

    /**
     * @return string
     */
    public function toTitleCase(): string {
        return $this->caseConverter(MB_CASE_TITLE);
    }

    /**
     * @return int
     */
    public function length(): int {
        return mb_strlen($this->text);
    }

    /**
     * @param string ...$variables
     *
     * @return string
     */
    public function format(string ...$variables): string {
        return vsprintf($this->text, $variables);
    }

    /**
     * @return array
     */
    public function split(): array {
        return str_split($this->text);
    }

    /**
     * Checks if a string starts with another string
     *
     * @param string $starting
     *
     * @return bool
     */
    public function startsWith(string $starting): bool {
        $starting = StringUtil::init($starting);

        return mb_substr($this->text, 0, $starting->length()) === $starting->get();
    }

    /**
     * Checks if a string ends with another string
     *
     * @param string $ending
     *
     * @return bool
     */
    public function endsWith(string $ending): bool {
        $ending = StringUtil::init($ending, $this->getEncoding());

        return mb_substr($this->text, -$ending->length(), null) === $ending->get();
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public function contains(string $string): bool {
        return false !== mb_strpos($this->text, $string);
    }

    /**
     * Cuts the text starting a given position and having a given length.
     *
     * @param int $start
     * @param int $length
     *
     * @return StringUtil
     */
    public function cut(int $start, ?int $length = null): StringUtil {
        $length = $length ?? $this->length();
        $cut    = mb_strcut($this->text, $start, $length);

        return self::init($cut, $this->getEncoding());
    }

    /**
     * Performs a clone for this class.
     *
     * @return StringUtil
     */
    public function copy(): StringUtil {
        return clone $this;
    }

    /**
     * @param string $delimiter
     *
     * @return array
     */
    public function toArray(string $delimiter): array {
        return explode($delimiter, $this->text);
    }

    /**
     * @param mixed       $anything
     *
     * @param null|string $encoding
     *
     * @return StringUtil
     */
    public static function init($anything, ?string $encoding = null): StringUtil {
        return new self((string)$anything, $encoding);
    }

    /**
     * @return string
     */
    public function get(): string {
        return $this->__toString();
    }

    /**
     * @return string
     */
    public function __toString(): string {
        return $this->text;
    }

    /**
     * @return StringUtil
     */
    private function __clone() {
        return new self($this->get(), $this->getEncoding());
    }
}