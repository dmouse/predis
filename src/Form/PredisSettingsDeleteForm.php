<?php
/**
 * @file
 * Contains Drupal\predis\Form\PredisSettingsDeleteForm.
 */

namespace Drupal\predis\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Url;

/**
 * Builds the form to delete a PredisSettings.
 */
class PredisSettingsDeleteForm extends EntityConfirmFormBase
{

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete %name?', array('%name' => $this->entity->label()));
  }

  /**
  * {@inheritdoc}
  */
  public function getCancelRoute()
  {
    return new Url('predis.list');
  }

  /**
  * {@inheritdoc}
  */
  public function getConfirmText()
  {
    return $this->t('Delete');
  }

  /**
  * {@inheritdoc}
  */
  public function submit(array $form, array &$form_state)
  {
    $this->entity->delete();
    drupal_set_message($this->t('Category %label has been deleted.', array('%label' => $this->entity->label())));
    $form_state['redirect_route'] = $this->getCancelRoute();
  }
}
