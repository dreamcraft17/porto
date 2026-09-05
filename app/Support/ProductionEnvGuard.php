<?php

namespace App\Support;

use RuntimeException;

final class ProductionEnvGuard
{
    /**
     * @param  array{env?: string, debug?: bool, allow_admin_registration?: bool, contact_to?: ?string}  $values
     */
    public static function assert(array $values): void
    {
        if (($values['env'] ?? null) !== 'production') {
            return;
        }

        if (($values['debug'] ?? false) === true) {
            throw new RuntimeException('APP_DEBUG must be false in production.');
        }

        if (($values['allow_admin_registration'] ?? false) === true) {
            throw new RuntimeException('ALLOW_ADMIN_REGISTRATION must be false in production.');
        }

        if (! filled($values['contact_to'] ?? null)) {
            throw new RuntimeException('CONTACT_MAIL_TO must be set in production.');
        }
    }
}
