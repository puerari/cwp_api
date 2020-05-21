<?php

namespace Puerari\Cwp;

/**
 * Cwpapi Connect
 * @package Puerari\Cwp
 */
class Cwpapi
{
    /** @var string Key authorized by API administrator */
    private $apikey;

    /** @var string URL for the CWP server */
    private $cwpurl;

    /** @var string URI for the API */
    private $cwpuri;

    /** @var bool defaults to false - Verify or not the SSL certificate */
    private $sslverify;

    /** @var array data to be passed to the API */
    private $data;

    /** @var int (0 / 1) Debug display file: /var/log/cwp/cwp_api.log */
    private $debug;

    /** Cwpapi constructor. */
    public function __construct(string $cwpurl, string $apikey, bool $sslverify = false, bool $debug = false)
    {
        if (!filter_var($cwpurl, FILTER_VALIDATE_URL)) {
            throw new \Exception('Invalid URL!');
        }
        $urllen = strlen($cwpurl) - 1;
        $url = ($cwpurl[$urllen] == "/") ? mb_substr($cwpurl, 0, $urllen) : $cwpurl;

        $this->cwpurl = $url . ':2304/v1/';
        $this->apikey = $apikey;
        $this->sslverify = $sslverify;
        $this->debug = intval($debug);
    }

    /**
     * @return bool
     */
    public function getDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug)
    {
        $this->debug = intval($debug);
    }

    /**
     * @param string $domain : main domain associated with the account
     * @param string $user : username to create
     * @param string $pass : Password for the account
     * @param string $email : Email Address of the account owner
     * @param string $package : Create account with package
     * @param int $autossl : Autossl (0 = Not / 1 = Yes)
     * @param bool $encodepass : (true/false if the option is true, you must send the password base64 encoded)
     * @param int $reseller : (1 = To resell, Account Reseller for a Reseller's Package, Empty for Standard Package)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     */
    public function createAccount(
        string $domain, string $user, string $pass, string $email,
        $package = 'default',
        $autossl = 0,
        $encodepass = false,
        $reseller = 0
    )
    {
        $this->data = compact('domain', 'user', 'pass', 'email', 'package', 'autossl', 'encodepass', 'reseller');
        $this->data['action'] = 'add';
        $this->cwpuri = 'account';
        return $this->execCurl();
    }

    /**
     * @return bool|string
     */
    private function execCurl()
    {
        $this->data['key'] = $this->apikey;
        $this->data['debug'] = $this->debug;
        $url = $this->cwpurl . $this->cwpuri;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->sslverify);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->data));
        curl_setopt($ch, CURLOPT_POST, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /**
     * @param $reseller : defaults to null - (1 = To resell, Account Reseller for a Reseller's Package, Empty for Standard Package)
     * @param string $op : defaults to null - count (if this option is present, only the number of accounts for the server will be shown)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> array accounts
     * status -> OK, msj -> no records exist
     */
    public function readAccount($reseller = null, $op = null)
    {
        $this->data = compact('op', 'reseller');
        $this->data['action'] = 'list';
        $this->cwpuri = 'account';
        return $this->execCurl();
    }

}
