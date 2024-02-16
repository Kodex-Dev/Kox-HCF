<?php
declare(strict_types = 1);

namespace kodexdev\hcf;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\{
  TextFormat,
  SingletonTrait
};

/**
 * NOTE: Main class for the plugin to work
 */
final class HCF extends PluginBase
{
  use SingletonTrait;
  
  function onLoad(): void
  {
    self::setInstance($this);
  }
}