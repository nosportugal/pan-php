<?php declare(strict_types=1);

namespace PAN\Tests;

use PHPUnit\Framework\TestCase;
use PAN\Cache;

class CacheTest extends TestCase
{
    public function testCacheFile(): void
    {
        $cache = new Cache(['file' => '/tmp/cache.txt']);
        $token = 'foo-bar-baz';
        $cache->set($token);

        $isValid = $cache->get() ? true : false;

        $this->assertEquals($isValid, true);
        $this->assertEquals($cache->get(),  $token);
    }
}
