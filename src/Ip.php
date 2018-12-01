<?php

namespace Iptator;

class Ip
{
    public $queryMethod = NULL;

    public $origin = NULL;

    public $countryName = NULL;

    /**
     * The country code in upper case
     *
     * @var string|null
     */
    public $countryCode = NULL;

    /**
     * @var string|null
     */
    public $zipCode = NULL;

    public $city = NULL;

    /**
     * @var float|null
     */
    public $latitude = NULL;

    /**
     * @var float|null
     */
    public $longitude = NULL;

    /**
     * The region code in upper case
     *
     * @var string|null
     */
    public $regionCode = NULL;

    public $regionName = NULL;

    /**
     * ISP for Internet Service Provider
     *
     * @var string|null
     */
    public $isp = NULL;

    /**
     * AS or Autonomous System
     *
     * @var string|null
     */
    public $as = NULL;

    public $organisation = NULL;

    public $timeZone = NULL;

    public function toArray(): array
    {
        return [
            'queryMethod' => $this->queryMethod,
            'origin' => $this->origin,
            'organisation' => $this->organisation,
            'timezone' => $this->timeZone,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'countryName' => $this->countryName,
            'countryCode' => $this->countryCode,
            'regionName' => $this->regionName,
            'regionCode' => $this->regionCode,
            'city' => $this->city,
            'zipCode' => $this->zipCode,
            'isp' => $this->isp,
            'as' => $this->as
        ];
    }
}
