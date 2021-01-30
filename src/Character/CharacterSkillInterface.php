<?php

namespace Arcsym\Emagia\Character;

use Arcsym\Emagia\Skill\BaseSkill;

/*
 * Interface for characters who get skills.
 */
interface CharacterSkillInterface
{
  /**
   * @return array
   */
  public function getSkills(): array;

  /**
   * @param BaseSkill $skill
   * @return $this
   */
  public function addSkill(BaseSkill $skill): self;

  /**
   * @param BaseSkill $skill
   * @return bool
   */
  public function removeSkill(BaseSkill $skill): bool;
}
