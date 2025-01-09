<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Carburant
 * 
 * @property int $idCarburant
 * @property string $nomCarburant
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Carburant extends Model
{
	protected $table = 'carburant';
	protected $primaryKey = 'idCarburant';
	public $timestamps = false;

	protected $fillable = [
		'nomCarburant'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'idCarburant');
	}
}
