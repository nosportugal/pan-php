<?php declare(strict_types=1);

namespace PAN;

class Util
{
    public static function camelToSnake(string $camelCase): string
    {
        $pattern = '/(?<=\\w)(?=[A-Z])|(?<=[a-z])(?=[0-9])/';
        $snakeCase = preg_replace($pattern, '_', $camelCase);

        return strtolower($snakeCase);
    }

    public static function snakeToCamel(string $snakeCase, bool $capitalizeFirstCharacter = false): string
    {
        $camelCase = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $snakeCase))));

        if ($capitalizeFirstCharacter) {
            $camelCase = ucfirst($camelCase);
        }

        return $camelCase;
    }

    public static function headers(array $data = []): array
    {
        $headers = [];

        foreach ($data as $type => $value) {
            switch ($type)
            {
                case 'bearer':
                    $headers['Authorization'] = "Bearer {$value}";
                    break;
                default:
                    $headers[ucwords($type)] = $value;
                    break;
            }
        }

        return $headers;
    }

    public static function isArrayOfString(array $array): bool
    {
        if (count($array) > 0) {
            $new_array = array_filter($array, function($value) {
                return is_string($value);
            });

            return $array === $new_array ? true : false;
        }

        return false;
    }
}
