<?php
namespace App\Enums;

class Status
{
    public const PENDING = 1;
    public const APPROVED = 2;
    public const CANCELLED = 3;
    public const DELIVERED = 4;
    public const SEND = 5;

    public static function getStatusLabel($status)
    {
        switch ($status) {
            case self::PENDING:
                return 'Pending';
            case self::APPROVED:
                return 'Approved';
            case self::CANCELLED:
                return 'Cancelled';
            case self::DELIVERED:
                return 'Delivered';
            case self::SEND:
                return 'Send';
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
            case self::DELIVERED:
                return '#ffcb00';
            case self::SEND:
                return '#0c8968';
            default:
                return '';
        }
    }
}
