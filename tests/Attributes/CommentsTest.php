<?php declare(strict_types=1);

namespace PAN\Tests\Attributes;

use PHPUnit\Framework\TestCase;
use PAN\Attributes\Comments;

class CommentsPackage
{
    use Comments;

    public function __construct($comments)
    {
        $this->comments = $comments;
    }
}

class CommentsTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testIfCommentsIsValid($value, $expected): void {
        $attribute = new CommentsPackage($value);

        $isValid = $attribute->commentsIsValid();

        $this->assertEquals($isValid, $expected);
    }

    public static function additionProvider(): array
    {
        $bigText = "Lorem Ipsum is simply dummy text of the printing and typesetting industry.
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
        unknown printer took a galley of type and scrambled it to make a type specimen book.
        It has survived not only five centuries, but also the leap into electronic typesetting,
        remaining essentially unchanged. It was popularised in the 1960s with the release of
        Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
        software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established
        fact that a reader will be distracted by the readable content of a page when looking at
        its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
         of letters, as opposed to using 'Content here, content here', making it look like readable
         English. Many desktop publishing packages and web page editors now use Lorem Ipsum as
         their default model text, and a search for 'lorem ipsum' will uncover many web sites
         still in their infancy. Various versions have evolved over the years, sometimes by accident.";

        return [
            'Should be valid when value is string' => ['foo', true],
            'Should be valid when value is empty string' => ['', true],
            'Should be valid when value is numeric as string' => ['12345', true],
            'Should not be valid when value is numeric' => [12345, false],
            'Should not be valid when value is null' => [null, false],
            'Should not be valid when value is true' => [true, false],
            'Should not be valid when value is false' => [false, false],
            'Should not be valid when value is array' => [['foo', 'baz'], false],
            'Should not be valid when value is object' => [new \stdClass(), false],
            'Should not be valid when value have more than 1023 characters' => [$bigText, false],
        ];
    }
}
