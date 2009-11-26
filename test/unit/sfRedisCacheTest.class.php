<?php

require_once(dirname(__FILE__).'/../bootstrap/unit.php');

$plan = 60;
$t = new lime_test($plan, new lime_output_color());

try
{
  new sfRedisCache();
}
catch (sfInitializationException $e)
{
  $t->skip($e->getMessage(), $plan);
  return;
}

if (file_exists($configuration->getSymfonyLibDir().'/../test/cache/sfCacheDriverTests.class.php'))
{
  require_once($configuration->getSymfonyLibDir().'/../test/cache/sfCacheDriverTests.class.php');
}
else
{
  throw new sfInitializationException("Sorry but can't launch this test as it relies on sfCacheDriverTests.");
}

// setup
sfConfig::set('sf_logging_enabled', false);

// ->initialize()
$t->diag('->initialize()');
$cache = new sfRedisCache();
$cache->initialize();

sfCacheDriverTests::launch($t, $cache);
