<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ScalarArray;

class IntArray extends AbstractScalarArray
{
    public function current(): ?int
    {
        return parent::current();
    }

    /** @param mixed $offset */
    public function offsetGet($offset): int
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    protected function canAddValue($offset, $value): bool
    {
        if (is_int($value) === false && $value !== null) {
            throw new \Exception('$value should be of type int or null.');
        }

        return parent::canAddValue($offset, $value);
    }

    /** @param mixed $value */
    protected function cast($value): ?int
    {
        if ($value === null || is_numeric($value) === false) {
            throw new \Exception('"' . $value . '" is not numeric.');
        }

        return ($value === null) ? null : (int) $value;
    }
}