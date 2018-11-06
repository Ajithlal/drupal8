<?php

namespace Drupal\module_heros;

use Drupal\Core\Entity\EntityManager;
use Drupal\Core\Entity\Query\QueryFactory;

/**
 * Class HeroDetailService.
 */
class HeroDetailService {
  private $entityQuery;
  private $entityManager;
  /**
   * Constructs a new HeroDetailService object.
   */
  public function __construct(QueryFactory $entityQuery, EntityManager $entityManager) {
    $this->entityQuery = $entityQuery;
    $this->entityManager = $entityManager;
  }
  public function getHeroDetails() {
    $articleNids = $this->entityQuery->get('node')->condition('type', 'article')->execute();

    return $this->entityManager->getStorage('node')->loadMultiple($articleNids);
  }
}
