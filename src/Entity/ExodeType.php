<?php

namespace Drupal\my_module\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\Core\Entity\Annotation\ConfigEntityType;

/**
 * Class ExodeType
 *
 * @ConfigEntityType(
 *   id = "exode_type",
 *   label = @Translation("Exode type"),
 *   bundle_of = "exode",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "exode_type",
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   handlers = {
 *     "list_builder" = "Drupal\my_module\ExodeTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\my_module\Form\ExodeTypeForm",
 *       "add" = "Drupal\my_module\Form\ExodeTypeForm",
 *       "edit" = "Drupal\my_module\Form\ExodeTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer exode types",
 *   links = {
 *     "canonical" = "/admin/structure/exode_type/{exode_type}",
 *     "add-form" = "/admin/structure/exode_type/add",
 *     "edit-form" = "/admin/structure/exode_type/{exode_type}/edit",
 *     "delete-form" = "/admin/structure/exode_type/{exode_type}/delete",
 *     "collection" = "/admin/structure/exode_type",
 *   }
 * )
 */
class ExodeType extends ConfigEntityBundleBase implements ExodeTypeInterface {}
