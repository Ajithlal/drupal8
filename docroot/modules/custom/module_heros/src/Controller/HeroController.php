<?php

namespace Drupal\module_heros\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\module_heros\HeroDetailService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;

/**
 * This is our hero controller.
 */
class HeroController extends ControllerBase{
  private $articleHeroService;
  protected $configFactory;
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('module_heros.hero_details'),
      $container->get('config.factory')
    );
  }

  public function __construct(HeroDetailService $articleHeroService, ConfigFactory $configFactory) {
    $this->articleHeroService = $articleHeroService;
    $this->configFactory= $configFactory;
  }

  public function heroList() {
    $heroes = [
      ['name' => 'Hulk'],
      ['name' => 'Thor'],
      ['name' => 'Iron Man'],
      ['name' => 'Luke Cage'],
      ['name' => 'Black Widow'],
      ['name' => 'Daredevil'],
      ['name' => 'Captain America'],
      ['name' => 'Wolverine']
    ];


      return [
          '#theme' => 'hero_list',
          '#items' => $heroes,
        '#title' => $this->configFactory->get('module_heros.heroconfig')->get('title'),
      ];

  }
    public function heroInfo() {

        $heroes = [
            ['name' => 'Hulk'],
        ];

        $ourHeroes = '';
        foreach ($heroes as $hero) {
            $ourHeroes .= '<li>' . $hero['name'] . '</li>';
        }

        return [
            '#theme' => 'hero_list',
            '#items' => $heroes,
            '#title' => $this->configFactory->get('module_heros.heroconfig')->get('title'),
        ];
    }
}
