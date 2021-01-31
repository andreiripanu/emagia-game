<?php

namespace Arcsym\Emagia\Creator;

use Arcsym\Emagia\Character\BaseCharacter;
use Arcsym\Emagia\Character\HeroCharacter;
use Arcsym\Emagia\Setting\SkillSetting;
use Arcsym\Emagia\Setting\StateSetting;

/*
 * Used to create hero characters.
 */
final class HeroCreator implements CreatorInterface
{
  /**
   * @return HeroCharacter
   */
  public static function creator(): BaseCharacter
  {
    $stats = (new StateSetting())->getHeroStats();
    $skills = (new SkillSetting())->getHeroSkills();
    $hero = new HeroCharacter();

    $hero
      ->setName('Orderus')
      ->setHealth(mt_rand($stats['health']['min'], $stats['health']['max']))
      ->setStrength(mt_rand($stats['strength']['min'], $stats['strength']['max']))
      ->setDefence(mt_rand($stats['defence']['min'], $stats['defence']['max']))
      ->setSpeed(mt_rand($stats['speed']['min'], $stats['speed']['max']))
      ->setLuck(mt_rand($stats['luck']['min'], $stats['luck']['max']))
    ;

    foreach ($skills as $skill) {
      $className = "\\Arcsym\Emagia\\Skill\\" . $skill['class_name'];
      $hero->addSkill((new $className())
        ->setName($skill['name'])
        ->setChance($skill['chance'])
        ->setValue($skill['value'])
        ->setAction($skill['action']))
      ;
    }

    return $hero;
  }
}
