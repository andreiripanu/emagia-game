<?php

namespace Arcsym\Emagia\Skill;

/*
 * Base class for skills.
 */
abstract class BaseSkill
{
  /**
   * @var string
   */
  protected string $name;

  /**
   * @var int
   */
  protected int $chance;

  /**
   * @var int
   */
  protected int $value;


  /**
   * @param string $name
   * @return $this
   */
  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  /**
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @param int $chance
   * @return $this
   */
  public function setChance(int $chance): self
  {
    $this->chance = $chance;

    return $this;
  }

  /**
   * @return int
   */
  public function getChance(): int
  {
    return $this->chance;
  }

  /**
   * @param int $value
   */
  public function setValue(int $value)
  {
    $this->value = $value;
  }

  /**
   * @return int
   */
  public function getValue(): int
  {
    return $this->value;
  }

  /**
   * @return bool
   */
  public function isUsed(): bool
  {
    return mt_rand(0, 100) <= $this->chance;
  }
}
