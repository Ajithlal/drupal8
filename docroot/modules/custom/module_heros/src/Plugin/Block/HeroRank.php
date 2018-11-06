<?php

namespace Drupal\module_heros\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'HeroRank' block.
 *
 * @Block(
 *  id = "hero_rank",
 *  admin_label = @Translation("Hero rank"),
 * )
 */
class HeroRank extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['hero_rank'] = [
      '#type' => 'table',
      '#caption' => $this->t('Our favorite colors.'),
      '#header' => [$this->t('Hero'), $this->t('Rank')],
      '#rows' => [
        [$this->t('Hulk'), $this->t('2')],
        [$this->t('Thor'), $this->t('3')],
        [$this->t('Iron man'), $this->t('5')],
        [$this->t('Super man'), $this->t('1')],
        [$this->t('Shakthi man'), $this->t('4')],
      ],
    ];

    return $build;
  }

}
