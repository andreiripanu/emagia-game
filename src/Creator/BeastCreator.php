<?php

namespace Arcsym\Emagia\Creator;

use Arcsym\Emagia\Character\BaseCharacter;
use Arcsym\Emagia\Character\BeastCharacter;
use Arcsym\Emagia\Setting\StateSetting;

/*
 * Used to create beast characters.
 */
final class BeastCreator implements CreatorInterface
{
  /**
   * @return BeastCharacter
   */
  public static function creator(): BaseCharacter
  {
    $stats = (new StateSetting())->getBeastStats();
    $beast = new BeastCharacter();

    $beast
      ->setName('Big Beast')
      ->setHealth(mt_rand($stats['health']['min'], $stats['health']['max']))
      ->setStrength(mt_rand($stats['strength']['min'], $stats['strength']['max']))
      ->setDefence(mt_rand($stats['defence']['min'], $stats['defence']['max']))
      ->setSpeed(mt_rand($stats['speed']['min'], $stats['speed']['max']))
      ->setLuck(mt_rand($stats['luck']['min'], $stats['luck']['max']))
    ;

    return $beast;
  }
}
