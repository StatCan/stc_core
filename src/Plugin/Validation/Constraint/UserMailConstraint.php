<?php

namespace Drupal\stc_core\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks that the submitted value is a unique integer.
 *
 * @Constraint(
 *   id = "UserMailConstraint",
 *   label = @Translation("Limit user mail addresses to StatCan addresses", context = "Validation"),
 *   type = {"entity"}
 * )
 */
class UserMailConstraint extends Constraint {
  /**
   * Constraint violation description.
   *
   * @var string
   */
  public $description = 'User mails must be either "@canada.ca" or  "@statcan.gc.ca".';

}
