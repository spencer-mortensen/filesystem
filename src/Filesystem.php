<?php

/**
 * Copyright (C) 2018 Spencer Mortensen
 *
 * This file is part of Filesystem.
 *
 * Filesystem is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Filesystem is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with Filesystem. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Spencer Mortensen <spencer@lens.guide>
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL-3.0
 * @copyright 2018 Spencer Mortensen
 */

namespace SpencerMortensen\Filesystem;

use SpencerMortensen\Exceptions\ErrorHandling;

class Filesystem
{
	/**
	 * @return Path
	 * @throws ResultException
	 */
	public function getCurrentDirectoryPath()
	{
		try {
			ErrorHandling::on();
			$cwd = getcwd();
		} finally {
			ErrorHandling::off();
		}

		if (!is_string($cwd)) {
			throw new ResultException('getcwd', [], $cwd);
		}

		return Path::fromString($cwd);
	}

	public function exists(Path $path)
	{
		$pathString = (string)$path;

		try {
			ErrorHandling::on();
			return file_exists($pathString);
		} finally {
			ErrorHandling::off();
		}
	}

	public function isDirectory(Path $path)
	{
		$pathString = (string)$path;

		try {
			ErrorHandling::on();
			return is_dir($pathString);
		} finally {
			ErrorHandling::off();
		}
	}

	public function isFile(Path $path)
	{
		$pathString = (string)$path;

		try {
			ErrorHandling::on();
			return is_file($pathString);
		} finally {
			ErrorHandling::off();
		}
	}
}
