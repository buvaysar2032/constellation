<?php

namespace common\enums;

/**
 * Class ConstellationStatus
 *
 * @package common\enums
 * @author m.kropukhinsky <m.kropukhinsky@peppers-studio.ru>
 */
enum ConstellationStatus: int implements DictionaryInterface
{
    use DictionaryTrait;

    case Check = 0;
    case Approved = 1;
    case Rejected = 2;

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return match ($this) {
            self::Check => 'На проверке',
            self::Approved => 'Одобрено',
            self::Rejected => 'Отклонено'
        };
    }

    /**
     * {@inheritdoc}
     */
    public function color(): string
    {
        return match ($this) {
            self::Check, self::Approved => 'var(--bs-success)',
            self::Rejected => 'var(--bs-danger)'
        };
    }
}
