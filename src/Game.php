<?php

namespace Arcsym\Emagia;

class Game
{
  /**
   * @var Battle
   */
  private Battle $battle;


  /**
   * @param Battle $battle
   */
  public function __construct(Battle $battle)
  {
    $this->battle = $battle;
  }

  /**
   * Used to start the game.
   */
  public function start(): void
  {
    $this->battle->startBattle();

    while ($this->battle->nextTurn()) {
      $this->battle->playTurn();
    }

    $this->battle->endBattle();
  }
}
