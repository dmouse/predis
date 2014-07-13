<?php

/**
 * @file
 * Contains \Drupal\predis\RedisConnectionInterface.
 */

namespace Drupal\predis;

/**
 * Predis module interface.
 */
interface RedisConnectionInterface {

  /**
   * Return the active Redis connection.
   *
   * @return \Predis\Client
   *   Return the active connection to Redis service.
   */
  public function getConnection();
}
