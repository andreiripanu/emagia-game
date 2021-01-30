<?php

namespace Arcsym\Emagia\Setting;

use Symfony\Component\Yaml\Yaml;

class StateSetting
{
  /**
   * @var array|mixed
   */
  private array $stats = [];


  public function __construct()
  {
    $this->stats = Yaml::parseFile(dirname(__DIR__, 2) . '/config/stats.yaml');
  }

  /**
   * @return array
   */
  public function getHeroStats(): array
  {
    return $this->stats['stats']['hero'];
  }

  /**
   * @return array
   */
  public function getBeastStats(): array
  {
    return $this->stats['stats']['beast'];
  }
}
