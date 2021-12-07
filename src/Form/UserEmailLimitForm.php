<?php

namespace Drupal\stc_core\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure STC Core settings for this site.
 */
class UserEmailLimitForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'stc_core_user_email_limit';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['stc_core.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['user_email_limit'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Limit user email addresses to "@canada.ca" and "@statcan.gc.ca".'),
      '#default_value' => $this->config('stc_core.settings')->get('user_email_limit'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('stc_core.settings')
      ->set('user_email_limit', (bool) $form_state->getValue('user_email_limit'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
