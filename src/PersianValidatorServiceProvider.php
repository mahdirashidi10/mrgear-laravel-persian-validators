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
        }, 'این فیلد فقط می‌تواند شامل حروف فارسی و جای خالی باشد.');

        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value);
        }, 'این فیلد فقط می‌تواند شامل حروف و جای خالی باشد.');

        Validator::extend('jalali_date', function ($attribute, $value, $parameters, $validator) {
            try {
                \Morilog\Jalali\Jalalian::fromFormat('Y-m-d', $value);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }, 'تاریخ وارد شده معتبر نیست.');

        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^09(1[0-9]|9[0-2]|2[0-2]|0[1-5]|41|3[0,3,5-9])\d{7}$/', $value);
        }, 'شماره تلفن معتبر نیست.');

        Validator::extend('ir_phone_number', function ($attribute, $value) {
            if (!str_starts_with($value, '09')) {
                return false;
            }
            return strlen($value) == 11;
        }, 'شماره تلفن باید با 09 شروع شود و دارای 11 رقم باشد.');

    }


}
