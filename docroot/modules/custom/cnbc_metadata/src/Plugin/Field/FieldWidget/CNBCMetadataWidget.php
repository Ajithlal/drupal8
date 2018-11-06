<?php
/**
 * Created by PhpStorm.
 * User: ajithlal
 * Date: 9/25/18
 * Time: 1:53 PM
 */

namespace Drupal\cnbc_metadata\Plugin\Field\FieldWidget;


use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'cncb_metadata' widget.
 *
 * @FieldWidget (
 *   id = "cnbc_metadata",
 *   label = @Translation("CNBC Metadata widget"),
 *   field_types = {
 *     "cnbc_metadata"
 *   }
 * )
 */
class CNBCMetadataWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['body'] = array(
      '#type' => 'textarea',
      '#title' => t('Body'),
      '#default_value' => isset($items[$delta]->body) ? $items[$delta]->body : '',
      '#size' => 100,
    );
    $element['description'] = array(
      '#type' => 'textfield',
      '#title' => t('Description'),
      '#default_value' => isset($items[$delta]->description) ? $items[$delta]->description : '',
      '#size' => 100,
    );

    $element['first_published_title'] = array(
      '#type' => 'textfield',
      '#title' => t('First Published Title'),
      '#default_value' => isset($items[$delta]->first_published_title) ? $items[$delta]->first_published_title : '',
      '#size' => 100,
    );
    $element['is_contemplate'] = array(
      '#type' => 'checkbox',
      '#title' => t('Is Contemplate'),
      '#default_value' => isset($items[$delta]->is_contemplate) ? $items[$delta]->is_contemplate : '',
      '#size' => 100,
    );
    $element['is_parent'] = array(
      '#type' => 'checkbox',
      '#title' => t('Is Parent'),
      '#default_value' => isset($items[$delta]->is_parent) ? $items[$delta]->is_parent : 0,
      '#size' => 3,
    );

    $element['link_headline'] = array(
      '#type' => 'textfield',
      '#title' => t('Link Headline'),
      '#default_value' => isset($items[$delta]->link_headline) ? $items[$delta]->link_headline : '',
      '#size' => 100,
    );
    $element['notes'] = array(
      '#type' => 'textfield',
      '#title' => t('Notes'),
      '#default_value' => isset($items[$delta]->notes) ? $items[$delta]->notes : 0,
      '#size' => 255,
    );
    $element['long_description'] = array(
      '#type' => 'textfield',
      '#title' => t('Long Description'),
      '#default_value' => isset($items[$delta]->long_description) ? $items[$delta]->long_description : 0,
      '#size' => 255,
    );
    $element['short_description'] = array(
      '#type' => 'textfield',
      '#title' => t('Short Description'),
      '#default_value' => isset($items[$delta]->short_description) ? $items[$delta]->short_description : '',
      '#size' => 255,
    );
    $element['shorter_description'] = array(
      '#type' => 'textfield',
      '#title' => t('Shorter Description'),
      '#default_value' => isset($items[$delta]->shorter_description) ? $items[$delta]->shorter_description : '',
      '#size' => 255,
    );

    $element['shortest_description'] = array(
      '#type' => 'textfield',
      '#title' => t('Shortest Description'),
      '#default_value' => isset($items[$delta]->shortest_description) ? $items[$delta]->shortest_description : '',
      '#size' => 255,
    );
    $element['slug'] = array(
      '#type' => 'textfield',
      '#title' => t('Slug'),
      '#default_value' => isset($items[$delta]->slug) ? $items[$delta]->slug : '',
      '#size' => 255,
    );

    return $element;
  }
}