/**
 * @file entity collection field behavior.
 *
 */
(function ($, Drupal) {

  "use strict";

  Drupal.behaviors.entityCollectionfieldBehavior = {
    attach: function (context, settings) {
      $('body').once('entityCollectionTriggers')
          .on('activatedEntityCollection', Drupal.behaviors.entityCollectionfieldBehavior.collectionActivation)
          .on('addEntityToCollection', Drupal.behaviors.entityCollectionfieldBehavior.refreshCollectionBlocks)
          .on('removeEntityFromCollection', Drupal.behaviors.entityCollectionfieldBehavior.removeItem);
    },
    collectionActivation: function(event, entityCollectionBundle, entityCollectionId) {
      Drupal.behaviors.entityCollectionfieldBehavior.refreshCollectionBlocks(event, entityCollectionBundle, entityCollectionId);
      Drupal.behaviors.entityCollectionfieldBehavior.refreshAllCollectionActions(event, entityCollectionBundle);
    },
    refreshCollectionBlocks: function (event, entityCollectionBundle, entityCollectionId) {
      $('.js-entity-collection-block').each(function () {
        var $collectionBlock = $(this);
        if ($collectionBlock.attr('data-entity-collection-type') === entityCollectionBundle) {
          var element_settings = {};
          element_settings.progress = {type: 'throbber'};
          element_settings.url = '/ajax/entity-collector/block/' + $collectionBlock.attr('data-block-id');
          element_settings.base = $collectionBlock.attr('id');
          element_settings.element = this;
          Drupal.ajax(element_settings).execute();
        }
      });
    },
    refreshAllCollectionActions: function (event, entityCollectionBundle) {
      var removeSelector = '.js-entity-collection-action-remove.entity-collection-type-' + entityCollectionBundle;
      var addSelector = '.js-entity-collection-action-add.entity-collection-type-' + entityCollectionBundle;

      $(removeSelector + ',' + addSelector).each(Drupal.behaviors.entityCollectionfieldBehavior.refreshCollectionAction);
    },
    refreshCollectionAction: function () {
      var element = $(this);
      var baseurl = element.attr("data-base-url");
      var entityId = element.attr("data-entity");
      var entityCollection = element.attr("data-entity-collection");
      var href = baseurl + '/' + entityCollection + '/' + entityId;
      var id = '#' + element.attr('id');
      element.attr("href", href);

      for (var indexInstance in Drupal.ajax.instances) {
        var instance = Drupal.ajax.instances[indexInstance];
        if (instance === null || instance === undefined || instance.selector === null || instance.selector !== id) {
          continue;
        }

        instance.options.url = href;
        break;
      }

    },
    removeItem: function (event, entityCollectionBundle, entityCollectionId, entityId) {
      $('.js-entity-collection-items').each(function () {
        var $collectionItems = $(this);
        if ($collectionItems.attr('data-entity-collection-type') === entityCollectionBundle && $collectionItems.attr('data-entity-collection') === entityCollectionId) {
          $('.js-entity-collection-item', $collectionItems).each(function() {
            var $collectionItem = $(this);
            if($collectionItem.attr('data-entity-id') === entityId) {
              $collectionItem.remove();
            }
          });
        }
        $collectionItems.trigger('entityCollectionFieldItemsUpdated');
      });
    }
  };

})(jQuery, Drupal);
