<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Evaluacion[] $evaluacions
 * @property Collection|Universidad[] $universidads
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasRoles;
	protected $table = 'users';

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'remember_token'
	];

	public function evaluacions()
	{
		return $this->hasMany(Evaluacion::class, 'use_id');
	}

	public function universidades()
	{
		return $this->belongsToMany(Universidad::class, 'user_has_universidads', 'use_id', 'uni_id');
	}

	/**
	 * Verifica si un usuario SedeR puede ser asignado a una nueva universidad
	 * Regla: Un SedeR solo puede tener UNA universidad asignada
	 */
	public function canAssignUniversidad(): bool
	{
		if (!$this->hasRole('SedeR')) {
			return true; // No es SedeR, puede tener múltiples universidades
		}
		return $this->universidades()->count() === 0;
	}

	/**
	 * Obtiene la universidad asignada al SedeR
	 * Retorna null si no tiene universidad asignada
	 */
	public function getSedeUniversidad(): ?Universidad
	{
		if (!$this->hasRole('SedeR')) {
			return null;
		}
		return $this->universidades()->first();
	}

	/**
	 * Asigna universidad a un SedeR validando la restricción
	 * @throws \Exception si el SedeR ya tiene una universidad
	 */
	public function assignUniversidadSede(Universidad $universidad): void
	{
		if ($this->hasRole('SedeR') && $this->universidades()->count() > 0) {
			throw new \Exception('Un SedeR solo puede tener una universidad asignada. Primero debe remover la actual.');
		}
		$this->universidades()->sync([$universidad->id]);
	}
	
}
