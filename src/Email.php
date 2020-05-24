<?php

namespace Puerari\Cwp;

/**
 * @trait Email
 * @package Puerari\Cwp
 * @author Leandro Puerari <leandro@puerari.com.br>
 */
trait Email
{
    /**
     * @param string $user : User name
     * @param string $email : Email account Ex: demo
     * @param string $domain : Domain for mail user
     * @param string $pass : Password for the email account
     * @param int $quotamail : Quota of space allocated to the email account, expressed in MB
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error, msj -> msj Error.
     */
    public function createEmail(string $user, string $email, string $domain, string $pass, int $quotamail = 1024)
    {
        $this->data = compact('user', 'email', 'domain', 'pass', 'quotamail');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'add';
        $this->cwpuri = 'email';
        return $this->execCurl();
    }

    /**
     * @param string $user : User name
     * @param string $mailbox : Mail account mailbox. In: demo@demo.com
     * @param string $password : Password to change
     * @param int $quota : Quota of space to be allocated to the email account, expressed in MB
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status => "OK", msj => Successful update
     * status => "Error", msj => msj error
     */
    public function updateEmail(string $user, string $mailbox, string $password, int $quota = 1024)
    {
        $this->data = compact('user', 'mailbox', 'password', 'quota');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'udp';
        $this->cwpuri = 'email';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param string $mailbox : Mail account mailbox. In: demo@demo.com
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> "Error", msj => msj error
     */
    public function deleteEmail(string $user, string $mailbox)
    {
        $this->data = compact('user', 'mailbox');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'del';
        $this->cwpuri = 'email';
        return $this->execCurl();
    }

    /**
     * @param string $user : User name
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, msj -> array
     */
    public function listEmails(string $user)
    {
        $this->data = compact('user');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'email';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param string $mailbox : Mail account mailbox. In: demo@demo.com
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     */
    public function suspendEmail(string $user, string $mailbox)
    {
        $this->data = compact('user', 'mailbox');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'susp';
        $this->cwpuri = 'email';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account username
     * @param string $mailbox : Mail account mailbox. In: demo@demo.com
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     */
    public function unsuspendEmail(string $user, string $mailbox)
    {
        $this->data = compact('user', 'mailbox');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'unsp';
        $this->cwpuri = 'email';
        return $this->execCurl();
    }

    /**
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK, emailadmin -> email@admin.com
     */
    public function listEmailAdmin()
    {
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'emailadmin';
        return $this->execCurl();
    }
}
