<?php

namespace IspApi\Func\WebDomain;

use IspApi\Func\AbstractFunc;

/**
 * Class DomainEdit
 */
class Edit extends AbstractFunc
{
    protected $func = 'webdomain.edit';

    /**
     * Edit constructor.
     *
     * @param string $domain
     */
    public function __construct(string $domain)
    {
        $this->additional['sok'] = 'ok';
        parent::__construct($domain);
    }

    /**
     * @param string $email
     *
     * @return Edit
     */
    public function setEmail(string $email): self
    {
        $this->additional['email'] = $email;
        return $this;
    }

    /**
     * @param string $aliases
     *
     * @return Edit
     */
    public function setAliases(string $aliases): self
    {
        $this->additional['aliases'] = $aliases;
        return $this;
    }

    /**
     * @param string $home
     *
     * @return Edit
     */
    public function setHome(string $home): self
    {
        $this->additional['home'] = $home;
        return $this;
    }

    /**
     * @param string $ssl_cert
     *
     * @return Edit
     */
    public function set_ssl_cert(string $ssl_cert): self
    {
        $this->additional['ssl_cert'] = $ssl_cert;
        return $this;
    }

    /**
     * @param bool $secure
     *
     * @return Edit
     */
    public function set_secure(bool $secure): self
    {
        $this->additional['secure'] = ($secure) ? 'on' : 'off';
        $this->additional['ssl_port'] = '443';
        // $this->additional['redirect_http'] = 'on';
        return $this;
    }

    public function set_senantic_url(bool $semantic_url): self
    {
        $this->additional['site_semantic_url'] = $semantic_url;
        return $this;
    }


}
