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
   */
  public function getConnection();
}
