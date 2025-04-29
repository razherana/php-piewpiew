<?php

namespace Piewpiew\view;

use Piewpiew\view\comm\ViewVars;
use Razherana\ConfigReader\ConfigurableElement;

class View extends ConfigurableElement
{
  /**
   * Contains all ViewVars instanciated with the key as the view's name
   * @var array<string, ViewVars> $view_vars
   */
  public static $view_vars = [];

  public function config_file(): string
  {
    // If user want to override the config file
    if (defined('PIEWPIEW_CONFIG'))
      return constant('PIEWPIEW_CONFIG');

    return PIEWPIEW_DIR . DIRECTORY_SEPARATOR . 'config';
  }
}
