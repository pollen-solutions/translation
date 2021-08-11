<?php

declare(strict_types=1);

namespace Pollen\Translation\Concerns;

use InvalidArgumentException;
use Pollen\Translation\LabelsBag;

/**
 * @see \Pollen\Translation\Concerns\LabelsBagAwareTraitInterface
 */
trait LabelsBagAwareTrait
{
    /**
     * Label Bag instance.
     * @var LabelsBag|null
     */
    protected ?LabelsBag $labelsBag = null;

    /**
     * List of default labels.
     *
     * @return array<string, string>
     */
    public function defaultLabels(): array
    {
        return [];
    }

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
    public function labels($key = null, $default = '')
    {
        if (!$this->labelsBag instanceof LabelsBag) {
            $this->labelsBag = LabelsBag::createFromAttrs($this->defaultLabels());
        }

        if (is_null($key)) {
            return $this->labelsBag;
        }

        if (is_string($key)) {
            return $this->labelsBag->get($key, $default);
        }

        if (is_array($key)) {
            $this->labelsBag->set($key);
            return $this->labelsBag;
        }

        throw new InvalidArgumentException('Invalid LabelsBag passed method arguments');
    }

    /**
     * Parse the list of registered label.
     *
     * @return void
     */
    public function parseLabels(): void
    {
    }

    /**
     * Set list of labels.
     *
     * @param array<string, string> $labels
     *
     * @return void
     */
    public function setLabels(array $labels): void
    {
        $this->labels($labels);
    }
}