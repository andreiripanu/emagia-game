<?php

namespace Arcsym\Emagia\Setting;

use Symfony\Component\Yaml\Yaml;

class BattleSetting
{
  /**
   * @var array|mixed
   */
  private array $settings = [];


  public function __construct()
  {
    $this->settings = Yaml::parseFile(dirname(__DIR__, 2) . '/config/battle.yaml');
  }

  /**
   * @return array
   */
  public function getSettings(): array
  {
    return $this->settings['battle'];
  }
}
