<?php

namespace Arcsym\Emagia\Creator;

use Arcsym\Emagia\Character\BaseCharacter;

/*
 * An interface for characters creator.
 */
interface CreatorInterface
{
  /**
   * @return BaseCharacter
   */
  public static function creator(): BaseCharacter;
}
