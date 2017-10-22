<?php

/**
 * Copyright (C) 2017 Spencer Mortensen
 *
 * This file is part of paths.
 *
 * Paths is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Paths is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with paths. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Spencer Mortensen <spencer@lens.guide>
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL-3.0
 * @copyright 2017 Spencer Mortensen
 */

namespace SpencerMortensen\Paths;

class Re
{
	/** @var string */
	private static $delimiter = "\x03";

	public static function match($expression, $input, &$output, $flags = '')
	{
		$pattern = self::$delimiter . $expression . self::$delimiter . $flags;

		if (preg_match($pattern, $input, $match) !== 1) {
			return false;
		}

		$output = $match;
		return true;
	}

	public static function split($expression, $input, $flags = '')
	{
		$pattern = self::$delimiter . $expression . self::$delimiter . $flags;

		$matches = preg_split($pattern, $input, null, PREG_SPLIT_OFFSET_CAPTURE);

		if (!is_array($matches)) {
			// TODO: throw exception
			return null;
		}

		return self::getChunks($matches);
	}

	private static function getChunks(array $matches)
	{
		$chunks = array();

		foreach ($matches as $match) {
			list($text, $position) = $match;

			if (strlen($text) === 0) {
				$text = null;
			}

			$chunks[$position] = $text;
		}

		return $chunks;
	}

	public static function quote($literal)
	{
		return preg_quote($literal, self::$delimiter);
	}
}
