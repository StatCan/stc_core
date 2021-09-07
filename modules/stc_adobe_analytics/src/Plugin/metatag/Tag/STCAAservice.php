<?php

namespace Drupal\stc_adobe_analytics\Plugin\metatag\Tag;

use Drupal\metatag\Plugin\metatag\Tag\MetaNameBase;

/**
 * The "STCAAservice" meta tag.
 *
 * @MetatagTag(
 *   id = "stc_aa_service",
 *   label = @Translation("Service"),
 *   description = @Translation("Adobe Analytics service."),
 *   name = "dcterms:service",
 *   group = "stc_adobe_analytics",
 *   weight = 0,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class STCAAservice extends MetaNameBase {
}
