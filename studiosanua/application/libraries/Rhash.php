<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rhash {
	/**
	 * Hash a password using the Bcrypt hashing scheme.
	 *
	 * <code>
	 *		// Create a Bcrypt hash of a value
	 *		$hash = Hash::make('secret');
	 *
	 *		// Use a specified number of iterations when creating the hash
	 *		$hash = Hash::make('secret', 12);
	 * </code>
	 *
	 * @param  string  $value
	 * @param  int     $rounds
	 * @return string
	 */
	public static function make($value, $rounds = 8) {
		$work = str_pad($rounds, 2, '0', STR_PAD_LEFT);

		// Bcrypt expects the salt to be 22 base64 encoded characters including
		// dots and slashes. We will get rid of the plus signs included in the
		// base64 data and replace them with dots.
		if (function_exists('openssl_random_pseudo_bytes')) {
			$salt = openssl_random_pseudo_bytes(16);
		}
		else {
			$salt = Str::random(40);
		}

		$salt = substr(strtr(base64_encode($salt), '+', '.'), 0 , 22);

		return crypt($value, '$2a$'. $work .'$'.$salt);
	}

	/**
	 * Determine if an unhashed value matches a Bcrypt hash.
	 *
	 * @param  string  $value
	 * @param  string  $hash
	 * @return bool
	 */
	public static function check($value, $hash) {
		return crypt($value, $hash) === $hash;
	}

	/**
	 * Validate hash function
	 *
	 * @param $hash string
	 * @param $length number
	 */
	public static function validate($hash, $length = 32) {
		if (strlen($hash) != $length || preg_match("/[^a-zA-Z0-9]+/", $hash)) {
			return false;
		}

		return true;
	}
}