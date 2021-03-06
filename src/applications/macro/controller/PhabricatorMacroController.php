<?php

abstract class PhabricatorMacroController
  extends PhabricatorController {

  protected function buildSideNavView($for_app = false, $has_search = false) {
    $nav = new AphrontSideNavFilterView();
    $nav->setBaseURI(new PhutilURI($this->getApplicationURI()));

    if ($for_app) {
      $nav->addLabel('Create');
      $nav->addFilter('', 'Create Macro', $this->getApplicationURI('/create/'));
    }

    $nav->addLabel('Macros');
    $nav->addFilter('/', 'All Macros');
    if ($has_search) {
      $nav->addFilter('search', 'Search', $this->getRequest()->getRequestURI());
    }


    return $nav;
  }

  public function buildApplicationMenu() {
    return $this->buildSideNavView($for_app = true)->getMenu();
  }

  protected function buildApplicationCrumbs() {
    $crumbs = parent::buildApplicationCrumbs();

    $crumbs->addAction(
      id(new PhabricatorMenuItemView())
        ->setName(pht('Create Macro'))
        ->setHref($this->getApplicationURI('/create/'))
        ->setIcon('create'));

    return $crumbs;
  }

}
