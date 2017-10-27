<?php

namespace Drupal\stc_core\Utility;

use Drupal\Component\Utility\UrlHelper;

class StcUrlHelper {

  /**
   * Perform a poors-man URL protocol absolute url validation.
   *
   * Implements a quick and dirty absolute url check since URlHelper::isValid
   * does not yet support protocol relative urls.
   * @see https://www.drupal.org/node/2691099
   */
  public static function isUrlProtocolValid($url) {
    $parts = parse_url($url);
    // Propagate missing URL parts.
    $parts += [
      'scheme' => '',
      'host' => '',
      'port' => '',
      'user' => '',
      'pass' => '',
      'path' => '',
      'query' => '',
      'fragment' => '',
    ];

    UrlHelper::setAllowedProtocols(['ftp', 'http', 'https', 'feed']);
    if (!in_array($parts['scheme'], UrlHelper::getAllowedProtocols())) {
      // Ensure the URL doesn't have relative protocol before disallowing.
      if (!(empty($parts['scheme']) && strpos($url, '//') === 0)) {
        return FALSE;
      }
    }
    return TRUE;
  }

}
