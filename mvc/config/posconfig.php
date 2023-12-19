<?php

require_once(dirname(__DIR__).'/helpers/sanalpos/IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
        $options->setApiKey('sandbox-8xqUB9Ulif0gSlPofbnHkdoPHmcdKlkN');
        $options->setSecretKey('sandbox-Yx0jJFRpJ0EpON2dpUAT5fsLUVwimDpV');
        $options->setBaseUrl('https://sandbox-api.iyzipay.com');

        return $options;
    }
}