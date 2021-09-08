<?php

namespace Drupal\stc_adobe_analytics\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigurationForm extends ConfigFormBase {

  protected function getEditableConfigNames() {
    return ['stc_adobe_analytics.config'];
  }

  public function getFormId() {
    return 'stc_adobe_analytics_configuration_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('stc_adobe_analytics.config');

    $form['asset_host'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Asset host'),
      '#description' => $this->t('Fully Qualified Domain Name (FQDN) where the asset is hoted (ie: assets.adobetm.com).'),
      '#default_value' => $config->get('asset_host') ? $config->get('asset_host') : 'assets.adobetm.com',
      '#size' => 125,
    ];

    $form['asset_path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Asset path'),
      '#description' => $this->t('Path to your specific Adobe Analytics JavaScript (do not include the leading //assets.adobedtm.com/)'),
      '#default_value' => $config->get('asset_path'),
      '#size' => 125,
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $conf = $this->config('stc_adobe_analytics.config');
    $conf->set('asset_host', $form_state->getValue('asset_host', ''));
    $conf->set('asset_path', $form_state->getValue('asset_path', ''));
    $conf->save();
  }

}
