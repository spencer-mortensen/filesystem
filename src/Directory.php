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

use ErrorException;
use SpencerMortensen\Exceptions\ErrorHandling;

class Directory
{
	/** @var int */
	private static $mode = 0777;

	/** @var Path */
	private $path;

	public function __construct(Path $path)
	{
		$this->path = $path;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function read($asObjects = true)
	{
		$path = (string)$this->path;

		$names = $this->scan($path);

		if ($asObjects === false) {
			return $names;
		}

		$children = [];

		foreach ($names as $name) {
			$children[] = $this->getChild($name);
		}

		return $children;
	}

	private function scan($directoryPath)
	{
		$contents = [];

		try {
			ErrorHandling::on();

			$directory = opendir($directoryPath);

			for ($childName = readdir($directory); $childName !== false; $childName = readdir($directory)) {
				if (($childName === '.') || ($childName === '..')) {
					continue;
				}

				$contents[] = $childName;
			}

			closedir($directory);
		} finally {
			ErrorHandling::off();
		}

		return $contents;
	}

	private function getChild($name)
	{
		$childPath = $this->path->add($name);

		if (is_dir((string)$childPath)) {
			return new Directory($childPath);
		}

		return new File($childPath);
	}

	public function write(array $contents = null)
	{
		if ($contents === null) {
			$this->createDirectory($this->path);
		} else {
			$this->writeDirectory($this->path, $contents);
		}
	}

	private function writeDirectory(Path $path, array $contents)
	{
		$this->createDirectory($path);

		foreach ($contents as $childName => $childContents) {
			$childPath = $path->add($childName);

			if (is_array($childContents)) {
				$this->writeDirectory($childPath, $childContents);
			} else {
				$this->writeFile($childPath, $childContents);
			}
		}
	}

	private function writeFile(Path $path, $contents)
	{
		$file = new File($path);
		$file->write($contents);
	}

	public function createDirectory(Path $path)
	{
		$pathString = (string)$path;

		if (is_dir($pathString)) {
			return;
		}

		try {
			ErrorHandling::on();
			$isCreated = mkdir($pathString, self::$mode, true);
		} finally {
			ErrorHandling::off();
		}

		if ($isCreated !== true) {
			throw new ResultException('mkdir', [$pathString, self::$mode, true], $isCreated);
		}
	}

	public function move(Path $newPath)
	{
		$oldPathString = (string)$this->path;
		$newPathString = (string)$newPath;

		if (!file_exists($oldPathString)) {
			// TODO: improve this exception:
			throw new ErrorException("There is no file to move.");
		}

		if (file_exists($newPathString)) {
			// TODO: improve this exception:
			throw new ErrorException("There is already a file at the destination path.");
		}

		try {
			ErrorHandling::on();
			$isMoved = rename($oldPathString, $newPathString);
		} finally {
			ErrorHandling::off();
		}

		if ($isMoved !== true) {
			throw new ResultException('rename', [$oldPathString, $newPathString], $isMoved);
		}

		$this->path = $newPath;
	}

	public function delete()
	{
		$path = (string)$this->path;

		if (!file_exists($path)) {
			return;
		}

		$children = $this->read();

		foreach ($children as $child) {
			$child->delete();
		}

		try {
			ErrorHandling::on();
			$isDeleted = rmdir($path);
		} finally {
			ErrorHandling::off();
		}

		if ($isDeleted !== true) {
			throw new ResultException('rmdir', [$path], $isDeleted);
		}
	}

	public function getModifiedTime()
	{
		$path = (string)$this->path;

		try {
			ErrorHandling::on();
			$time = filemtime($path);
		} finally {
			ErrorHandling::off();
		}

		if (!is_int($time)) {
			throw new ResultException('filemtime', [$path], $time);
		}

		return $time;
	}
}
