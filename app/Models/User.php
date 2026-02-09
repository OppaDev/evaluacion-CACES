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
 * @property Collection|Universidad[] $sedesResponsable
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
	 * Sedes de las que el usuario es responsable
	 */
	public function sedesResponsable()
	{
		return $this->hasMany(Universidad::class, 'responsable_id');
	}

	/**
	 * Verificar si el usuario es responsable de alguna sede
	 */
	public function esResponsableSede(): bool
	{
		return $this->sedesResponsable()->exists();
	}

	/**
	 * Verificar si el usuario es responsable de una sede específica
	 */
	public function esResponsableDeSede($uni_id): bool
	{
		return $this->sedesResponsable()->where('id', $uni_id)->exists();
	}
	
}
