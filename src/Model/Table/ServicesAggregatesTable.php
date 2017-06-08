<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ServicesAggregates Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Services
 *
 * @method \App\Model\Entity\ServicesAggregate get($primaryKey, $options = [])
 * @method \App\Model\Entity\ServicesAggregate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ServicesAggregate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ServicesAggregate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ServicesAggregate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ServicesAggregate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ServicesAggregate findOrCreate($search, callable $callback = null, $options = [])
 */
class ServicesAggregatesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('services_aggregates');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Services', [
            'foreignKey' => 'service_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('description');

        $validator
            ->decimal('price')
            ->allowEmpty('price');

        $validator
            ->boolean('status')
            ->allowEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['service_id'], 'Services'));

        return $rules;
    }
}
