<?php

/**
 * MXM JSON API Client
 *
 * @category   Mxm
 * @package    Mxm_Api
 * @copyright  Copyright (c) 2007-2012 Emailcenter UK. (http://www.emailcenteruk.com)
 * @license    Commercial
 */
class Mxm_Api_JsonAccessor
{

    protected $services = array();
    protected $url      = null;
    protected $username = null;
    protected $password = null;

    /**
     * Construct
     *
     * @param array $config object containing url, user, pass
     */
    public function __construct(array $config)
    {
        $this->url      = rtrim($config['url'], '/') . '/api/json/';
        $this->username = $config['user'];
        $this->password = $config['pass'];
    }

    /**
     * Get JsonClient for selected service
     *
     * @param string $service
     * @return JsonClient
     */
    public function getInstance($service)
    {
        if (!isset($this->services[$service])) {
            $url = $this->url . $service;
            $this->services[$service] = new JsonClient($url, $this->username, $this->password);
        }
        return $this->services[$service];
    }

    /**
     * Magic get for service
     *
     * @param string $name
     * @return JsonClient
     */
    public function __get($name)
    {
        return $this->getInstance($name);
    }

}

