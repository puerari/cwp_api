<?php

namespace Puerari\Cwp;

/**
 * @trait Ftp
 * @package Puerari\Cwp
 * @author Leandro Puerari <leandro@puerari.com.br>
 */
trait Ftp
{
    /**
     * @param string $user : User name
     * @param string $userftp : FTP User
     * @param string $passftp : Ftp user password
     * @param string $domainftp : Domain name
     * @param string $pathftp : Path allowed
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status => "OK", msj => ftp account created successfully
     * status => "Error", msj => You must enter a password"
     * status => "Error", msj => You must indicate a path"
     * status => "Error", msj => You must enter userftp"
     * status => "Error", msj => You must enter username"
     * status => "Error", msj => You must enter domain"
     * status => "Error", msj => You must enter a valid username"
     * status => "Error", msj => invalid domain name"
     * status => "Error", msj => User package error"
     * status => "Error", msj => Package quota exceeded"
     * status => "Error", msj => Ftp account already exists"
     */
    public function createFtp(string $user, string $userftp, string $passftp, string $domainftp, string $pathftp)
    {
        $this->data = compact('user', 'userftp', 'passftp', 'domainftp', 'pathftp');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'add';
        $this->cwpuri = 'ftp';
        return $this->execCurl();
    }

    /**
     * @param string $user : User name
     * @param string $userftp : FTP User
     * @param string $passftp : New Ftp user password
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status => "OK", msj => Successful update
     * status => "Error", msj => Unknown user
     */
    public function updateFtp(string $user, string $userftp, string $passftp)
    {
        $this->data = compact('user', 'userftp', 'passftp');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'udp';
        $this->cwpuri = 'ftp';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param string $userftp : FTP User
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status => "OK", msj => Ftp account successfully removed
     * status => "Error", msj => FTP user does not exist
     * status => "Error", msj => FTP account does not belong to the user
     * status => "Error", msj => Unknown user
     */
    public function deleteFtp(string $user, string $userftp)
    {
        $this->data = compact('user', 'userftp');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'del';
        $this->cwpuri = 'ftp';
        return $this->execCurl();
    }

    /**
     * @param string $user : User name
     * @param string $filter : keyword to filter
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> array
     * status -> OK, msj -> No packages found
     */
    public function listFtps(string $user, string $filter)
    {
        $this->data = compact('user', 'filter');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'ftp';
        return $this->execCurl();
    }
}
