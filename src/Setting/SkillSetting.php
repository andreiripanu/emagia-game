<?php

namespace Arcsym\Emagia\Setting;

use Symfony\Component\Yaml\Yaml;

class SkillSetting
{
  /**
   * @var array|mixed
   */
  private array $skills = [];


  public function __construct()
  {
    $this->skills = Yaml::parseFile(dirname(__DIR__, 2) . '/config/skills.yaml');
  }

  /**
   * @return array
   */
  public function getHeroSkills(): array
  {
    return $this->skills['skills']['hero'];
  }
}
