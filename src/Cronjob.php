<?php

namespace Puerari\Cwp;

/**
 * @trait Cronjob
 * @package Puerari\Cwp
 * @author Leandro Puerari <leandro@puerari.com.br>
 */
trait Cronjob
{
    /**
     * @param string $user : User owners of the scheduled tasks
     * @param string $execute : Frequency with which to execute the cron Example: * * * * * *
     * @param string $command : Command to execute, Example: /usr/bin/php test.php
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error -> user does not exist
     */
    public function createCronJob(string $user, string $execute, string $command)
    {
        $this->data = compact('user', 'execute', 'command');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'add';
        $this->cwpuri = 'cronjobsusers';
        return $this->execCurl();
    }

    /**
     * @param string $user : User owners of the scheduled tasks
     * @param string $execute : Frequency with which to execute the cron Example: * * * * * *
     * @param string $command : Command to execute, Example: /usr/bin/php test.php
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error -> user does not exist
     * status -> Error -> domain does not exist
     */
    public function deleteCronJob(string $user, string $execute, string $command)
    {
        $this->data = compact('user', 'execute', 'command');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'del';
        $this->cwpuri = 'cronjobsusers';
        return $this->execCurl();
    }

    /**
     * @param string $user : Account user name
     * @return string|bool: false on failure, result on success (JSON / XML)
     * status -> OK
     * status -> Error -> user does not exist
     */
    public function listCronJobs(string $user)
    {
        $this->data = compact('user');
        $this->data['debug'] = $this->debug;
        $this->data['action'] = 'list';
        $this->cwpuri = 'cronjobsusers';
        return $this->execCurl();
    }
}
