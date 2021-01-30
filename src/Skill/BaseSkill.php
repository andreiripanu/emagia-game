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
   * @var string
   */
  protected string $action;


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
   * @return $this
   */
  public function setValue(int $value): self
  {
    $this->value = $value;

    return $this;
  }

  /**
   * @return int
   */
  public function getValue(): int
  {
    return $this->value;
  }

  /**
   * @param string $action
   * @return $this
   */
  public function setAction(string $action): self
  {
    $this->action = $action;

    return $this;
  }

  /**
   * @return string
   */
  public function getAction(): string
  {
    return $this->action;
  }

  /**
   * @return bool
   */
  public function isUsed(): bool
  {
    return mt_rand(0, 100) <= $this->chance;
  }

  /**
   * @return string
   */
  public function getClassName(): string
  {
    return static::class;
  }
}
