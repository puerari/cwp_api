<?php

namespace Puerari\Cwp;

/**
 * @trait Account
 * @package Puerari\Cwp
 * @author Leandro Puerari <leandro@puerari.com.br>
 */
trait Account
{
    /**
     * @param string $domain : main domain associated with the account
     * @param string $user : username to create
     * @param string $pass : Password for the account
     * @param string $email : Email Address of the account owner
     * @param string $server_ips : Ip server
     * @param string $package : Create account with package
     * @param int $inode : Limit inodes, 0 for unlimited
     * @param int $limit_nproc : Limit number of processes for account, don’t use 0 as it will not allow any processes
     * @param int $limit_nofile : Limit number of open files for account
     * @param bool $autossl : Autossl (false = Not / true = Yes)
     * @param bool $encodepass : (true/false if the option is true, you must send the password base64 encoded)
     * @param $reseller : (1 = To resell, Account Reseller for a Reseller's Package, Empty for Standard Package)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> Account already exists.
     */
    public function createAccount(string $domain, string $user, string $pass, string $email, string $server_ips,
                                  string $package = 'default', int $inode = 0, int $limit_nproc = 40, int $limit_nofile = 150,
                                  bool $autossl = false, bool $encodepass = false, $reseller = null)
    {
        $autossl = intval($autossl);
        $this->data = compact('domain', 'user', 'pass', 'email', 'package', 'inode', 'limit_nproc', 'limit_nofile', 'server_ips', 'autossl', 'encodepass', 'reseller');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'add';
        $this->cwpuri = 'account';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param string $email : Email Address of the account owner
     * @param string $server_ips : Ip to edit
     * @param string $package : Package name or ID with @ front Ex: @12
     * @param string $backup : on/off
     * @param int $inode : number of Inodes
     * @param int $processes : number of processes
     * @param int $openfiles : number of open files
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> must indicate a user
     * status -> Error, msj -> User does not exist
     * status -> Error, msj -> You must indicate an email
     * status -> Error, msj -> There is no package with this name
     * status -> Error, msj-> There was an error updating
     * status -> Error, msj -> User is root
     */
    public function updateAccount(string $user, string $email, string $server_ips, string $package = 'default',
                                  string $backup = 'on', int $inode = 0, int $processes = 40, int $openfiles = 150)
    {
        $this->data = compact('user', 'email', 'server_ips', 'package', 'backup', 'inode', 'processes', 'openfiles');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'udp';
        $this->cwpuri = 'account';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param string $email : Email Address of the account owner
     * @param bool $all : (false or emtry / true) Delete all Accounts associated with a reseller (true by default)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> account does not exist
     */
    public function deleteAccount(string $user, string $email, bool $all = true)
    {
        $all = intval($all);
        $this->data = compact('user', 'email', 'all');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'del';
        $this->cwpuri = 'account';
        return $this->execCurl();
    }

    /**
     * @param $reseller : defaults to null - (1 = To resell, Account Reseller for a Reseller's Package, Empty for Standard Package)
     * @param string $op : defaults to null - count (if this option is present, only the number of accounts for the server will be shown)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> array accounts
     * status -> OK, msj -> no records exist
     */
    public function listAccounts($reseller = null, $op = null)
    {
        $this->data = compact('op', 'reseller');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'account';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param bool $all : (false or emtry / true) Suspend all Accounts associated with a reseller (true by default)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> account does not exist
     */
    public function suspendAccount(string $user, bool $all = true)
    {
        $all = intval($all);
        $this->data = compact('user', 'all');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'susp';
        $this->cwpuri = 'account';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param bool $all : (false or emtry / true) Suspend all Accounts associated with a reseller (true by default)
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> account does not exist
     */
    public function unsuspendAccount(string $user, bool $all = true)
    {
        $all = intval($all);
        $this->data = compact('user', 'all');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'unsp';
        $this->cwpuri = 'account';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, Array(domain, subdomains, database, user database)
     * status -> Error, msj -> account does not exist
     */
    public function listAccountDetails(string $user)
    {
        $this->data = compact('user');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'accountdetail';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> array Sniffers (Email, Ftp, Domains, Subdomains, Mysql, User Mysql)
     * status -> Error, msj -> account does not exist
     */
    public function listAccountQuota(string $user)
    {
        $this->data = compact('user');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'accountquota';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param string $package : Package name or ID with @ front Ex: @12
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj=> The package does not exist
     */
    public function updateAccountPackage(string $user, string $package)
    {
        $this->data = compact('user', 'pass', 'server_ips', 'package', 'backup', 'inode', 'processes', 'openfiles');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'udp';
        $this->cwpuri = 'changepack';
        return $this->execCurl();
    }
}
