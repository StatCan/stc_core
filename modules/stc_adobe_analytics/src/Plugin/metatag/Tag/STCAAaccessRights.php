<?php

namespace Drupal\stc_adobe_analytics\Plugin\metatag\Tag;

use Drupal\metatag\Plugin\metatag\Tag\MetaNameBase;

/**
 * The "STCAAaccessRights" meta tag.
 *
 * @MetatagTag(
 *   id = "stc_aa_accessRights",
 *   label = @Translation("Access Rights"),
 *   description = @Translation("Adobe Analytics access rights."),
 *   name = "dcterms:accessRights",
 *   group = "stc_adobe_analytics",
 *   weight = 1,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class STCAAaccessRights extends MetaNameBase {
}
