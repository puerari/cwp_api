<?php

namespace Puerari\Cwp;

/**
 * @class Cwpapi
 * @package Puerari\Cwp
 * @author Leandro Puerari <leandro@puerari.com.br>
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

    /** use Traits */
    use Account, Domain;

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
     * @return bool|string
     */
    public function execCurl()
    {
        $this->data['key'] = $this->apikey;
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
}
