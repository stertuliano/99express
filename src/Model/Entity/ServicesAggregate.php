<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ServicesAggregate Entity
 *
 * @property int $id
 * @property int $service_id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property bool $status
 *
 * @property \App\Model\Entity\Service $service
 */
class ServicesAggregate extends Entity
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
}
