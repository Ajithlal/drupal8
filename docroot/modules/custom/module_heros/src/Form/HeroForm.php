<?php

namespace Drupal\module_heros\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class HeroForm.
 */
class HeroForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hero_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['rival_1'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Rival 1'),
      '#weight' => '0',
    ];
    $form['rival_2'] = [
      '#type' => 'textfield',
      '#title' => $this->t('rival 2'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
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
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

  }

}
