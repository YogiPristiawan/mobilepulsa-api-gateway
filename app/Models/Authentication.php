<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class Authentication extends Model
{
	use UsesUuid;

	protected $table = 'authentication';
	protected $fillable = [
		'user_id',
		'token'
	];

	public $keyType = 'string';
	public $incrementing = false;
}
