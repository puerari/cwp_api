<?php

namespace Puerari\Cwp;

/**
 * @trait Autossl
 * @package Puerari\Cwp
 * @author Leandro Puerari <leandro@puerari.com.br>
 */
trait Autossl
{
    /**
     * @param string $user : Account username
     * @param string $name : Name of the domain or subdomain to generate the autossl
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj ->(array).
     */
    public function createAutoSsl(string $user, string $name)
    {
        $this->data = compact('user', 'name');
        $this->data['action'] = 'add';
        $this->cwpuri = 'autossl';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account user name
     * @param string $name : Name of the domain or subdomain to delete the autossl
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> Deleted Autossl
     * status -> Error, msj -> Error description
     */
    public function deleteAutoSsl(string $user, string $name)
    {
        $this->data = compact('user', 'name');
        $this->data['action'] = 'del';
        $this->cwpuri = 'autossl';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username (If the user name is omitted, all AutoSSLs are listed)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> Array with the different data of the certificate
     * status -> Error, msj -> Error description
     */
    public function listAutoSsl(string $user = null)
    {
        $this->data = compact('user');
        $this->data['action'] = 'list';
        $this->cwpuri = 'autossl';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account user name
     * @param string $name : Name of the domain or subdomain to renew
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> Error description
     */
    public function renewAutoSsl(string $user, string $name)
    {
        $this->data = compact('user', 'name');
        $this->data['action'] = 'del';
        $this->cwpuri = 'autossl';
        return $this->execCurl();
    }
}
