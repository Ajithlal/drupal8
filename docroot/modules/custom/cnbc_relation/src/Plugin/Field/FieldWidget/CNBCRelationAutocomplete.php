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

    $widget['promoted'] = array(
      '#type' => 'checkbox',
      '#title' => $this->fieldDefinition->getSetting('prm_label'),
      '#default_value' => isset($items[$delta]) ? $items[$delta]->promoted : 1,
      '#weight' => 11,
    );
    $widget['hightouch'] = array(
      '#type' => 'checkbox',
      '#title' => $this->fieldDefinition->getSetting('hgh_label'),
      '#default_value' => isset($items[$delta]) ? $items[$delta]->hightouch : 1,
      '#weight' => 11,
    );
    return $widget;
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    $values = parent::massageFormValues($values, $form, $form_state);
    foreach ($values as $delta => $data) {
      if (empty($data['promoted'])) {
        unset($values[$delta]['promoted']);
      }
      if (empty($data['hightouch'])) {
        unset($values[$delta]['hightouch']);
      }
    }
    return $values;
  }
}
