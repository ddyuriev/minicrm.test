<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class TicketFilters
{
    public static function apply(Builder $query, array $filters): Builder
    {
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['from'])) {
            $query->where('created_at', '>=', Carbon::parse($filters['from'])->startOfDay());
        }

        if (!empty($filters['to'])) {
            $query->where('created_at', '<=', Carbon::parse($filters['to'])->endOfDay());
        }

        if (!empty($filters['email'])) {
            $name = $filters['email'];
            $query->whereHas('customer', function (Builder $q) use ($name) {
                $q->where('email', 'like', "%{$name}%");
            });
        }

        if (!empty($filters['phone'])) {
            $phone = $filters['phone'];
            $query->whereHas('customer', function (Builder $q) use ($phone) {
                $q->where('phone', 'like', "%{$phone}%");
            });
        }

        return $query;
    }
}
