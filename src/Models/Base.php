<?php

/**
 * This file is part of werd/ivona-speechcloud-sdk-php.
 *
 * (c) Janis Sakars <janis.sakars@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Werd\Ivona\Models;

abstract class Base
{
    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        foreach ($params as $param => $value) {
            $method = 'set' . $param;
            if (method_exists($this, $method)) {
                $this->{$method}($value);
            }
        }
    }

    /**
     * @return string
     */
    public function json()
    {
        return json_encode($this);
    }
}
