<?php

namespace Arcsym\Emagia\Character;

use Arcsym\Emagia\Skill\BaseSkill;

/*
 * Trait for characters who get skills.
 */
trait CharacterSkillTrait
{
  /**
   * @var array
   */
  protected array $skills = [];


  /**
   * @return array
   */
  public function getSkills(): array
  {
    return $this->skills;
  }

  /**
   * @param BaseSkill $skill
   * @return $this
   */
  public function addSkill(BaseSkill $skill): self
  {
    $this->skills[$skill->getClassName()] = $skill;

    return $this;
  }

  /**
   * @param BaseSkill $skill
   * @return bool
   */
  public function removeSkill(BaseSkill $skill): bool
  {
    $key = array_search($skill, $this->skills, true);

    if ($key === false) {
      return false;
    }

    unset($this->skills[$key]);

    return true;
  }
}
