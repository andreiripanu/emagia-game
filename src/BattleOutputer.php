<?php

namespace Arcsym\Emagia;

use Arcsym\Emagia\Character\BaseCharacter;
use Arcsym\Emagia\Setting\BattleSetting;

/*
 * Used to output simple messages and characters stats.
 */
class BattleOutputer
{
  /**
   * @var array
   */
  private array $battleSettings;


  /**
   * @param BattleSetting $battleSetting
   */
  public function __construct(BattleSetting $battleSetting)
  {
    $this->battleSettings = $battleSetting->getSettings();
  }

  /**
   * @param string $msg
   */
  public function output(string $msg): void
  {
    echo $msg . PHP_EOL;
    usleep($this->battleSettings['output_us']);
  }

  /**
   * @param BaseCharacter $character
   */
  public function characterStats(BaseCharacter $character): void
  {
    $msg = sprintf('Character %s has HEALTH: %s, STRENGTH: %s, DEFENCE: %s, SPEED: %s, LUCK: %s',
      $character->getName(),
      $character->getHealth(),
      $character->getStrength(),
      $character->getDefence(),
      $character->getSpeed(),
      $character->getLuck()
    );

    $this->output($msg);
  }
}
