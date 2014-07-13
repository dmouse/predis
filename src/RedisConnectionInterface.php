<?php
/**
 * @file
 * Contains \Drupal\predis\RedisConnectionInterface.
 */

namespace Drupal\predis;

interface RedisConnectionInterface {

  /**
   * Return Redis connection
   * 
   * @return \Predis\Client
   */
  public function getConnection();

}
