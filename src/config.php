<?php

// Ensure user or the framework developer configs this part
throw new Exception("Please configure Piewpiew before using it. 
Open the file " . __FILE__ . " and set the config values.");

// PIEWPIEW_DIR is the root directory of the framework
// It isn't required to be used, 
// it is better if you use another CONSTANT to define the main directory of your project

/**
 * Contains all config for views
 */
return [

  /**
   * Contains the folder of views
   */
  "folder" => "",

  /**
   * Contains the folder for compiled views
   */
  "compiled" => "",

  /**
   * Contains the map file for the compiled views
   */
  "map" => "",

  /**
   * Tells if we always compile in every request
   * Set to false in production
   */
  "always_compile" => true
];
