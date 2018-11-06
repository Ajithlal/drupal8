<?php
/**
 * Created by PhpStorm.
 * User: ajithlal
 * Date: 9/25/18
 * Time: 2:15 PM
 */

namespace Drupal\cnbc_metadata\Plugin\Field\FieldFormatter;


use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'dice' formatter.
 *
 * @FieldFormatter (
 *   id = "cnbc_metadata",
 *   label = @Translation("CNBC Metadata"),
 *   field_types = {
 *     "cnbc_metadata"
 *   }
 * )
 */
class CNBCMetdataFormatter extends FormatterBase {
 public function viewElements(FieldItemListInterface $items, $langcode) {
   $elements = array();

   foreach ($items as $delta => $item) {
     if (!empty($item->slug)) {
       $markup = $item->slug;
     }
     if (!empty($item->link_headline)) {
       $markup .= $item->link_headline;
     }
     if (!empty($item->source_id)) {
       $markup .= $item->source_id;
     }

     $elements[$delta] = array(
       '#type' => 'markup',
       '#markup' => $markup,
     );
   }

   return $elements;
 }
}