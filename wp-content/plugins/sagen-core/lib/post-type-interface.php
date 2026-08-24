<?php

namespace SagenCore\Lib;

/**
 * interface PostTypeInterface
 * @package SagenCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}