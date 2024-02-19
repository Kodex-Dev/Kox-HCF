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
  
  const CONFIG_VERSION = 0;
  
  const GAMEMODE_PLUGIN = "HardCore Factions";
  
  function onLoad(): void
  {
    self::setInstance($this);
    $this->saveDefaultConfig();
    \JackMD\UpdateNotifier\UpdateNotifier::checkUpdate($this->getDescription()->getName(), $this->getDescription()->getVersion());
    $this->getLogger()->info("Loading " . self::GAMEMODE_PLUGIN . " Plugin");
  }
  
  function onEnable(): void
  {
    if(!InvMenuHandler::isRegistered()) {
      InvMenuHandler::register($this);
    }
    if (\JackMD\ConfigUpdater\ConfigUpdater::checkUpdate($this, $this->getConfig(), "version", self::CONFIG_VERSION)) {
      $this->getLogger()->notice(TextFormat::GREEN . "Correct configuration version :)");
    }
    $this->getLogger()->notice(TextFormat::GREEN . "Plugin enabled!!");
  }
}