<?php

namespace Arcsym\Emagia\Skill;

/*
 * This skill takes only half of the usual damage when an enemy attacks.
 * Has a 20% chance for using on defend.
 */
class MagicShieldSkill extends BaseSkill implements SkillDamageInterface
{
  /**
   * @param int $damage
   * @return int
   */
  public function specialDamage(int $damage): int
  {
    return $damage / $this->value;
  }
}
