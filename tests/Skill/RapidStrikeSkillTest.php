<?php

namespace Arcsym\Emagia\Tests\Skill;

use Arcsym\Emagia\Skill\RapidStrikeSkill;
use PHPUnit\Framework\TestCase;

class RapidStrikeSkillTest extends TestCase
{
  private object $skill;

  private array $values = [
    'name' => 'Magic',
    'value' => 2,
    'chance' => 30,
    'action' => 'attack'
  ];


  public function setUp(): void
  {
    $this->skill = $this->getMockForAbstractClass(RapidStrikeSkill::class);
    $this->skill
      ->setName($this->values['name'])
      ->setValue($this->values['value'])
      ->setChance($this->values['chance'])
      ->setAction($this->values['action'])
    ;
  }

  public function testAllGetters()
  {
    $this->assertEquals($this->values['name'], $this->skill->getName());
    $this->assertEquals($this->values['value'], $this->skill->getValue());
    $this->assertEquals($this->values['chance'], $this->skill->getChance());
    $this->assertEquals($this->values['action'], $this->skill->getAction());
  }

  public function testSpecialDamage()
  {
    $this->assertEquals(80, $this->skill->specialDamage(40));
  }

  public function testIsUsed()
  {
    $this->assertIsBool($this->skill->isUsed());
  }
}
