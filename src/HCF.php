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
  
  function setProvider(array $data): void
  {
    if (is_null($data) || $data === []) return;
    switch($data["type"]) {
      case "mysql":
        $this->database = libasynql::create($this, $data, [
          "mysql" => "mysql.sql"
        ]);
      case "sqlite":
        $this->database = libasynql::create($this, $data, [
          "sqlite" => "sqlite.sql"
        ]);
      case "json":
        $jsonFile = explode(".", $data["json"]["file"]);
        foreach($jsonFile as $folder => $fileName) {
          $this->database = new Config($this->getDataFolder() . $folder . DIRECTORY_SEPARATOR . $fileName . ".json", Config::JSON, []);
        }
      break;
    }
  }
  
  function getProvider(): Config|DataConnector
  {
    return $this->database;
  }
}