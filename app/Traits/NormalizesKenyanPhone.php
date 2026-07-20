<?php

namespace App\Traits;

trait NormalizesKenyanPhone
{
    /**
     * Normalize Kenyan phone numbers.
     *
     * Examples:
     * 0712000166     => +254712000166
     * 712000166      => +254712000166
     * +254712000166  => +254712000166
     * 0112000166     => +254112000166
     * 112000166      => +254112000166
     */
    protected function normalizeKenyanPhone(
        ?string $phone
    ): ?string {

        if (blank($phone)) {
            return null;
        }

        $phone = trim($phone);

        $phone = preg_replace(
            '/[^0-9+]/',
            '',
            $phone
        );

        if (
            str_starts_with(
                $phone,
                '+254'
            )
        ) {
            return $phone;
        }

        if (
            str_starts_with(
                $phone,
                '254'
            )
        ) {
            return '+' . $phone;
        }

        if (
            str_starts_with(
                $phone,
                '0'
            )
        ) {
            return '+254' . substr(
                $phone,
                1
            );
        }

        if (
            preg_match(
                '/^(7|1)\d{8}$/',
                $phone
            )
        ) {
            return '+254' . $phone;
        }

        return $phone;
    }

    /**
     * Determine if a phone number is a valid
     * Kenyan mobile number.
     */
    protected function isValidKenyanPhone(
        ?string $phone
    ): bool {

        $phone = $this->normalizeKenyanPhone(
            $phone
        );

        return (bool) preg_match(
            '/^\+254(7|1)\d{8}$/',
            $phone
        );
    }
}
