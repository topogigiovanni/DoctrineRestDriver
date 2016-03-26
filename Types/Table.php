<?php
/**
 * This file is part of DoctrineRestDriver.
 *
 * DoctrineRestDriver is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * DoctrineRestDriver is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DoctrineRestDriver.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Circle\DoctrineRestDriver\Types;

use Circle\DoctrineRestDriver\Enums\SqlOperations;
use Circle\DoctrineRestDriver\Validation\Assertions;

/**
 * Table type
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 */
class Table {

    /**
     * Returns the table name
     *
     * @param  array  $tokens
     * @return string
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public static function create(array $tokens) {
        Assertions::assertHashMap('tokens', $tokens);

        $operation = SqlOperation::create($tokens);
        if ($operation === SqlOperations::UPDATE) return str_replace('\'', '', $tokens['UPDATE'][0]['table']);
        if ($operation === SqlOperations::INSERT) return str_replace('\'', '', $tokens['INSERT'][1]['table']);
        return str_replace('\'', '', $tokens['FROM'][0]['table']);
    }

    /**
     * Returns the table's alias
     *
     * @param  array  $tokens
     * @return string
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public static function alias(array $tokens) {
        Assertions::assertHashMap('tokens', $tokens);

        $operation = SqlOperation::create($tokens);
        if ($operation === SqlOperations::INSERT) return $tokens['INSERT'][1]['alias']['name'];
        if ($operation === SqlOperations::UPDATE) return $tokens['UPDATE'][0]['alias']['name'];
        return $tokens['FROM'][0]['alias']['name'];
    }
}