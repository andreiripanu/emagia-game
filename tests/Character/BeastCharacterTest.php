<?php

namespace Arcsym\Emagia\Tests\Character;

use Arcsym\Emagia\Character\BeastCharacter;
use PHPUnit\Framework\TestCase;

class BeastCharacterTest extends TestCase
{
  private object $character;

  private array $stats = [
    'name' => 'Beast',
    'health' => 90,
    'strength' => 80,
    'defence' => 50,
    'speed' => 50,
    'luck' => 30,
  ];



  public function setUp(): void
  {
    $this->character = $this->getMockForAbstractClass(BeastCharacter::class);
    $this->character
      ->setName($this->stats['name'])
      ->setHealth($this->stats['health'])
      ->setStrength($this->stats['strength'])
      ->setDefence($this->stats['defence'])
      ->setSpeed($this->stats['speed'])
      ->setLuck($this->stats['luck'])
    ;
  }

  public function testAllGetters()
  {
    $this->assertEquals($this->stats['name'], $this->character->getName());
    $this->assertEquals($this->stats['health'], $this->character->getHealth());
    $this->assertEquals($this->stats['strength'], $this->character->getStrength());
    $this->assertEquals($this->stats['defence'], $this->character->getDefence());
    $this->assertEquals($this->stats['speed'], $this->character->getSpeed());
    $this->assertEquals($this->stats['luck'], $this->character->getLuck());
  }
}
