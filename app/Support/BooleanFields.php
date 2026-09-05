<?php

namespace App\Support;

use Illuminate\Http\Request;

final class BooleanFields
{
    /**
     * @param  list<string>  $fields
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    public static function merge(Request $request, array $validated, array $fields): array
    {
        foreach ($fields as $field) {
            $validated[$field] = $request->boolean($field);
        }

        return $validated;
    }
}
