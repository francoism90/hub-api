<?php

namespace Support\Csp\Policies;

use Spatie\Csp\Policies\Basic;
use Spatie\Csp\Directive;
use Spatie\Csp\Value;

class DefaultPolicy extends Basic
{
    public function configure()
    {
        parent::configure();

        // $this
        //     ->addDirective(Directive::UPGRADE_INSECURE_REQUESTS, Value::NO_VALUE)
        //     ->addDirective(Directive::BLOCK_ALL_MIXED_CONTENT, Value::NO_VALUE)
        //     ->addDirective(Directive::SCRIPT, ['https://unpkg.com/vue@3/dist/vue.global.js'])
        //     ->addDirective(Directive::STYLE, ['hub.test'])
        //     ->addDirective(Directive::IMG, 'https://laravel.com/img/logotype.min.svg');
    }
}
