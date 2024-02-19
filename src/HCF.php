<?php
declare(strict_types = 1);

namespace kodexdev\hcf;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\{
  Config,
  TextFormat,
  SingletonTrait
};

use poggit\libasynql\{
  libasynql,
  DataConnector
};

use muqsit\invmenu\InvMenuHandler;

/**
 * NOTE: Main class for the plugin to work
 */
final class HCF extends PluginBase
{
  use SingletonTrait;
  
  function onLoad(): void
  {
    if(!InvMenuHandler::isRegistered()) {
      InvMenuHandler::register($this);
    }
    self::setInstance($this);
    $this->saveDefaultConfig();
  }

}