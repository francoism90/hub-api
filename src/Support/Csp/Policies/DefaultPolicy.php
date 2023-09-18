<?php

namespace Support\Csp\Policies;

use Spatie\Csp\Policies\Basic;
use Spatie\Csp\Directive;

class DefaultPolicy extends Basic
{
    public function configure()
    {
        parent::configure();

        $this
            ->addDirective(Directive::SCRIPT, ['https://unpkg.com/vue@3/dist/vue.global.js'])
            ->addDirective(Directive::STYLE, ['https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'])
            ->addDirective(Directive::IMG, 'https://laravel.com/img/logotype.min.svg');
    }
}
