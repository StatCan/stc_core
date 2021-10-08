<?php

namespace Drupal\stc_core\Commands;

use Drush\Commands\DrushCommands;
use Symfony\Component\Yaml\Parser;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 */
class StcCoreCommands extends DrushCommands {

  /**
   * Command description here.
   *
   * @param $path
   *   Configuration path
   * @usage stc_core-import-language-config path
   *   Import the language config found in the configuration directory at provided path.
   *
   * @command stc_core:importLanguageConfig
   */
  public function importLanguageConfig($path) {
    $language_manager = \Drupal::languageManager();
    $yaml_parser = new Parser();

    // The language code of the default locale.
    $site_default_langcode = $language_manager->getDefaultLanguage()->getId();
    // The directory where the language config files reside.
    $language_config_directory = DRUPAL_ROOT . '/' . $path . '/install/language';
    if (!is_dir($language_config_directory)) {
      $this->output()->writeln('Directory not found: ' . $language_config_directory);
      return;
    }
    // Sub-directory names (language codes).
    // The language code of the default language is excluded. If the user
    // chooses to install in French etc, the language config is imported by core
    // and the user has the chance to override it during the installation.
    $langcodes = array_diff(scandir($language_config_directory),
        ['..', '.', $site_default_langcode]);

    foreach ($langcodes as $langcode) {
      // All .yml files in the language's config subdirectory.
      $config_files = glob("$language_config_directory/$langcode/*.yml");

      foreach ($config_files as $file_name) {
        // Information from the .yml file as an array.
        $yaml = $yaml_parser->parse(file_get_contents($file_name));
        if (!$yaml) {
          $this->output()->writeln('Skipping ' . $file_name);
          continue;
        }
        $this->output()->writeln('Importing ' . $file_name);
        // Uses the base name of the .yml file to get the config name.
        $config_name = basename($file_name, '.yml');

        /** @var \Drupal\language\ConfigurableLanguageManager $language_manager */
        $config = $language_manager->getLanguageConfigOverride($langcode, $config_name);

        foreach ($yaml as $config_key => $config_value) {
          // Updates the configuration object.
          $config->set($config_key, $config_value);
        }

        // Saves the configuration.
        $config->save();
      }
    }

  }

}
