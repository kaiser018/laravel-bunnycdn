<?php

namespace App\Adapters;

use League\Flysystem\Adapter\Ftp;

class Bunnycdn extends Ftp
{

	protected $url;

    /**
     * Constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
    	$this->url = $config['url'];
    	parent::__construct($config);
    }

    /**
     * Get the URL for the file at the given path.
     *
     * @param  string  $path
     * @return string
     */
    public function getUrl($path)
    {
        return rtrim($this->url, '/').'/'.ltrim($path, '/');
    }

}