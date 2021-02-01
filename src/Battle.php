<?php

namespace Arcsym\Emagia;

use Arcsym\Emagia\Action\AttackAction;
use Arcsym\Emagia\Action\DefenceAction;
use Arcsym\Emagia\Character\BaseCharacter;
use Arcsym\Emagia\Character\CharacterSkillInterface;
use Arcsym\Emagia\Creator\BeastCreator;
use Arcsym\Emagia\Creator\HeroCreator;
use Arcsym\Emagia\Setting\BattleSetting;
use Arcsym\Emagia\Skill\SkillDamageInterface;

class Battle
{
  /**
   * @var int
   */
  private int $currentTurn = 0;

  /**
   * @var array
   */
  private array $battleSettings;

  /**
   * @var BaseCharacter
   */
  private BaseCharacter $attacker;

  /**
   * @var BaseCharacter
   */
  private BaseCharacter $defender;

  private BattleOutputer $outputer;


  /**
   * Battle constructor.
   * @param BattleSetting $battleSetting
   * @param BattleOutputer $battleOutputer
   */
  public function __construct(BattleSetting $battleSetting, BattleOutputer $battleOutputer)
  {
    $this->battleSettings = $battleSetting->getSettings();
    $this->outputer = $battleOutputer;
  }

  /*
   * Start the battle.
   */
  public function startBattle(): void
  {
    $this->outputer->output('BATTLE START');
    $this->init();
  }

  /*
   * Battle initialization.
   * Adds players and decide who will be first attacker.
   */
  private function init(): void
  {
    $this->addPlayers();
    $this->firstAttack();
  }

  /*
   * Creates players of battle.
   */
  private function addPlayers(): void
  {
    $this->attacker = HeroCreator::creator();
    $this->defender = BeastCreator::creator();

    $this->outputer->output('Characters was created');
  }

  /*
   * Decide who attacks first.
   */
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

    $this->outputer->output(sprintf('First attacker will be: %s', $this->attacker->getName()));
  }

  /*
   * After turn end, characters change their roles.
   */
  private function switchRoles(): void
  {
    $tmp = $this->defender;
    $this->defender = $this->attacker;
    $this->attacker = $tmp;
  }

  /**
   * Checks if battle end, if another turn can be played.
   *
   * @return bool
   */
  public function nextTurn(): bool
  {
    $this->currentTurn++;

    if ($this->attacker->getHealth() <= 0 || $this->defender->getHealth() <= 0)
      return false;

    if ($this->currentTurn > $this->battleSettings['nr_turns'])
      return false;

    return true;
  }

  /*
   * Characters are fighting. Turn is playing.
   */
  public function playTurn(): void
  {
    $this->outputer->output(PHP_EOL);
    $this->outputer->output(sprintf('Characters stats before turn %d start', $this->currentTurn));
    $this->outputer->characterStats($this->attacker);
    $this->outputer->characterStats($this->defender);
    $this->outputer->output(sprintf('TURN %d - START', $this->currentTurn));

    $damage = $this->attacker->getStrength() - $this->defender->getDefence();
    $damage = $this->damageGeneratedBySkill($damage, $this->attacker, AttackAction::ACTION);
    $damage = $this->damageGeneratedBySkill($damage, $this->defender, DefenceAction::ACTION);

    $this->outputer->output(sprintf('Attacker: %s --> Defender: %s',
      $this->attacker->getName(),
      $this->defender->getName()
    ));
    $this->outputer->output(sprintf('After skill activation chance, %s attacks %s with a final damage of %d',
      $this->attacker->getName(),
      $this->defender->getName(),
      $damage
    ));

    $this->defender->setHealth(max($this->defender->getHealth() - $damage, 0));
    $this->outputer->output(sprintf('TURN %d - END', $this->currentTurn));
    $this->outputer->output(sprintf('Characters stats after turn %d end', $this->currentTurn));
    $this->outputer->characterStats($this->attacker);
    $this->outputer->characterStats($this->defender);
    $this->switchRoles();
  }

  /**
   * @param int $damage
   * @param BaseCharacter $character
   * @param string $action
   * @return int
   */
  private function damageGeneratedBySkill(int $damage, BaseCharacter $character, string $action): int
  {
    if($character instanceof CharacterSkillInterface) {
      foreach ($character->getSkills() as $skill) {
        if($skill instanceof SkillDamageInterface && $skill->getAction() == $action && $skill->isUsed()) {
          $damage = $skill->specialDamage($damage);

          switch ($action) {
            case $action == AttackAction::ACTION:
              $this->outputer->output(sprintf('%s is lucky. %s skill is activated for attack. Damage: %d',
                $character->getName(),
                $skill->getName(),
                $damage
              ));
              break;
            case $action == DefenceAction::ACTION:
              $this->outputer->output(sprintf('%s is lucky. %s skill is activated for defence. Damage: %d',
                $character->getName(),
                $skill->getName(),
                $damage
              ));
              break;
          }
        }
      }
    }

    return $damage;
  }

  /*
   * Battle end. Checks if a winner exists.
   */
  public function endBattle(): void
  {
    $this->outputer->output(PHP_EOL);
    $this->outputer->output('BATTLE END');
    $this->outputer->characterStats($this->attacker);
    $this->outputer->characterStats($this->defender);

    switch (true) {
      case $this->attacker->getHealth() <= 0:
        $this->outputer->output(sprintf('%s is the WINNER', $this->defender->getName()));
        break;
      case $this->defender->getHealth() <= 0:
        $this->outputer->output(sprintf('%s is the WINNER', $this->attacker->getName()));
        break;
      case $this->currentTurn > $this->battleSettings['nr_turns']:
        $this->outputer->output('NO WINNER');
        break;
    }
  }
}
