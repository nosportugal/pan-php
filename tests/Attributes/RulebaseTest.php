<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Rulebase;

class RulebasePackage
{
    use Rulebase;

    public function __construct($rulebase)
    {
        $this->rulebase = $rulebase;
    }
}

class RulebaseTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfRulebaseIsValid($value, $expected): void {
        $attribute = new RulebasePackage($value);

        $isValid = $attribute->rulebaseIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is pre' => ['pre', true],
            'Should be valid when value is post' => ['post', true],
            'Should be valid when value is empty' => ['', false],
        ];
    }
}
