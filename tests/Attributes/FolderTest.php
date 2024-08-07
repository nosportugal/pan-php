<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Folder;

class FolderPackage
{
    use Folder;

    public function __construct($folder)
    {
        $this->folder = $folder;
    }
}

class FolderTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfFolderIsValid($value, $expected): void {
        $attribute = new FolderPackage($value);

        $isValid = $attribute->folderIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        return [
            'Should be valid when value is string' => ['All', true],
            'Should be valid when value is string' => ['Shared', true],
            'Should be valid when value is string' => ['Mobile Users', true],
            'Should be valid when value is string' => ['Remote Networks', true],
            'Should be valid when value is string' => ['Service Connections', true],
            'Should be valid when value is string' => ['Mobile Users Container', true],
            'Should be valid when value is string' => ['Mobile Users Explicit Proxy', true],
            'Should be valid when value is numeric as string' => ['12345', false],
            'Should not be valid when value is empty string' => ['', false],
            'Should not be valid when value is numeric' => [12345, false],
            'Should not be valid when value is null' => [null, false],
            'Should not be valid when value is true' => [true, false],
            'Should not be valid when value is false' => [false, false],
            'Should not be valid when value is array' => [['foo', 'baz'], false],
            'Should not be valid when value is object' => [new \stdClass(), false],
        ];
    }
}
