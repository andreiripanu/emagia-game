<?php

namespace Arcsym\Emagia;

class Game
{
  private Battle $battle;


  public function __construct()
  {
    $this->battle = new Battle();
  }

  public function run()
  {
    $this->battle->startBattle();

    while($this->battle->nextTurn()) {
      $this->battle->startTurn();
      $this->battle->endTurn();
    }

    $this->battle->endBattle();
  }
}
