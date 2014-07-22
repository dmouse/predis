<?php

/**
 * @file
 * Contains Drupal\predis\Entity\PredisSettings.
 */

namespace Drupal\predis\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\predis\PredisSettingsInterface;

/**
 * Defines the Predis Connection entity.
 *
 * @ConfigEntityType(
 *   id = "predis",
 *   label = @Translation("Predis Connection"),
 *   controllers = {
 *     "list_builder" = "Drupal\predis\Controller\PredisSettingsListBuilder",
 *     "form" = {
 *       "add" = "Drupal\predis\Form\PredisSettingsForm",
 *       "edit" = "Drupal\predis\Form\PredisSettingsForm",
 *       "delete" = "Drupal\predis\Form\PredisSettingsDeleteForm"
 *     }
 *   },
 *   config_prefix = "predis",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "edit-form" = "predis.edit",
 *     "delete-form" = "predis.delete"
 *   }
 * )
 */
class PredisSettings extends ConfigEntityBase implements PredisSettingsInterface
{
  /**
   * The PredisSettings ID.
   *
   * @var string
   */
  public $id;
  /**
   * The PredisSettings UUID.
   *
   * @var string
   */
  public $uuid;

  /**
   * The PredisSettings label.
   *
   * @var string
   */
  public $label;

  /**
   * Port definition.
   *
   * @var integer
   */
  public $port;

  /**
   * Schema definition.
   *
   * @var string
   */
  public $schema;

  /**
   * Host to connection.
   *
   * @var string
   */
  public $host;

  /**
   * The number database.
   *
   * @var int
   */
  public $database;

  /**
   * Return port.
   *
   * @return integer
   *  Port to connection.
   */
  public function port() {
    return $this->port;
  }

  /**
   * @return string
   *   Return the schema definition.
   */
  public function schema() {
    return $this->schema;
  }

  /**
   * @return string
   *   return the host definition.
   */
  public function host() {
    return $this->host;
  }

  /**
   * @return int
   *   Return the database definition.
   */
  public function database() {
    return $this->database;
  }
}
