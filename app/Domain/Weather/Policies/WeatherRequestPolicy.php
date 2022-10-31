<?php

namespace App\Domain\Weather\Policies;

use App\Domain\Weather\Models\WeatherRequest;
use App\Models\User;

class WeatherRequestPolicy
{
    public function index(): bool
    {
        return true;
    }

    public function show(User $user, WeatherRequest $weatherRequest): bool
    {
        return $user->is($weatherRequest->user);
    }

    public function create(): bool
    {
        return true;
    }

    public function delete(User $user, WeatherRequest $weatherRequest): bool {
        return $this->show($user, $weatherRequest);
    }
}
