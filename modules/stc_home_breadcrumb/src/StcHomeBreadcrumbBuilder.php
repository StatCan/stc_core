<?php

namespace Drupal\stc_home_breadcrumb;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;
use Drupal\system\PathBasedBreadcrumbBuilder;

/**
 * Provides a breadcrumb builder for the confirmation page.
 */
class StcHomeBreadcrumbBuilder extends PathBasedBreadcrumbBuilder {

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $breadcrumbs = parent::build($route_match);

    $route = $route_match->getRouteObject();
    // Do not adjust the breadcrumbs on admin paths.
    if ($route && !$route->getOption('_admin_route')) {
      $links = $breadcrumbs->getLinks();
      if (isset($links[0])) {
        $links[0]->setUrl(Url::fromUri($this->t('//www.statcan.gc.ca/eng/start')));
      }
    }

    return $breadcrumbs;
  }

}
