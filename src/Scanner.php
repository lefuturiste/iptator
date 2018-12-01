<?php

namespace Iptator;

use GuzzleHttp\Client;
use Iptator\Adapters\AdapterInterface;

class Scanner {

    /**
     * @var AdapterInterface[]
     */
    private $adapters = [];

    public function __construct()
    {
        $client = new Client(['http_errors' => false]);
        $this->adapters[] = new Adapters\IpApiDotComAdapter($client);
    }

    /**
     * Query the service and return the IP details or NULL if the query failed
     *
     * @param string $query
     * @param string|NULL $methodName
     * @return Ip|NULL
     */
    public function scan(string $query, $methodName = NULL)
    {
        if (
            filter_var($query, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false &&
            filter_var($query, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false
        ) {
            return NULL;
        }
        if ($methodName == NULL) {
            $adapter = $this->adapters[rand(0, count($this->adapters) - 1)];
        } else {
            $adapter = array_filter($this->adapters, function (AdapterInterface $adapter) use ($methodName) {
                return $adapter->getName() === $methodName;
            })[0];
        }
        $ip = $adapter->query($query);
        if ($ip == NULL) {
            return NULL;
        }
        $ip->queryMethod = $adapter->getName();
        return $ip;
    }
}
