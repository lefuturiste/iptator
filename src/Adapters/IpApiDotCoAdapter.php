<?php

namespace Iptator\Adapters;

use GuzzleHttp\Client;
use Iptator\Ip;

class IpApiDotCoAdapter implements AdapterInterface
{

    /**
     * @var Client
     */
    private $client;

    private $endpoint = "http://ipapi.co";

    public $name = 'IpApiDotCo';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $query
     * @return Ip|NULL
     */
    public function query(string $query)
    {
        $response = $this->client->get($this->endpoint . "/{$query}/json");

        if ($response->getStatusCode() !== 200) {
            return NULL;
        }

        $body = json_decode($response->getBody()->getContents(), true);

        if ($body == NULL || isset($body['error']) || $body['error']) {
            return NULL;
        }

        $ip = new Ip();
        $ip->origin = $query;
        $ip->countryName = $body['country_name'];
        $ip->countryCode = $body['country'];
        $ip->isp = str_replace(explode(' ', $body['asn'])[0], '', $body['asn']);
        $ip->latitude = (float)$body['latitude'];
        $ip->longitude = (float)$body['longitude'];
        $ip->city = $body['city'];
        $ip->zipCode = $body['postal'];
        $ip->as = $body['asn'];
        $ip->organisation = $body['org'];
        $ip->regionCode = $body['region_code'];
        $ip->regionName = $body['region'];
        $ip->timeZone = $body['timezone'];

        return $ip;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
