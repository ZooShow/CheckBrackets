<?php

declare(strict_types=1);

use Checker\Checker;
use PHPUnit\Framework\TestCase;

class CheckerTest extends TestCase
{
    private Checker $checker;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->checker = new Checker();
        parent::__construct($name, $data, $dataName);
    }

    public function testWithValidStringOnlyBracket(): void
    {
        self::assertEquals(true, $this->checker->check('(())'));
    }

    public function testWithNoValidStringOnlyBracket(): void
    {
        self::assertEquals(false, $this->checker->check('((())'));
    }

    public function testWithValidStringOnlyCurvyBracket(): void
    {
        self::assertEquals(true, $this->checker->check('{{{}}}'));
    }

    public function testWithNoValidStringOnlyCurvyBracket(): void
    {
        self::assertEquals(false, $this->checker->check('{{{}}'));
    }

    public function testWithValidStringOnlySquareBracket(): void
    {
        self::assertEquals(true, $this->checker->check('[[]][[]]'));
    }

    public function testWithNoValidStringOnlySquareBracket(): void
    {
        self::assertEquals(false, $this->checker->check('[][]]['));
    }

    public function testWithValidMixedString(): void
    {
        self::assertEquals(true, $this->checker->check('({[{([])}][][{([])}]})'));
    }

    public function testWithNoValidMixedString(): void
    {
        self::assertEquals(false, $this->checker->check('{({[{([])}][][{([])}]})]'));
    }
}