<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
class EncryptionController extends Controller
{
    public function createEncryptedFile()
    {
        $data = ['email' => 'mayor@gmail.com', 'password' => 'akimat123456'];

        // Преобразование данных в JSON
        $jsonData = json_encode($data);

        // Шифрование данных
        $encryptedData = Crypt::encrypt($jsonData);
        $fileName = 'AUTH_'.\Str::random();

        // Запись зашифрованных данных в файл
        File::put(public_path($fileName.'.pfx'), $encryptedData);

        return 'Encrypted file created successfully!';
    }
}
