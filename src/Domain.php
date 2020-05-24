<?php

namespace Puerari\Cwp;

/**
 * @trait Domain
 * @package Puerari\Cwp
 * @author Leandro Puerari <leandro@puerari.com.br>
 */
trait Domain
{
    /**
     * @param string $user : User owners of the scheduled tasks
     * @param string $type : (domain or subdomain)
     * @param string $name : Domain Name or Subdomain Example: my.subdomain.com
     * @param string $path : Path where the domain or subdomain points, Example: /public_html/my subdomain/
     * @param bool $autossl : true or false [You can Generate an AutoSSL (The domain must be pointing to the Server)]
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error -> user does not exist
     */
    public function createDomain(string $user, string $type, string $name, string $path, bool $autossl = false)
    {
        $autossl = intval($autossl);
        $this->data = compact('user', 'type', 'name', 'path', 'autossl');
        $this->data['action'] = 'add';
        $this->cwpuri = 'admindomains';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account user name
     * @param string $type : (domain or subdomain)
     * @param string $name : Domain Name or Subdomain Example: my.subdomain.com
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error -> user does not exist
     * status -> Error -> domain does not exist
     */
    public function deleteDomain(string $user, string $type, string $name)
    {
        $this->data = compact('user', 'type', 'name');
        $this->data['action'] = 'del';
        $this->cwpuri = 'admindomains';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account user name
     * @param string $type : (domain or subdomain)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error -> user does not exist
     */
    public function listDomains(string $user, string $type)
    {
        $this->data = compact('user', 'type');
        $this->data['action'] = 'list';
        $this->cwpuri = 'admindomains';
        return $this->execCurl();
    }

    /**
     * @param string $user : User name
     * @param string $domain : Domain for mail user
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     */
    public function createDkimDomain(string $user, string $domain)
    {
        $this->data = compact('user', 'domain');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'add';
        $this->cwpuri = 'dkim';
        return $this->execCurl();
    }
}
