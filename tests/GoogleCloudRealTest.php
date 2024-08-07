<?php declare(strict_types=1);

namespace PAN\Tests;

use PHPUnit\Framework\TestCase;
use Google\Cloud\Firestore\FirestoreClient;

//putenv("GOOGLE_APPLICATION_CREDENTIALS=" . __DIR__ . '/haas-d-220011-423b41e18695.json');

class GoogleCloudRealTest extends TestCase
{
    public function testConnection()
    {
        $firestore = new FirestoreClient([
            // 'keyFile' => json_decode(file_get_contents('/var/data/pan/tests/haas-d-220011-423b41e18695.json'), true)
            'keyFilePath' => '/var/data/pan/tests/haas-d-220011-423b41e18695.json'
        ]);

        $this->assertEquals(true, true);
    }
}
