<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
class UsersImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),

        ]);
    }
    public function rules(): array
    {
        return [
            'name' => 'required',

            // Above is alias for as it always validates in batches
            '*.name' => 'required',
            'email' => 'required|email|unique:users',

            '*.email' => 'required|email|unique:users',
            'password' => 'required',

            '*.password' => 'required',
        ];
    }
}
