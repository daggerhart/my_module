<?php

namespace Drupal\my_module;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class ExodeListBuilder extends EntityListBuilder {
  public function buildHeader() {
    $header['title'] = $this->t('Title');
    $header['uid'] = $this->t('Owner');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    $row['title'] = $entity->label();
    $row['uid'] = $entity->getOwner()->label();
    return $row + parent::buildRow($entity);
  }
}
