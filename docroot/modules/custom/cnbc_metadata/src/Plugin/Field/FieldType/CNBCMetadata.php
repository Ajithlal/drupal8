<?php
/**
 * Created by PhpStorm.
 * User: ajithlal
 * Date: 9/25/18
 * Time: 1:26 PM
 */

namespace Drupal\cnbc_metadata\Plugin\Field\FieldType;


use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implmentation of cnbc metadata field.
 *
 * @FieldType (
 *    id = "cnbc_metadata",
 *    label = @Translation("CNBC Metadata"),
 *    description = @Translation("Store cnbc metdata fields"),
 *    default_widget = "cnbc_metadata",
 *    default_formatter = "cnbc_metadata"
 *   )
 */
class CNBCMetadata extends FieldItemBase {

/**
 * {@inheritdoc}
 */
public static function schema(FieldStorageDefinitionInterface $field_definition) {
  return array(
    'columns' => array(
      'body' => array(
        'type' => 'text',
        'size' => 'big',
      ),
      'description' => [
        'type' => 'varchar',
        'length' => 255,
      ],
      'first_published_title'=> [
        'type' => 'varchar',
        'length' => 255,
      ],
      'is_contemplate'=> [
        'type' => 'int',
        'length' => 'tiny',
      ],
      'is_parent'=> [
        'type' => 'int',
        'length' => 'tiny',
      ],
      'keywords'=> [
        'type' => 'varchar',
        'length' => 255,
      ],
      'link_headline'=> [
        'type' => 'varchar',
        'length' => 255,
      ],
      'long_description'=> [
        'type' => 'varchar',
        'length' => 2048,
      ],
      'notes'=> [
        'type' => 'varchar',
        'length' => 255,
      ],
      'short_description'=> [
        'type' => 'varchar',
        'length' => 255,
      ],
      'shorter_description'=> [
        'type' => 'varchar',
        'length' => 255,
      ],
      'shortest_description'=> [
        'type' => 'varchar',
        'length' => 255,
      ],
      'slug'=> [
        'type' => 'varchar',
        'length' => 255,
      ],
    )
  );
}

/**
 * {@inheritdoc}
 */
public function isEmpty() {
  $valueSlug = $this->get('slug')->getValue();
  return empty($valueSlug);
}

/**
 * {@inheritdoc}
 */
public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
  $properties['body'] = DataDefinition::create('string')
    ->setLabel(t('Slug'))
    ->setDescription(t('Slug'));

  $properties['description'] = DataDefinition::create('string')
    ->setLabel(t('Description'))
    ->setDescription(t('Description'));

  $properties['first_published_title'] = DataDefinition::create('string')
    ->setLabel(t('First Published Title'))
    ->setDescription(t('First Published Title'));

  $properties['is_contemplate'] = DataDefinition::create('boolean')
    ->setLabel(t('Is Contemplate'))
    ->setDescription(t('Is Contemplate'));

  $properties['is_parent'] = DataDefinition::create('boolean')
    ->setLabel(t('Is Parent'))
    ->setDescription(t('Is Parent'));

  $properties['keywords'] = DataDefinition::create('string')
    ->setLabel(t('Keywords'))
    ->setDescription(t('Keywords'));

  $properties['link_headline'] = DataDefinition::create('string')
    ->setLabel(t('Link Headline'))
    ->setDescription(t('Link Headline'));

  $properties['long_description'] = DataDefinition::create('string')
    ->setLabel(t('Long Description'))
    ->setDescription(t('Long Description'));

  $properties['notes'] = DataDefinition::create('string')
    ->setLabel(t('Notes'))
    ->setDescription(t('Notes'));

  $properties['short_description'] = DataDefinition::create('string')
    ->setLabel(t('Short Description'))
    ->setDescription(t('Short Description'));

  $properties['shorter_description'] = DataDefinition::create('string')
    ->setLabel(t('Shorter Description'))
    ->setDescription(t('Shorter Description'));

  $properties['shortest_description'] = DataDefinition::create('string')
    ->setLabel(t('Shortest Description'))
    ->setDescription(t('Shortest Description'));

  $properties['slug'] = DataDefinition::create('string')
    ->setLabel(t('Slug'))
    ->setDescription(t('Slug'));


  return $properties;
}

}