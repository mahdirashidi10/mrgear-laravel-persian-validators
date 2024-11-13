<?php

namespace MRGear\PersianValidator;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class PersianValidatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('alpha_space_fa', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[\p{Arabic}^\p{N}\s]+$/u', $value) && !preg_match('/[\x{06F0}-\x{06F9}]/u', $value);
        });

        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        Validator::extend('jalali_date', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(13|14)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/', $value) &&
                checkJalaliDate($value);
        });

        function checkJalaliDate($date)
        {
            [$year, $month, $day] = explode('-', $date);
            $jalaliDaysInMonth = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
            $isLeap = (((($year - 474) % 2820) + 474 + 38) * 682) % 2816 < 682;

            return ($month != 12 || $day <= 29 || ($day == 30 && $isLeap)) && $day <= $jalaliDaysInMonth[$month - 1];
        }


        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^09(1[0-9]|9[0-2]|2[0-2]|0[1-5]|41|3[0,3,5-9])\d{7}$/', $value);
        });

        Validator::extend('ir_phone_number', function ($attribute, $value) {
            if (!str_starts_with($value, '09')) {
                return false;
            }
            return strlen($value) == 11;
        });
    }


}
