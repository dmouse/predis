<?php
/**
 * @file
 * Contains Drupal\predis\Form\PredisSettingsForm.
 */

namespace Drupal\predis\Form;

use Drupal\Core\Entity\EntityForm;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\Query\QueryFactory;

class PredisSettingsForm extends EntityForm
{
  /**
   * The entity query factory.
   *
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  protected $entityQuery;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Entity\Query\QueryFactory $entity_query
   *   The entity query.
   */
  public function __construct(QueryFactory $entity_query) {
    $this->entityQuery = $entity_query;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.query')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, array &$form_state)
  {
    $form = parent::form($form, $form_state);

    $predis = $this->entity;

    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#maxlength' => 255,
      '#default_value' => $predis->label(),
      '#description' => $this->t("Connection name."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $predis->id(),
      '#machine_name' => array(
        'exists' => array($this,'exist'),
      ),
      '#disabled' => !$predis->isNew(),
    );

    $form['schema'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Schema'),
      '#maxlength' => 255,
      '#default_value' => $predis->schema(),
      '#description' => $this->t("Schema connection (tcp,unix socket)"),
      '#required' => TRUE,
    );

    $form['host'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Host'),
      '#maxlength' => 255,
      '#default_value' => $predis->host(),
      '#description' => $this->t("Host direction"),
      '#required' => TRUE,
    );

    $form['port'] = array(
      '#type' => 'number',
      '#title' => $this->t('Port'),
      '#maxlength' => 255,
      '#default_value' => $predis->port(),
      '#description' => $this->t("Redis port"),
      '#required' => TRUE,
    );

    $form['database'] = array(
      '#type' => 'number',
      '#title' => $this->t('Database number'),
      '#maxlength' => 255,
      '#default_value' => $predis->database(),
      '#description' => $this->t("The database number."),
      '#required' => TRUE,
    );

    return $form;
  }

  /**
  * {@inheritdoc}
  */
  public function save(array $form, array &$form_state)
  {
    $predis = $this->entity;
    $status = $predis->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label PredisSettings.', array(
        '%label' => $predis->label(),
      )));
    }
    else {
      drupal_set_message($this->t('The %label PredisSettings was not saved.', array(
        '%label' => $predis->label(),
      )));
    }
    $form_state['redirect_route']['route_name'] = 'predis.list';
  }

  /**
   * Determines if connection exist.
   *
   * @param string $id
   *   The connection ID.
   *
   * @return bool
   *   TRUE if the connection exist.
   */
  public function exist($id) {
    $entity = $this->entityQuery->get('predis')
      ->condition('id', $id)
      ->execute();
    return (bool) $entity;
  }
}