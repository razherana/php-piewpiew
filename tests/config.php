<?php

// Ensure user or the framework developer configs this part

/**
 * Contains all config for views
 */
return [

  /**
   * Contains the folder of views
   */
  "folder" => __DIR__ . _ds_ . "views",

  /**
   * Contains the folder for compiled views
   */
  "compiled" => __DIR__ . _ds_ . "compiled",

  /**
   * Contains the map file for the compiled views
   */
  "map" => __DIR__ . _ds_ . "compiled" . _ds_ . "map",

  /**
   * Tells if we always compile in every request
   * Set to false in production
   */
  "always_compile" => true
];
