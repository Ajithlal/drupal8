<?php

namespace Drupal\entity_collector\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\entity_collector\Service\EntityCollectionManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class EntityCollectionActionController extends EntityCollectionControllerBase implements ContainerInjectionInterface {

  /**
   * EntityCollectorApiController constructor.
   *
   * @param \Drupal\entity_collector\Service\EntityCollectionManagerInterface $entityCollectionManager
   *   The entity collection manager.
   * @param \Drupal\Core\Session\AccountInterface|\Drupal\Core\Session\AccountProxyInterface $currentUser
   *   The current user.
   * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
   *   The request stack.
   */
  public function __construct(EntityCollectionManagerInterface $entityCollectionManager, AccountProxyInterface $currentUser, RequestStack $requestStack) {
    $this->entityCollectionManager = $entityCollectionManager;
    $this->currentUser = $currentUser;
    $this->requestStack = $requestStack;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_collection.manager'),
      $container->get('current_user'),
      $container->get('request_stack')
    );
  }

  /**
   * Add entities to the collection.
   *
   * @param int $entityCollectionId
   * @param int $entityId
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Drupal\Core\Ajax\AjaxResponse
   *   The response.
   * @throws \Exception
   */
  public function addEntityToCollection($entityCollectionId, $entityId) {
    $request = $this->requestStack->getCurrentRequest();
    $response = new RedirectResponse($request->headers->get('referer'));
    $lockName = 'entity_collection_action_' . $entityCollectionId;
    $this->entityCollectionManager->acquireLock($lockName);

    try {
      $entityCollection = $this->entityCollectionManager->getEntityCollection($entityCollectionId);
      $this->entityCollectionManager->addEntityToCollection($entityCollection, $entityId);
      if ($request->isXmlHttpRequest()) {
        $response = new AjaxResponse();
        $selector = '.entity-collection-item-' . $entityId . '.entity-collection-type-' . $entityCollection->bundle();
        $response->addCommand(new InvokeCommand($selector . '.js-entity-collection-action-add', 'addClass', ['visually-hidden']));
        $response->addCommand(new InvokeCommand($selector . '.js-entity-collection-action-remove', 'removeClass', ['visually-hidden']));
        $response->addCommand(new InvokeCommand('body', 'trigger', [
          'addEntityToCollection',
          [$entityCollection->bundle(), $entityCollection->id(), $entityId],
        ]));
      }
    } finally {
      $this->entityCollectionManager->releaseLock($lockName);
    }

    return $response;
  }

  /**
   * Remove the entity from a collection.
   *
   * @param int $entityCollectionId
   * @param int $entityId
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Drupal\Core\Ajax\AjaxResponse
   *   The response.
   * @throws \Exception
   */
  public function removeEntityFromCollection($entityCollectionId, $entityId) {
    $request = $this->requestStack->getCurrentRequest();
    $response = new RedirectResponse($request->headers->get('referer'));
    $lockName = 'entity_collection_action_' . $entityCollectionId;
    $this->entityCollectionManager->acquireLock($lockName);
    try {
      $entityCollection = $this->entityCollectionManager->getEntityCollection($entityCollectionId);
      $this->entityCollectionManager->removeEntityFromCollection($entityCollection, $entityId);

      if ($request->isXmlHttpRequest()) {
        $response = new AjaxResponse();
        $selector = '.entity-collection-item-' . $entityId . '.entity-collection-type-' . $entityCollection->bundle();
        $response->addCommand(new InvokeCommand($selector . '.js-entity-collection-action-remove', 'addClass', ['visually-hidden']));
        $response->addCommand(new InvokeCommand($selector . '.js-entity-collection-action-add', 'removeClass', ['visually-hidden']));
        $response->addCommand(new InvokeCommand('body', 'trigger', [
          'removeEntityFromCollection',
          [$entityCollection->bundle(), $entityCollection->id(), $entityId],
        ]));
      }
    } finally {
      $this->entityCollectionManager->releaseLock($lockName);
    }

    return $response;
  }

}
