<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Facebooks
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\HasMany $ForgotPassword
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id'
        ]);
        $this->hasMany('ForgotPassword', [
            'foreignKey' => 'user_id'
        ]);
    }
    
    /*
     * Antes de salvar as alteracoes
     */
    public function beforeSave(Event $event, Entity $entity){
    	if($entity->password == ''){
    		unset($entity->password);
    	}
    	else{
    		$entity->password = (new DefaultPasswordHasher)->hash($entity->password);
    	}
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
    		->allowEmpty('facebook_id');
    	
    	$validator
    		->notEmpty('name');
    	
    	$validator
	    	->email('email')
	    	->requirePresence('email', 'create')
	    	->notEmpty('email');
    	
    	$validator
    		->allowEmpty('cpf');
    	
    	$validator->add('cpf', 'custom', [
    			'rule' => 'validCpf',
    			'provider' => 'table',
    			'message' => 'CPF inválido'
    	]);
    	
    	$validator
	    	->requirePresence('password', 'custom', 'create')
	    	->notEmpty('password', 'custom', 'create');
    	
    	$validator->add('password', 'custom', [
    			'rule' => 'validPassword',
    			'provider' => 'table',
    			'message' => 'Senha deve conter no mínino 8 caracteres, contendo uma letra maiúscula, uma minúscula e um número'
    	]);
    	
    	$validator
    		->requirePresence('confirm_password', '', 'create')
    		->notEmpty('confirm_password', '', 'create');
    	
    	$validator
	    	->add('confirm_password',
    			'compareWith', [
    					'rule' => ['compareWith', 'password'],
    					'message' => 'Senha e Confirmação não conferem'
    			]);
    	
    	$validator
	    	->integer('role')
	    	->notEmpty('role');
    	
    	$validator
	    	->date('birth', 'dmy')
	    	->allowEmpty('birth');
    	
    	$validator
	    	->integer('status')
	    	->allowEmpty('status');
    	
    	return $validator;
    }
    
    // Funcao para validar password
    function validPassword($password) {
    	if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$', $password)){
    		return false;
    	}
    	else{
    		return true;
    	}
    	/*
    	 Explaining $\S*(?=\S{8,})(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$
    	 $ = beginning of string
    	 \S* = any set of characters
    	 (?=\S{8,}) = of at least length 8
    	 (?=\S*[A-Z]) = and at least one uppercase letter
    	 (?=\S*[\d]) = and at least one number
    	 $ = end of the string
    	 */
    }
    
    // Funcao para validar cpf
    function validCpf($cpf){
    	//Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cpf em diferentes formatos como "000.000.000-00", "00000000000", "000 000 000 00" etc...
    	$j=0;
    	for($i=0; $i<(strlen($cpf)); $i++)
    	{
    		if(is_numeric($cpf[$i]))
    		{
    			$num[$j]=$cpf[$i];
    			$j++;
    		}
    	}
    	//Etapa 2: Conta os dígitos, um cpf válido possui 11 dígitos numéricos.
    	if(count($num)!=11)
    	{
    		$isCpfValid=false;
    	}
    	//Etapa 3: Combinações como 00000000000 e 22222222222 embora não sejam cpfs reais resultariam em cpfs válidos após o calculo dos dígitos verificares e por isso precisam ser filtradas nesta parte.
    	else
    	{
    		for($i=0; $i<10; $i++)
    		{
    			if ($num[0]==$i && $num[1]==$i && $num[2]==$i && $num[3]==$i && $num[4]==$i && $num[5]==$i && $num[6]==$i && $num[7]==$i && $num[8]==$i)
    			{
    				$isCpfValid=false;
    				break;
    			}
    		}
    	}
    	//Etapa 4: Calcula e compara o primeiro dígito verificador.
    	if(!isset($isCpfValid))
    	{
    		$j=10;
    		for($i=0; $i<9; $i++)
    		{
    			$multiplica[$i]=$num[$i]*$j;
    			$j--;
    		}
    		$soma = array_sum($multiplica);
    		$resto = $soma%11;
    		if($resto<2)
    		{
    			$dg=0;
    		}
    		else
    		{
    			$dg=11-$resto;
    		}
    		if($dg!=$num[9])
    		{
    			$isCpfValid=false;
    		}
    	}
    	//Etapa 5: Calcula e compara o segundo dígito verificador.
    	if(!isset($isCpfValid))
    	{
    		$j=11;
    		for($i=0; $i<10; $i++)
    		{
    			$multiplica[$i]=$num[$i]*$j;
    			$j--;
    		}
    		$soma = array_sum($multiplica);
    		$resto = $soma%11;
    		if($resto<2)
    		{
    			$dg=0;
    		}
    		else
    		{
    			$dg=11-$resto;
    		}
    		if($dg!=$num[10])
    		{
    			$isCpfValid=false;
    		}
    		else
    		{
    			$isCpfValid=true;
    		}
    	}
    	
    	//Etapa 6: Retorna o Resultado em um valor booleano.
    	return $isCpfValid;
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['cpf']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
}
