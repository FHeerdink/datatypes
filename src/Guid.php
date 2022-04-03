<?php

declare(strict_types=1);

namespace Fheerdink\DataTypes;

use InvalidArgumentException;

class Guid
{
    /**
     * @param string $guidString
     */
    public function __construct(protected string $guidString)
    {
        $guid = filter_var(
            $this->guidString,
            FILTER_VALIDATE_REGEXP,
            ["options" => ["regexp" => "/\{?[A-F0-9]{8}-[A-F0-9]{4}-[A-F0-9]{4}-[A-F0-9]{4}-[A-F0-9]{12}\}?/i"]]
        );

        if ($guid !== $this->guidString) {
            throw new InvalidArgumentException('Invalid GUID string given');
        }
    }

    /**
     * @return Guid
     */
    public static function generate(): Guid
    {
        // Original: https://github.com/MicrosoftTranslator/Text-Translation-API-V3-PHP/blob/master/Translate.php#L26
        $guidString = sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );

        return new Guid($guidString);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->guidString;
    }
}
