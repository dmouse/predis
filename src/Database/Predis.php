<?php

/**
 * @file
 * Contains Drupal\predis\Database\Predis.
 */

namespace Drupal\predis\Database;

use Predis\Client;
use Drupal\predis\RedisConnectionInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Predis class to connect in Redis service.
 */
class Predis implements RedisConnectionInterface {

  /**
   * Connection to Redis service.
   *
   * @var \Predis\Client
   */
  private $redis;

  /**
   * The config factory to get the redis configuration
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  private $config_factory;

  /**
   * Predis class constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->config_factory = $config_factory;
  }

  /**
   * Create a new connection to Redis service.
   *
   * @param array $config
   *   Configuration settings.
   *
   * @return \Predis\Client
   */
  protected function makeRedisConnection(array $config) {
    $config += $this->defaultOptions();
    $this->redis = new Client($config);
    return $this->redis;
  }

  /**
   * Return the default options.
   *
   * @return array
   */
  protected function defaultOptions() {
    return array(
      'scheme' => 'tcp',
      'host' => '127.0.0.1',
      'port' => 6379,
      'database' => 0,
    );
  }

  /**
   * {@inheritdoc}
   */
  final public function getConnection() {
    if ($this->redis) {
      return $this->redis;
    }

    $settings = $this->config_factory->get('predis.settings');
    $config = $settings->get('connections');

    return $this->makeRedisConnection($config);
  }
}
