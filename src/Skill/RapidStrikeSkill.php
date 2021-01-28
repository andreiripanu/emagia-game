<?php

namespace Arcsym\Emagia\Skill;

/*
 * This skill strikes twice while it’s his turn to attack.
 * Has a 10% chance for using on attack.
 */
class RapidStrikeSkill extends BaseSkill implements SkillDamageInterface
{
  /**
   * @param int $damage
   * @return int
   */
  public function specialDamage(int $damage): int
  {
    return $damage * $this->value;
  }
}
