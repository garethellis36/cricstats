<?php
namespace App\Model\Table;

use App\Model\Entity\DismissalMode;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DismissalModes Model
 *
 * @property \Cake\ORM\Association\HasMany $Matches
 */
class DismissalModesTable extends Table
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

        $this->table('dismissal_modes');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->hasMany('Matches', [
            'foreignKey' => 'dismissal_mode_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('not_out', 'valid', ['rule' => 'numeric'])
            ->requirePresence('not_out', 'create')
            ->notEmpty('not_out');

        return $validator;
    }
}
