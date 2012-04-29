<?php
/*
 * This file is part of Alom Graphviz.
 * (c) Alexandre Salomé <alexandre.salome@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alom\Graphviz;

/**
 * Base class for Graphviz instructions.
 *
 * @author Alexandre Salomé <alexandre.salome@gmail.com>
 */
abstract class BaseInstruction implements InstructionInterface
{
    /**
     * Renders an inline assignment (without indent or end return line).
     *
     * It will handle escaping, according to the value.
     *
     * @param string $name A name
     *
     * @param string $value A value
     */
    protected function renderInlineAssignment($name, $value)
    {
        return sprintf('%s=%s', $this->escape($name), $this->escape($value));
    }

    /**
     * Escapes a value if needed.
     *
     * @param string $value The value to set
     *
     * @return string The escaped string
     */
    protected function escape($value)
    {
        if ($this->needsEscaping($value)) {
            return '"'.str_replace('"', '""', $value).'"';
        } else {
            return $value;
        }
    }

    /**
     * Tests if a string needs escaping.
     *
     * @return boolean Result of test
     */
    protected function needsEscaping($value)
    {
        return preg_match('/[ "#:]/', $value) || in_array($value, array('graph', 'node', 'edge')) || empty($value);
    }
}
