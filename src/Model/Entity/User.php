<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $facebook_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $name
 * @property int $role_id
 * @property \Cake\I18n\Time $birth
 * @property string $cpf
 * @property string $rg
 * @property string $cep
 * @property string $address
 * @property string $number
 * @property string $complement
 * @property string $neighborhood
 * @property string $city
 * @property string $state
 * @property string $phone
 * @property string $cel
 * @property int $policy_privacy
 * @property int $agree_terms
 * @property int $email_recive
 * @property bool $status
 *
 * @property \App\Model\Entity\ForgotPassword[] $forgot_password
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
