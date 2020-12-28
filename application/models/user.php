<?php

// use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	// public static $table = 'users';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	// public static $timestamps = false;

	// Illuminate\Database\Eloquent\Model as Eloquent
	protected $fillable = ['username', 'email', 'password'];
}