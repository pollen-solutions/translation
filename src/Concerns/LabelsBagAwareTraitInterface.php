<?php

declare(strict_types=1);

namespace Pollen\Translation\Concerns;

use InvalidArgumentException;
use Pollen\Translation\LabelsBag;

interface LabelsBagAwareTraitInterface
{
    /**
     * List of default labels.
     *
     * @return array<string, string>
     */
    public function defaultLabels(): array;

    /**
     * Retrieve label bag instance|Set labels|Get value of a label.
     *
     * @param array<string, string>|string|null $key
     * @param mixed $default
     *
     * @return string|mixed|LabelsBag
     *
     * @throws InvalidArgumentException
     */
    public function labels($key = null, $default = '');

    /**
     * Parse the list of registered label.
     *
     * @return void
     */
    public function parseLabels(): void;

    /**
     * Set list of labels.
     *
     * @param array<string, string> $labels
     *
     * @return void
     */
    public function setLabels(array $labels): void;
}