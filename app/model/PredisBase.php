<?php

namespace Model;

use \Predis\Client,
    \Predis\Autoloader,
        \Nette\SmartObject;
/**
 * Description of Predis
 *
 * @author devel
 */
class PredisBase {

    use SmartObject;

    /**
     *
     * @var Client
     */
    protected $redisClient;

    public function __construct(Autoloader $autoloader, Client $client) {
        $autoloader::register();
        $this->redisClient = $client;
        $this->redisClient->select(1);
        
    }

    function getRedisClient() {
        return $this->redisClient;
    }

    
    function selectDB($n){
        $this->redisClient->select($n);
    }

    
}
