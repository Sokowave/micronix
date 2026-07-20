<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait GeneratesOrderIdentifiers
{
    protected static function generateOrderNumber(): string
    {
        /** @var Model $model */
        $model = new static();

        do {

            $number = '80' . random_int(
                100000000,
                999999999
            );

        } while (
            $model->newQuery()
                ->where(
                    'order_number',
                    $number
                )
                ->exists()
        );

        return $number;
    }

    protected static function generateTrackingNumber(): string
    {
        /** @var Model $model */
        $model = new static();

        $chars =
            '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';

        $length = strlen($chars);

        $generate = fn (int $size): string =>
            collect(range(1, $size))
                ->map(
                    fn (): string => $chars[
                        random_int(0, $length - 1)
                    ]
                )
                ->implode('');

        do {

            $tracking =
                'MNX-' .
                $generate(5) .
                '-' .
                $generate(6);

        } while (
            $model->newQuery()
                ->where(
                    'tracking_number',
                    $tracking
                )
                ->exists()
        );

        return $tracking;
    }

    protected static function generatePaymentReference(): string
    {
        /** @var Model $model */
        $model = new static();

        // Excludes: 0, 1, I, O
        $chars =
            '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';

        $length = strlen($chars);

        do {

            $reference = collect(range(1, 8))
                ->map(
                    fn (): string => $chars[
                        random_int(0, $length - 1)
                    ]
                )
                ->implode('');

        } while (
            $model->newQuery()
                ->where(
                    'payment_reference',
                    $reference
                )
                ->exists()
        );

        return $reference;
    }
}