<?php

namespace Arcsym\Emagia\Tests\Creator;

use Arcsym\Emagia\Character\HeroCharacter;
use Arcsym\Emagia\Creator\HeroCreator;
use PHPUnit\Framework\TestCase;

class HeroCreatorTest extends TestCase
{
  private object $hero;


  public function testCreator(): void
  {
    $this->hero = HeroCreator::creator();

    $this->assertIsObject($this->hero);
    $this->assertInstanceOf(HeroCharacter::class, $this->hero);
  }
}
