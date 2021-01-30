<?php

namespace Arcsym\Emagia\Character;

/*
 * Base class for characters.
 */
abstract class BaseCharacter
{
  /**
   * @var string
   */
  protected string $name;

  /**
   * @var int
   */
  protected int $health;

  /**
   * @var int
   */
  protected int $strength;

  /**
   * @var int
   */
  protected int $defence;

  /**
   * @var int
   */
  protected int $speed;

  /**
   * @var int
   */
  protected int $luck;


  /**
   * @param string $name
   * @return $this
   */
  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @param int $health
   * @return $this
   */
  public function setHealth(int $health): self
  {
    $this->health = $health;

    return $this;
  }

  /**
   * @return int
   */
  public function getHealth(): int
  {
    return $this->health;
  }

  /**
   * @param int $strength
   * @return $this
   */
  public function setStrength(int $strength): self
  {
    $this->strength = $strength;

    return $this;
  }

  /**
   * @return int
   */
  public function getStrength(): int
  {
    return $this->strength;
  }

  /**
   * @param int $defence
   * @return $this
   */
  public function setDefence(int $defence): self
  {
    $this->defence = $defence;

    return $this;
  }

  /**
   * @return int
   */
  public function getDefence(): int
  {
    return $this->defence;
  }

  /**
   * @param int $speed
   * @return $this
   */
  public function setSpeed(int $speed): self
  {
    $this->speed = $speed;

    return $this;
  }

  /**
   * @return int
   */
  public function getSpeed(): int
  {
    return $this->speed;
  }

  /**
   * @param int $luck
   * @return $this
   */
  public function setLuck(int $luck): self
  {
    $this->luck = $luck;

    return $this;
  }

  /**
   * @return int
   */
  public function getLuck(): int
  {
    return $this->luck;
  }
}
