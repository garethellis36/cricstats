<?php
namespace App\Model\Table;

use App\Model\Entity\Match;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Matches Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Clubs
 * @property \Cake\ORM\Association\BelongsTo $Teams
 * @property \Cake\ORM\Association\BelongsTo $Competitions
 * @property \Cake\ORM\Association\BelongsTo $Formats
 * @property \Cake\ORM\Association\BelongsTo $DismissalModes
 */
class MatchesTable extends Table
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

        $this->table('matches');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Clubs', [
            'foreignKey' => 'club_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Competitions', [
            'foreignKey' => 'competition_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Formats', [
            'foreignKey' => 'format_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DismissalModes', [
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
            ->requirePresence('season', 'create')
            ->notEmpty('season');

        $validator
            ->add('date', 'valid', ['rule' => 'date'])
            ->allowEmpty('date');

        $validator
            ->requirePresence('opposition', 'create')
            ->notEmpty('opposition');

        $validator
            ->add('batting_no', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('batting_no');

        $validator
            ->add('dnb', 'valid', ['rule' => 'numeric'])
            ->requirePresence('dnb', 'create')
            ->notEmpty('dnb');

        $validator
            ->add('batting_runs', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('batting_runs');

        $validator
            ->add('bowling_overs', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('bowling_overs');

        $validator
            ->add('bowling_maidens', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('bowling_maidens');

        $validator
            ->add('bowling_runs', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('bowling_runs');

        $validator
            ->add('bowling_wickets', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('bowling_wickets');

        $validator
            ->add('bowling_econ', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('bowling_econ');

        $validator
            ->requirePresence('notes', 'create')
            ->allowEmpty('notes');

        $validator
            ->requirePresence('venue', 'create')
            ->notEmpty('venue');

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
        $rules->add($rules->existsIn(['club_id'], 'Clubs'));
        $rules->add($rules->existsIn(['team_id'], 'Teams'));
        $rules->add($rules->existsIn(['competition_id'], 'Competitions'));
        $rules->add($rules->existsIn(['format_id'], 'Formats'));
        $rules->add($rules->existsIn(['dismissal_mode_id'], 'DismissalModes'));
        return $rules;
    }
}
