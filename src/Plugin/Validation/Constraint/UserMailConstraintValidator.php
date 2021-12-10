<?php

namespace Drupal\stc_core\Plugin\Validation\Constraint;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Checks that the submitted node isn't scheduled on a blocked day.
 */
class UserMailConstraintValidator extends ConstraintValidator implements ContainerInjectionInterface {

  /**
   * The Config Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Constructs an instance of the LinkAccessConstraintValidator class.
   *
   * @param \Drupal\Core\Config\ConfigFactory $configFactory
   *   The config factory.
   */
  public function __construct(ConfigFactory $configFactory) {
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function validate($entity, Constraint $constraint) {
    $check = $this->configFactory->get('stc_core.settings')->get('user_email_limit');
    if ($check !== TRUE) {
      return;
    }
    if (!isset($entity)) {
      return;
    }
    $type = $entity->getEntityTypeId();
    if ($entity->getEntityTypeId() != 'user') {
      return;
    }

    $email = $entity->getEmail();
    $email = explode('@', $email);
    if (!in_array($email[1], ['canada.ca', 'statcan.gc.ca'])) {
      $this->context->buildViolation($constraint->description)->atPath('email')->addViolation();
    }
  }

}
