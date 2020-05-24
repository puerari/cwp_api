<?php

namespace Puerari\Cwp;

/**
 * @trait Package
 * @package Puerari\Cwp
 * @author Leandro Puerari <leandro@puerari.com.br>
 */
trait Package
{
    /**
     * @param string $package_name : Package Name
     * @param int $disk_quota : MB disk space
     * @param int $bandwidth : Bandwidth
     * @param int $ftp_accounts : Number of FTP accounts
     * @param int $email_accounts : Number of e-mail accounts
     * @param int $email_lists : Number of email lists
     * @param int $databases : Number of Data Base Mysql/MariaDB
     * @param int $sub_domains : Number of Max Sub Domains
     * @param int $parked_domains : Number of Max Parked Domains
     * @param int $addons_domains : Number of Max Addons Domains
     * @param int $hourly_emails : Number of Max hourly emails
     * @param int $reseller : (1 = To resell, Account Reseller for a Reseller's Package, Empty for Standard Package)
     * @param int $accounts : Maximum number of accounts allowed for a reseller
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> Package name missing
     * status -> Error, msj -> You must specify the disk size
     * status -> Error, msj -> Name already exists
     */
    public function createPackage(string $package_name, int $disk_quota, int $bandwidth, int $ftp_accounts, int $email_accounts, int $email_lists,
                                  int $databases, int $sub_domains, int $parked_domains, int $addons_domains, int $hourly_emails, int $reseller, int $accounts)
    {
        $this->data = compact('package_name', 'disk_quota', 'bandwidth', 'ftp_accounts', 'quotamail', 'email_accounts', 'email_lists',
            'databases', 'sub_domains', 'parked_domains', 'addons_domains', 'hourly_emails', 'reseller', 'accounts');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'add';
        $this->cwpuri = 'packages';
        return $this->execCurl();
    }

    /**
     * @param string $package_name : New Package Name
     * @param int $disk_quota : New MB disk space
     * @param int $bandwidth : New Bandwidth
     * @param int $ftp_accounts : New Number of FTP accounts
     * @param int $email_accounts : New Number of e-mail accounts
     * @param int $email_lists : New Number of email lists
     * @param int $databases : New Number of Data Base Mysql/MariaDB
     * @param int $sub_domains : New Number of Max Sub Domains
     * @param int $parked_domains : New Number of Max Parked Domains
     * @param int $addons_domains : New Number of Max Addons Domains
     * @param int $hourly_emails : New Number of Max hourly emails
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj => Package name missing
     * status => Error, msj => There is no package with this name
     */
    public function updatePackage(string $package_name, int $disk_quota, int $bandwidth, int $ftp_accounts, int $email_accounts, int $email_lists,
                                  int $databases, int $sub_domains, int $parked_domains, int $addons_domains, int $hourly_emails)
    {
        $this->data = compact('package_name', 'disk_quota', 'bandwidth', 'ftp_accounts', 'quotamail', 'email_accounts',
            'email_lists', 'databases', 'sub_domains', 'parked_domains', 'addons_domains', 'hourly_emails');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'udp';
        $this->cwpuri = 'packages';
        return $this->execCurl();
    }

    /**
     * @param string $package_name : Package Name
     * @param int $id : Package ID
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> You need some of this data: Package name or ID
     * status => Error, msj -> accounts exist with this associated package
     */
    public function deletePackage(string $package_name, int $id)
    {
        $this->data = compact('package_name', 'id');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'del';
        $this->cwpuri = 'packages';
        return $this->execCurl();
    }

    /**
     * @param string $reseller : Account Reseller for a Reseller's Package. 1 = To resell, Empty for Standard Package
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> array
     */
    public function listPackages(string $reseller = '')
    {
        $this->data = compact('reseller');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'packages';
        return $this->execCurl();
    }
}
