<?php
namespace App\Enums;

class Status
{
    public const PENDING = 1;
    public const APPROVED = 2;
    public const CANCELLED = 3;

    public static function getStatusLabel($status)
    {
        switch ($status) {
            case self::PENDING:
                return 'Pending';
            case self::APPROVED:
                return 'Approved';
            case self::CANCELLED:
                return 'Cancelled';
            default:
                return 'Unknown';
        }
    }

    public static function getStatusColor($status)
    {
        switch ($status) {
            case self::PENDING:
                return 'orange';
            case self::APPROVED:
                return 'green';
            case self::CANCELLED:
                return 'red';
            default:
                return '';
        }
    }
}
