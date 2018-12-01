<?php

namespace Iptator\Adapters;

use Iptator\Ip;

interface AdapterInterface
{
    public function getName(): string;

    /**
     * Get the ip or NULL if the query failed
     *
     * @param string $query
     * @return Ip|NULL
     */
    public function query(string $query);
}
