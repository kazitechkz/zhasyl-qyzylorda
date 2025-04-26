<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class HashTokenService
{
    public static function createToken(User $user): string
    {
        $data = ['email' => $user->email, 'password' => $user->password];

        // Преобразование данных в JSON
        $jsonData = json_encode($data);

        // Шифрование данных
        $encryptedData = Crypt::encrypt($jsonData);
        $fileName = 'AUTH_'.\Str::random(24);

        // Запись зашифрованных данных в файл
        File::put(public_path('tokens/'.$fileName.'.pfx'), $encryptedData);
        return $fileName.'.pfx';
    }

    public static function createDate($dateID)
    {
        switch ($dateID) {
            case 1:
                $date = Carbon::tomorrow();
                break;
            case 2:
                $date = Carbon::now()->startOfDay()->addWeeks();
                break;
            case 3:
                $date = Carbon::now()->startOfDay()->addMonth();
                break;
            case 4:
                $date = Carbon::now()->startOfDay()->addYear();
                break;
            case 5:
                $date = Carbon::now()->startOfDay()->addYears(3);
                break;
            case 6:
                $date = Carbon::now()->startOfDay()->addYears(5);
                break;
            case 7:
                $date = Carbon::now()->startOfDay()->addYears(100);
                break;
            default:
                $date = Carbon::now()->startOfDay()->addDays(3);
        }
        return $date;
    }
}
