<?php

namespace Arcsym\Emagia\Tests\Character;

use Arcsym\Emagia\Character\HeroCharacter;
use Arcsym\Emagia\Skill\MagicShieldSkill;
use Arcsym\Emagia\Skill\RapidStrikeSkill;
use PHPUnit\Framework\TestCase;

class HeroCharacterTest extends TestCase
{
  private object $character;

  private array $skills = [];

  private array $stats = [
    'name' => 'Beast',
    'health' => 85,
    'strength' => 75,
    'defence' => 45,
    'speed' => 45,
    'luck' => 25,
  ];



  public function setUp(): void
  {
    $this->character = $this->getMockForAbstractClass(HeroCharacter::class);
    $this->character
      ->setName($this->stats['name'])
      ->setHealth($this->stats['health'])
      ->setStrength($this->stats['strength'])
      ->setDefence($this->stats['defence'])
      ->setSpeed($this->stats['speed'])
      ->setLuck($this->stats['luck'])
    ;

    $this->skills = [
      $this->getMockForAbstractClass(RapidStrikeSkill::class),
      $this->getMockForAbstractClass(MagicShieldSkill::class)
    ];

    foreach ($this->skills as $skill) {
      $this->character->addSkill($skill);
    }
  }

  public function testAllGetters()
  {
    $this->assertEquals($this->stats['name'], $this->character->getName());
    $this->assertEquals($this->stats['health'], $this->character->getHealth());
    $this->assertEquals($this->stats['strength'], $this->character->getStrength());
    $this->assertEquals($this->stats['defence'], $this->character->getDefence());
    $this->assertEquals($this->stats['speed'], $this->character->getSpeed());
    $this->assertEquals($this->stats['luck'], $this->character->getLuck());
    $this->assertCount(2, $this->character->getSkills());
  }

  public function testRemoveSkill()
  {
    $this->character->removeSkill($this->skills[0]);

    $this->assertCount(1, $this->character->getSkills());
  }
}
