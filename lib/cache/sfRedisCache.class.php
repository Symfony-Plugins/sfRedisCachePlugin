<?php

/**
 * Cache class that stores cached content in Redis server.
 *
 * @package    sfRedisCachePlugin
 * @subpackage cache
 * @author     Thomas Parisot <thomas@oncle-tom.net>
 * @version    SVN: $Id$
 */
class sfRedisCache extends sfCache
{
  protected $redis = null;

  /**
   * Checks for the existence of Redis object, through the PHP Lib (libphp-redis) or PHP Module (phpredis)
   *
   * Available options :
   * * redis : a redis object (not mandatory)
   *
   * * mode:   Defines if we work with the "compiled" (faster) or "shared" (easier) library (default to "shared")
   * * port:   The default port (default to 6379)
   * * server: The default server (default to 127.0.0.1)
   * 
   * @see sfCache
   */
  public function initialize($options = array())
  {
    parent::initialize($options);

    if($this->getOption('mode', 'shared') === 'shared')
    {
      include 'redis.php';
    }

    if (!class_exists('Redis'))
    {
      throw new sfInitializationException('You must have Redis installed as a compiled module or shared class.');
    }

    if ($this->getOption('redis'))
    {
      $this->redis = $this->getOption('redis');
    }
    else
    {
      $this->redis = new Redis;
      $this->redis->connect($this->getOption('server', '127.0.0.1'), $this->getOption('port', 6379));
    }

    if (!$this->redis->ping())
    {
      throw new sfInitializationException(sprintf("Could not connect to redis server at %s:%s", $this->getOption('server', '127.0.0.1'), $this->getOption('port', 6379)));
    }
  }

  /**
   * @see sfCache
   */
  public function getBackend()
  {
    return $this->redis;
  }

 /**
  * @see sfCache
  */
  public function get($key, $default = null)
  {
    
  }

  /**
   * @see sfCache
   */
  public function has($key)
  {
    
  }

  /**
   * @see sfCache
   */
  public function set($key, $data, $lifetime = null)
  {
    
  }

  /**
   * @see sfCache
   */
  public function remove($key)
  {
    
  }

  /**
   * @see sfCache
   */
  public function clean($mode = sfCache::ALL)
  {
    if (sfCache::ALL === $mode)
    {
      
    }
  }

  /**
   * @see sfCache
   */
  public function getLastModified($key)
  {

  }

  /**
   * @see sfCache
   */
  public function getTimeout($key)
  {

  }

  /**
   * @see sfCache
   */
  public function removePattern($pattern)
  {

  }

  protected function getCacheInfo()
  {

  }
}
