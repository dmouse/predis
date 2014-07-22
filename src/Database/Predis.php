<?php

/**
 * @file
 * Contains Drupal\predis\Database\Predis.
 */

namespace Drupal\predis\Database;

use Predis\Client;
use Drupal\predis\RedisConnectionInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\Query\QueryFactory;

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
   * The config factory to get the redis configuration.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  private $configFactory;

  /**
   * The QueryFactory class to get configurations.
   *
   * @var QueryFactory
   */
  private $queryFactory;

  /**
   * Predis class constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory,
                              QueryFactory $query_factory) {
    $this->configFactory = $config_factory;
    $this->queryFactory = $query_factory;
  }

  /**
   * Create a new connection to Redis service.
   *
   * @param array $config
   *   Configuration settings.
   *
   * @return \Predis\Client
   *   Return a new connection to Redis service.
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
   *   Return a default values to connect on Redis service.
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
  final public function getConnection(string $connection) {
    $config = $this->getSettings($connection);
    return $this->makeRedisConnection($config);
  }

  /**
   * @param string $id
   *   The id connection.
   * @return mixed
   *   Return connection settings.
   */
  private function getSettings(string $id) {
    return $this->entityQuery->get('predis')
      ->condition('id', $id)
      ->execute();
  }
}
