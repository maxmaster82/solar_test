<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function replies()
	{
		return $this->hasMany('App\Comment', 'parent');
	}

	/**
	 * @return bool|null|void
	 */
	public function delete() {
		$this->replies()->delete();
		parent::delete();
	}
}
