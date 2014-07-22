<?php
/**
 * @file
 * Contains Drupal\predis\Controller\PredisSettingsListBuilder.
 */

namespace Drupal\predis\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of PredisSettings.
 */
class PredisSettingsListBuilder extends ConfigEntityListBuilder
{
  /**
   * {@inheritdoc}
   */
  public function buildHeader()
  {
    $header['label'] = $this->t('Connection');
    $header['id'] = $this->t('Machine name');
    $header['database'] = $this->t('Database');
    $header['host'] = $this->t('Host');
    return $header + parent::buildHeader();
  }

  /**
  * {@inheritdoc}
  */
  public function buildRow(EntityInterface $entity)
  {
    $row['label'] = $this->getLabel($entity);
    $row['id'] = $entity->id();
    $row['database'] = $entity->database();
    $row['host'] = $entity->host();

    return $row + parent::buildRow($entity);
  }
}
