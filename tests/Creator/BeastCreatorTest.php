<?php

namespace Arcsym\Emagia\Tests\Creator;

use Arcsym\Emagia\Character\HeroCharacter;
use Arcsym\Emagia\Creator\HeroCreator;
use PHPUnit\Framework\TestCase;

class BeastCreatorTest extends TestCase
{
  private object $beast;


  public function testCreator(): void
  {
    $this->beast = HeroCreator::creator();

    $this->assertIsObject($this->beast);
    $this->assertInstanceOf(HeroCharacter::class, $this->beast);
  }
}
