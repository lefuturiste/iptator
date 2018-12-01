<?php

namespace Iptator\Adapters;

use GuzzleHttp\Client;
use Iptator\Ip;

class IpApiDotComAdapter implements AdapterInterface
{

    /**
     * @var Client
     */
    private $client;

    private $endpoint = "http://ip-api.com";

    public $name = 'IpApiDotCom';

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
        $response = $this->client->get($this->endpoint . "/json/{$query}");

        if ($response->getStatusCode() !== 200) {
            return NULL;
        }

        $body = json_decode($response->getBody()->getContents(), true);

        if ($body == NULL || $body['status'] !== 'success') {
            return NULL;
        }

        $ip = new Ip();
        $ip->origin = $query;
        $ip->countryName = $body['country'];
        $ip->countryCode = $body['countryCode'];
        $ip->isp = $body['isp'];
        $ip->latitude = (float)$body['lat'];
        $ip->longitude = (float)$body['lon'];
        $ip->city = $body['city'];
        $ip->zipCode = $body['zip'];
        $ip->as = $body['as'];
        $ip->organisation = $body['org'];
        $ip->regionCode = $body['region'];
        $ip->regionName = $body['regionName'];
        $ip->timeZone = $body['timezone'];

        return $ip;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
