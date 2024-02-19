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

/**
 * NOTE: Main class for the plugin to work
 */
final class HCF extends PluginBase
{
  use SingletonTrait;
  
  /** @var DataConnector $database **/
  private Config|DataConnector $database;
  
  function onLoad(): void
  {
    self::setInstance($this);
    $this->saveDefaultConfig();
    $this->setProvider($this->getConfig()->get("database"));
  }

}