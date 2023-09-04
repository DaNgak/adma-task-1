<?php

namespace App\Helper;

use App\Models\Report;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class Helper 
{
    public static function generateTicketId() : string {
        $today = Carbon::now();
        $formattedDate = $today->format('Ymd');

        $latestReport = Report::whereDate('created_at', $today)->latest()->first();

        if ($latestReport) {
            $lastTicketId = $latestReport->ticket_id;
            $lastNumber = (int)substr($lastTicketId, -5);
            $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '00001';
        }

        return $formattedDate . $newNumber;
    }

    public static function getRoleModels($role) : Role {
        return Role::where('name', $role)->first();
    }
}
