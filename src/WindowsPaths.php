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
 * @author Spencer Mortensen <spencer@testphp.org>
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL-3.0
 * @copyright 2017 Spencer Mortensen
 */

namespace SpencerMortensen\Paths;

class WindowsPaths extends Paths
{
	public function join()
	{
		$fragments = func_get_args();

		$allParts = $this->getAllParts($fragments);

		if (($allParts === null) || (count($allParts) === 0)) {
			return null;
		}

		$parts = array_shift($allParts);

		$drive = $parts['drive'];
		$atoms = $parts['atoms'];
		$isAbsolute = $parts['isAbsolute'];

		foreach ($allParts as $parts) {
			// TODO: consider rejecting path fragments that start with a conflicting drive letter
			$atoms = array_merge($atoms, $parts['atoms']);
		}

		return $this->getPath($drive, $atoms, $isAbsolute);
	}

	private function getAllParts(array $fragments)
	{
		$allParts = array();

		foreach ($fragments as $fragment) {
			$parts = $this->explode($fragment);

			if ($parts === null) {
				return null;
			}

			$allParts[] = $parts;
		}

		return $allParts;
	}

	public function getRelativePath($aPath, $bPath)
	{
		$aParts = $this->explode($aPath);
		$bParts = $this->explode($bPath);

		if (!isset($aParts, $bParts)) {
			return null;
		}

		if (!$aParts['isAbsolute'] || !$bParts['isAbsolute']) {
			return null;
		}

		$aAtoms = $aParts['atoms'];
		$bAtoms = $bParts['atoms'];

		$aCount = count($aAtoms);
		$bCount = count($bAtoms);

		for ($i = 0, $n = min($aCount, $bCount); ($i < $n) && ($aAtoms[$i] === $bAtoms[$i]); ++$i);

		$atoms = array_fill(0, $aCount - $i, '..');
		$atoms = array_merge($atoms, array_slice($bAtoms, $i));

		return $this->getPath(null, $atoms, false);
	}

	public function isChildPath($aPath, $bPath)
	{
		$aParts = $this->explode($aPath);
		$bParts = $this->explode($bPath);

		if (!isset($aParts, $bParts)) {
			return false;
		}

		if (!$bParts['isAbsolute']) {
			return true;
		}

		if (!$aParts['isAbsolute']) {
			return false;
		}

		return strncmp($aPath . '\\', $bPath . '\\', strlen($aPath) + 1) === 0;
	}

	public function explode($path)
	{
		if (!Re::match('^(?:(?<drive>[a-zA-Z]):)?(?<path>.*)$', $path, $match)) {
			return null;
		}

		$drive = self::getNonEmptyString($match['drive']);
		$path = self::getNonEmptyString($match['path']);
		$atoms = self::getAtoms($path);
		$isAbsolute = self::isAbsolute($path);

		return array(
			'drive' => $drive,
			'atoms' => $atoms,
			'isAbsolute' => $isAbsolute
		);
	}

	private static function getNonEmptyString(&$input)
	{
		if (!is_string($input) || (strlen($input) === 0)) {
			return null;
		}

		return $input;
	}

	private static function getAtoms($path)
	{
		if ($path === null) {
			return array();
		}

		$matches = Re::split('\\\\|/', $path);
		$atoms = array_values(array_filter($matches, 'is_string'));

		return $atoms;
	}

	private static function isAbsolute($path)
	{
		if ($path === null) {
			return false;
		}

		$character = substr($path, 0, 1);

		return ($character === '\\') || ($character === '/');
	}

	public function implode(array $parts)
	{
		$drive = &$parts['drive'];
		$atoms = &$parts['atoms'];
		$isAbsolute = &$parts['isAbsolute'];

		return $this->getPath($drive, $atoms, $isAbsolute);
	}

	private function getPath($drive, array $atoms, $isAbsolute)
	{
		$path = '';

		if ($drive !== null) {
			$path .= "{$drive}:";
		}

		if ($isAbsolute) {
			$path .= "\\";
		}

		$path .= implode('\\', $atoms);

		return $path;
	}
}
