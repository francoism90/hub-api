<?php

namespace Support\ModelState;

use Illuminate\Support\Collection;
use ReflectionClass;
use Spatie\ModelStates\State;

class StateOptions
{
    public function execute(State|string $state): Collection
    {
        $states = call_user_func([$state, 'all']);

        return $states
            ->mapWithKeys(function (string $class) {
                $relector = new ReflectionClass($class);

                $state = $relector->newInstanceWithoutConstructor();

                $label = $relector->hasMethod('label')
                    ? $state->label()
                    : $state->getValue();

                return [$state->getValue() => $label];
            });
    }
}