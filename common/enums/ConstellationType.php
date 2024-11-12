<?php

namespace common\enums;

/**
 * Class ConstellationType
 *
 * @package common\enums
 * @author m.kropukhinsky <m.kropukhinsky@peppers-studio.ru>
 */
enum ConstellationType: int implements DictionaryInterface
{
    use DictionaryTrait;

    case PREPARED = 0;
    case CUSTOM = 1;

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return match ($this) {
            self::PREPARED => 'Подготовленные',
            self::CUSTOM => 'Пользовательские',
        };
    }

    /**
     * {@inheritdoc}
     */
    public function color(): string
    {
        return match ($this) {
            self::PREPARED, self::CUSTOM => 'var(--bs-success)'
        };
    }
}
