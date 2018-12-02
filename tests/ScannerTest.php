<?php

use Iptator\Scanner;
use PHPUnit\Framework\TestCase;

class ScannerTest extends TestCase
{

    public function makeScanner()
    {
        return new Scanner();
    }

    private $googleIp1 = [
        'origin' => '172.217.19.227',
        'organisation' => 'Google LLC',
        'timezone' => 'Europe/Paris',
        'latitude' => 48.8566,
        'longitude' => 2.35222,
        'countryName' => 'France',
        'countryCode' => 'FR',
        'regionName' => 'Île-de-France',
        'regionCode' => 'IDF',
        'city' => 'Paris',
        'zipCode' => 75000,
        'isp' => 'Google LLC',
        'as' => 'AS15169 Google LLC'
    ];

//    private $googleIp2 = [
//        'origin' => '216.239.32.0'
//    ];
//
//    private $googleIp4 = [
//        'origin' => '8.8.8.8'
//    ];
//
//    // http://ip-api.com/json/1.1.1.1
//    private $cloudflareIp1 = [
//      'origin' => '1.1.1.1'
//    ];
//
//    private $amazonIp1 = [
//        'origin' => '13.32.153.129',
//        'as' => 'AS16509 Amazon.com, Inc.'
//    ];

    public function testIpFromGoogleWithIpApiDotCom()
    {
        $scanner = $this->makeScanner();
        $ip = $scanner->scan($this->googleIp1['origin'], 'IpApiDotCom');
        $this->assertNotNull($ip);
        $this->assertEquals($this->googleIp1['origin'], $ip->origin);
        $this->assertEquals('IpApiDotCom', $ip->queryMethod);
        $this->assertEquals($this->googleIp1['zipCode'], $ip->zipCode);
        $this->assertEquals($this->googleIp1['regionCode'], $ip->regionCode);
        $this->assertEquals($this->googleIp1['regionName'], $ip->regionName);
        $this->assertEquals($this->googleIp1['timezone'], $ip->timeZone);
        $this->assertEquals($this->googleIp1['countryName'], $ip->countryName);
        $this->assertEquals($this->googleIp1['countryCode'], $ip->countryCode);
        $this->assertEquals($this->googleIp1['organisation'], $ip->organisation);
        $this->assertEquals($this->googleIp1['isp'], $ip->isp);
        $this->assertEquals($this->googleIp1['city'], $ip->city);
        $this->assertEquals($this->googleIp1['as'], $ip->as);
        $this->assertEquals($this->googleIp1['latitude'], $ip->latitude);
        $this->assertEquals($this->googleIp1['longitude'], $ip->longitude);
        $this->googleIp1['queryMethod'] = 'IpApiDotCom';
        $this->assertEquals($this->googleIp1, $ip->toArray());
    }
}
