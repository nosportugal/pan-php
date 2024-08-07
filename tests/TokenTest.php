<?php declare(strict_types=1);

namespace PAN\Tests;

use PHPUnit\Framework\TestCase;
use PAN\Cache;
use PAN\Token;
use PAN\Tests\Mock\AuthenticationMock;

class TokenTest extends TestCase
{
    public function testIfTokenIsSaveInFileCache()
    {
        $data = [
            'baseUri'      => 'https://auth.apps.paloaltonetworks.com',
            'clientId'     => 'foo@foo.com',
            'clientSecret' => '3ced47bf-4d09-4122-9b9d-afa0fe30fc8c',
            'tsgId'        => 1234567890
        ];
        $authentication = new AuthenticationMock($data);

        $file = "/tmp/{$this->randomString(10)}.txt";
        $cache = new Cache(['file' => $file]);

        $token = (new Token($authentication, $cache))->getToken();

        $this->assertEquals($token, $cache->get());

        // delete file cache
        unlink($file);

        $this->assertEquals(file_exists($file), false);
    }

    private function randomString(int $length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
