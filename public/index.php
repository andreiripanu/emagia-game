<?php

use Arcsym\Emagia\Battle;
use Arcsym\Emagia\BattleOutputer;
use Arcsym\Emagia\Game;
use Arcsym\Emagia\Setting\BattleSetting;

require dirname(__DIR__) . '/vendor/autoload.php';

$battleSetting = new BattleSetting();
$battleOutputer = new BattleOutputer($battleSetting);
$battle = new Battle($battleSetting, $battleOutputer);

(new Game($battle))->start();
