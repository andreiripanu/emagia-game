<?php

namespace Arcsym\Emagia\Skill;

/*
 * Interface for that skills which have a special effect for damage.
 */
interface SkillDamageInterface
{
  /**
   * @param int $damage
   * @return int
   */
  public function specialDamage(int $damage): int;
}
