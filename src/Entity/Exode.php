<?php

namespace Drupal\my_module\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the Exode entity.
 *
 * @ContentEntityType(
 *   id = "exode",
 *   label = @Translation("Exode"),
 *   base_table = "exode",
 *   entity_keys = {
 *     "id" = "id",
 *     "uid" = "user_id",
 *     "created" = "created",
 *     "changed" = "changed",
 *     "bundle" = "type",
 *   },
 *   fieldable = TRUE,
 *   admin_permission = "administer exode types",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\my_module\ExodeListBuilder",
 *     "access" = "Drupal\my_module\ExodeEntityAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\Core\Entity\ContentEntityForm",
 *       "edit" = "Drupal\Core\Entity\ContentEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   links = {
 *     "canonical" = "/exode/{exode}",
 *     "add-page" = "/exode/add",
 *     "add-form" = "/exode/add/{exode_type}",
 *     "edit-form" = "/exode/{exode}/edit",
 *     "delete-form" = "/exode/{exode}/delete",
 *     "collection" = "/admin/content/exodes",
 *   },
 *   bundle_entity_type = "exode_type",
 *   field_ui_base_route = "entity.exode_type.edit_form",
 * )
 */
class Exode extends ContentEntityBase implements ExodeInterface {

  public function label(){
    return $this->get('title')->value;
  }

  public function getOwner(){
    return $this->get('uid')->entity;
  }

  public function getOwnerId() {
    return $this->get('uid')->target_id;
  }

  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  public function setOwnerId($uid) {
    $this->set('uid', $uid);
    return $this;
  }

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Exode entity.'))
      ->setReadOnly(TRUE);

    $fields['type'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Exode type'))
      ->setDescription(t('The exode type.'))
      ->setSetting('target_type', 'exode_type')
      ->setSetting('max_length', EntityTypeInterface::BUNDLE_MAX_LENGTH);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
      ]);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Owner'))
      ->setDescription(t('The user that owns this exode.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'entity_reference_label',
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time when the exode was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time when the exode was last edited.'));

    return $fields;
  }
}
