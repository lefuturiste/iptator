# Iptator

The best way to get details about an IP address, no php ext required. Get ip details from multiple api source.

## Install

`composer install lefuturiste/iptator`

## Requirement

This package use the guzzle http php library to make http request, so curl ext is required.

## Usage

```php

use Iptator\Scanner;

$scanner = new Scanner();
$ip = $scanner->scan('1.1.1.1');
$ip->isp; // Cloudflare, Inc.
$ip->countryName; // Australia
$ip->city; // South Brisbane

```
