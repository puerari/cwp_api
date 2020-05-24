<?php

namespace Puerari\Cwp;

/**
 * @trait Mysql
 * @package Puerari\Cwp
 * @author Leandro Puerari <leandro@puerari.com.br>
 */
trait Mysql
{
    /**
     * @param string $user : Account username
     * @param string $database : Data Base Name (Max 8 Characters)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> Duplicate data base name
     * status -> Error, msj -> Mysql Package Exhausted
     */
    public function createMysqlDatabase(string $user, string $database)
    {
        $this->data = compact('user', 'database');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'add';
        $this->cwpuri = 'databasemysql';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param string $database : Data Base Name (Max 8 Characters)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> Deleted database
     * status -> Error, can not delete database as root
     */
    public function deleteMysqlDatabase(string $user, string $database)
    {
        $this->data = compact('user', 'database');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'del';
        $this->cwpuri = 'databasemysql';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> array
     * status -> OK, msj -> No packages found
     */
    public function listMysqlDatabases(string $user)
    {
        $this->data = compact('user');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'databasemysql';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param string $userdb : Database User
     * @param string $pass : Password for the database user
     * @param string $dbase : Data Base Name (Max 8 Characters)
     * @param string $host : Name Host (%, Localhost, IP)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> User already exists
     */
    public function createMysqlUser(string $user, string $userdb, string $pass, string $dbase, string $host)
    {
        $this->data = compact('user', 'userdb', 'pass', 'dbase', 'host');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'add';
        $this->cwpuri = 'usermysql';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param string $userdb : Database User
     * @param string $host : Name Host (%, Localhost, IP)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     */
    public function deleteMysqlUser(string $user, string $userdb, string $host)
    {
        $this->data = compact('user', 'userdb', 'host');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'del';
        $this->cwpuri = 'usermysql';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> Array of database users
     * status -> Error, msj -> User does not exist
     */
    public function listMysqlUsers(string $user)
    {
        $this->data = compact('user');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'usermysql';
        return $this->execCurl();
    }
}
