<?php

namespace Drupal\cnbc_relation\Plugin\Field\FieldWidget;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\EntityReferenceAutocompleteWidget;

/**
 * @FieldWidget(
 *   id = "cnbc_relation_autocomplete",
 *   label = @Translation("Autocomplete"),
 *   description = @Translation("An autocomplete text field with associated data."),
 *   field_types = {
 *     "cnbc_relation"
 *   }
 * )
 */
class CNBCRelationAutocomplete extends EntityReferenceAutocompleteWidget {

  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $widget = array(
      '#attributes' => ['class' => ['form--inline', 'clearfix']],
      '#theme_wrappers' => ['container'],
    );
    $widget['target_id'] = parent::formElement($items, $delta, $element, $form, $form_state);
    $widget['quantity'] = array(
      '#type' => 'number',
      '#size' => '4',
      '#default_value' => isset($items[$delta]) ? $items[$delta]->quantity : 1,
      '#weight' => 10,
    );
    $widget['promoted'] = array(
      '#type' => 'checkbox',
      '#title' => $this->fieldDefinition->getSetting('prm_label'),
      '#default_value' => isset($items[$delta]) ? $items[$delta]->promoted : 1,
      '#weight' => 11,
    );

    if ($this->fieldDefinition->getFieldStorageDefinition()->isMultiple()) {
      $widget['quantity']['#placeholder'] = $this->fieldDefinition->getSetting('qty_label');
    }
    else {
      $widget['quantity']['#title'] = $this->fieldDefinition->getSetting('qty_label');
    }

    return $widget;
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    $values = parent::massageFormValues($values, $form, $form_state);
    foreach ($values as $delta => $data) {
      if (empty($data['quantity'])) {
        unset($values[$delta]['quantity']);
      }
      if (empty($data['promoted'])) {
        unset($values[$delta]['promoted']);
      }
    }
    return $values;
  }
}
