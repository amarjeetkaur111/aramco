<?php

namespace App\Libraries;

use App\Models\Apis\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class CommonFunction
{
    public static function getRoleName(int $user_id = null)
    {
        if (!empty($user_id))
        {
            return implode(', ' , User::find($user_id)->getRoleNames()->toArray());
        }
    }

    public static function getAuthUserRoleId()
    {
        if (Auth::user()->roles->first()->id == 1) {
            return true;
        }

        return false;
    }

    public static function getUserRoleIdByUserId(int $user_id = null)
    {
        return User::find($user_id)->roles->first()->id;
    }

    public static function statusWiseBadge(string $status)
    {
        if ($status == "Pending") {
            return '<span class="badge bg-info">Pending</span>';
        } elseif ($status == "Approved") {
            return '<span class="badge bg-success">Approved</span>';
        } elseif ($status == "Rejected") {
            return '<span class="badge bg-warning">Rejected</span>';
        } elseif ($status == "Cancelled") {
            return '<span class="badge bg-danger">Cancelled</span>';
        }elseif ($status == "Deleted") {
            return '<span class="badge bg-danger">Deleted</span>';
        } else {
            return '';
        }
    }

    public static function statusWiseTextColor(string $status)
    {
        if ($status == "Pending") {
            return 'text-info';
        } elseif ($status == "Approved") {
            return 'text-primary';
        } elseif ($status == "Rejected") {
            return 'text-warning';
        } elseif ($status == "Deleted") {
            return 'text-danger';
        } elseif ($status == "Cancelled") {
            return 'text-danger';
        }else {
            return '';
        }
    }

    public static function getStatus(): array
    {
        return [
            'Pending' => 'Pending',
            'Approved' => 'Approved',
            'Rejected' => 'Rejected',
            'Cancelled' => 'Cancelled',
            'Deleted' => 'Deleted',
        ];
    }

    public static function getImplementationLevel($level)
    {
        if ($level == 1) {
            return 'Submitted';
        } elseif ($level == 2) {
            return 'Screened';
        } elseif ($level == 3) {
            return 'Selected';
        } elseif ($level == 4) {
            return 'Incubated';
        } elseif ($level == 5) {
            return 'Graduated';
        }elseif ($level == 6) {
            return 'Scaleup';
        }else {
            return '';
        }
    }

    public static function getTechnology($level)
    {
        if ($level == 1) {
            return 'Metaverse';
        } elseif ($level == 2) {
            return 'Blockchain';
        } elseif ($level == 3) {
            return 'Virtual Reality';
        } elseif ($level == 4) {
            return 'Augmented Reality';
        } elseif ($level == 5) {
            return 'Robotics';
        }elseif ($level == 6) {
            return 'Other';
        }else {
            return '';
        }
    }

    public static function statusWiseServiceColor(string $status): string
    {
        if ($status == "Pending") {
            return 'text-warning';
        } elseif ($status == "Approved") {
            return "text-success";
        } elseif ($status == "Modify") {
            return "text-primary";
        } elseif ($status == "Rejected" || $status == "Cancelled") {
            return "text-danger";
        } else {
            return '';
        }
    }

    public static function inviteModuleWiseCancelUrl(string $module):string
    {
        if ($module == "hosted-event") {
            return "services-admin-hosted-event-view";
        } elseif($module == "reserve-technology") {
            return "services-admin-reserve-technology-view";
        } elseif($module == "reserve-incubator"){
            return "services-admin-reserve-incubator-view";
        }
        return "";
    }

    public static function getTimeWithSelectionOption()
    {
        $tStart = strtotime("00:00");
        $tEnd = strtotime("23:30");
        $tNow = $tStart;

        $data = [];
        while($tNow <= $tEnd){
            $data[date("H:i", $tNow)] = date("h:i A", $tNow);
            $tNow = strtotime('+30 minutes', $tNow);
        }

        return $data;
    }
}
