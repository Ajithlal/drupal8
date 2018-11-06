<?php

namespace Drupal\module_heros\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class HeroConfigForm.
 */
class HeroConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'module_heros.heroconfig',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hero_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('module_heros.heroconfig');
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('title'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('title'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('module_heros.heroconfig')
      ->set('title', $form_state->getValue('title'))
      ->save();
  }

}
