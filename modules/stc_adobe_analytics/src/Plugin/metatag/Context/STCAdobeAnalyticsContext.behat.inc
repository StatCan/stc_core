<?php

namespace Drupal\stc_metatag\Context;

use Behat\Mink\Exception\ExpectationException;
use Drupal\DrupalExtension\Context\DrupalSubContextBase;

class STCAdobeAnalyticsContext extends DrupalSubContextBase {

  /**
   * /**
   * Checks if a meta tag name and content exist.
   *
   * @param string $src
   *   The src value of the script tag.
   *
   * @throws Behat\Mink\Exception\ExpectationException
   *   If the editor does not contain the specified text.
   *
   * @Then I should see the script :script in the head
   */
  public function iShouldSeeTheScriptInTheHead($src) {
    $script = $this->getSession()->getPage()->find('css', 'head script[src="' . $src . '"]');

    if ($script) {
      return;
    }

    throw new ExpectationException(
      'Expected script with src ' . $src . ' not found!',
      $this->getSession()->getDriver()
    );
  }

  /**
   * /**
   * Checks if a meta tag name and content exist.
   *
   * @param string $src
   *   The src value of the script tag.
   *
   * @throws Behat\Mink\Exception\ExpectationException
   *   If the editor does not contain the specified text.
   *
   * @Then I should not see the script :script in the head
   */
  public function iShouldNotSeeTheScriptInTheHead($src) {
    $script = $this->getSession()->getPage()->find('css', 'head script[src="' . $src . '"]');

    if (!$script) {
      return;
    }

    throw new ExpectationException(
      'Script with src ' . $src . ' found, but should not have been!',
      $this->getSession()->getDriver()
    );
  }

}
