<?php

namespace Drupal\my_module;

use Drupal\my_module\Entity\ExodeType;
use Drupal\Core\StringTranslation\StringTranslationTrait;

class ExodePermissions {

  use StringTranslationTrait;

  public function exodeTypePermissions() {
    $perms = [];
    foreach (ExodeType::loadMultiple() as $type) {
      $perms += $this->buildPermissions($type);
    }
    return $perms;
  }

  protected function buildPermissions(ExodeType $type) {
    $type_id = $type->id();
    $bundle_of = $type->getEntityType()->getBundleOf();
    $type_params = [
      '%type_name' => $type->label(),
      '%bundle_of' => $bundle_of,
    ];

    return [
      "create $bundle_of $type_id" => [
        'title' => $this->t('%type_name: Create new %bundle_of', $type_params),
      ],
      "view any $bundle_of $type_id" => [
        'title' => $this->t('%type_name: View any %bundle_of', $type_params),
      ],
      "view own $bundle_of $type_id" => [
        'title' => $this->t('%type_name: View own %bundle_of', $type_params),
      ],
      "edit any $bundle_of $type_id" => [
        'title' => $this->t('%type_name: Edit any %bundle_of', $type_params),
      ],
      "edit own $bundle_of $type_id" => [
        'title' => $this->t('%type_name: Edit own %bundle_of', $type_params),
      ],
      "delete any $bundle_of $type_id" => [
        'title' => $this->t('%type_name: Delete any %bundle_of', $type_params),
      ],
      "delete own $bundle_of $type_id" => [
        'title' => $this->t('%type_name: Delete own %bundle_of', $type_params),
      ],
    ];
  }
}
