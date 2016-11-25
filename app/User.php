<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class User extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password'];

	protected $dates = ['birthday'];

	protected $fillable = [
		'username',
		'location',
		'first_name',
		'first_name',
		'email',
		'password',
		'gender',
		'birthday',
	];

	protected $guarded = ['role','online_status','chat_status','premium','system_verified'];

	public function scopeProviderId($query,$type)
	{
		return $query->where('provider_id', '=', $type);
	}

	public function scopeProvider($query,$type)
	{
		return $query->where('provider', '=', $type);
	}

	/**
	 *
	 * HELPER functions  to get various user name combinations
	 *
	 */
	// get full name
	public function getName()
	{
		if ($this->first_name && $this->last_name) {
			return "{$this->first_name} {$this->last_name}";
		}
		if ($this->first_name) {
			return $this->first_name;
		}
		return null;
	}

	public function getBirthdayAttribute($value)
	{
		return Carbon::parse($value)->format('m/d/Y');
	}


}
