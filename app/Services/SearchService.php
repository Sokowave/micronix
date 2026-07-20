<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class SearchService
{
    protected string $sessionKey = 'recent_searches';

    protected int $limit = 8;

    /*
    |--------------------------------------------------------------------------
    | Recent Searches (Session)
    |--------------------------------------------------------------------------
    */

    public function all(): Collection
    {
        return collect(
            session($this->sessionKey, [])
        );
    }

    public function add(string $query): void
    {
        $query = $this->normalize($query);

        if (blank($query)) {
            return;
        }

        $searches = $this->all()
            ->reject(
                fn ($item) => strcasecmp($item, $query) === 0
            )
            ->prepend($query)
            ->take($this->limit)
            ->values();

        $this->store($searches);
    }

    public function remove(string $query): void
    {
        $searches = $this->all()
            ->reject(
                fn ($item) => strcasecmp($item, trim($query)) === 0
            )
            ->values();

        $this->store($searches);
    }

    public function removeAt(int $index): void
    {
        $searches = $this->all();

        if (! isset($searches[$index])) {
            return;
        }

        $searches->forget($index);

        $this->store(
            $searches->values()
        );
    }

    public function clear(): void
    {
        session()->forget(
            $this->sessionKey
        );
    }

    public function contains(string $query): bool
    {
        return $this->all()->contains(
            fn ($item) => strcasecmp(
                $item,
                trim($query)
            ) === 0
        );
    }

    public function count(): int
    {
        return $this->all()->count();
    }

    public function latest(int $limit = 5): Collection
    {
        return $this->all()->take($limit);
    }

    /*
    |--------------------------------------------------------------------------
    | Internal Helpers
    |--------------------------------------------------------------------------
    */

    protected function store(
        Collection $searches
    ): void {

        session([
            $this->sessionKey => $searches
                ->filter()
                ->values()
                ->all(),
        ]);
    }

    protected function normalize(
        string $query
    ): string {

        return Str::of($query)
            ->squish()
            ->trim()
            ->limit(100, '')
            ->toString();
    }
}