<?php

namespace Arcsym\Emagia;

use Arcsym\Emagia\Character\BaseCharacter;
use Arcsym\Emagia\Character\CharacterSkillInterface;
use Arcsym\Emagia\Creator\BeastCreator;
use Arcsym\Emagia\Creator\HeroCreator;
use Arcsym\Emagia\Setting\BattleSetting;
use Arcsym\Emagia\Skill\SkillDamageInterface;

class Battle
{
  private int $currentTurn = 1;

  private array $battleSettings;

  private BaseCharacter $attacker;

  private BaseCharacter $defender;


  public function __construct()
  {
    $this->battleSettings = (new BattleSetting())->getSettings();
  }

  public function startBattle(): void
  {
    $this->init();
  }

  private function init(): void
  {
    $this->addPlayers();
    $this->firstAttack();
  }

  private function addPlayers(): void
  {
    $this->attacker = HeroCreator::creator();
    $this->defender = BeastCreator::creator();
  }

  private function firstAttack(): void
  {
    switch (true) {
      case $this->attacker->getSpeed() < $this->defender->getSpeed():
        $this->switchRoles();
        break;
      case $this->attacker->getSpeed() == $this->defender->getSpeed():
        switch (true) {
          case $this->attacker->getLuck() < $this->defender->getLuck():
            $this->switchRoles();
            break;
          case $this->attacker->getLuck() == $this->defender->getLuck():
            if (mt_rand(1, 2) == 2) {
              $this->switchRoles();
            }
            break;
        }
        break;
    }
  }

  private function switchRoles(): void
  {
    $tmp = $this->defender;
    $this->defender = $this->attacker;
    $this->attacker = $tmp;
  }

  public function nextTurn(): bool
  {
    if ($this->attacker->getHealth() <= 0 || $this->defender->getHealth() <= 0)
      return false;

    if ($this->currentTurn > $this->battleSettings['nr_turns'])
      return false;

    $this->currentTurn++;

    return true;
  }

  public function startTurn(): void
  {
    $damage = $this->attacker->getStrength() - $this->defender->getDefence();
    $damage = $this->damageModifiedBySkill($damage, $this->attacker, 'attack');
    $damage = $this->damageModifiedBySkill($damage, $this->defender, 'defend');
    $this->defender->setHealth($this->defender->getHealth() - $damage);
  }

  private function damageModifiedBySkill(int $damage, BaseCharacter $character, string $action)
  {
    if($character instanceof CharacterSkillInterface) {
      foreach ($character->getSkills() as $skill) {
        if($skill instanceof SkillDamageInterface && $skill->getAction() == $action && $skill->isUsed()) {
          $damage = $skill->specialDamage($damage);
        }
      }
    }

    return $damage;
  }

  public function endTurn(): void
  {
    $this->switchRoles();
  }

  public function endBattle()
  {

  }
}
