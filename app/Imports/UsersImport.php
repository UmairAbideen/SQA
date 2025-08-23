<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'username'    => $row['username'] ?? null,
            'email'       => $row['email'] ?? null,
            'password'    => isset($row['password']) ? bcrypt($row['password']) : null, // encrypt password
            'org'         => $row['org'] ?? null,
            'ses_no'      => $row['ses_no'] ?? null,
            'role'        => $row['role'] ?? null,
            'department'  => $row['department'] ?? null,
            'designation' => $row['designation'] ?? null,
            'approval'    => $row['approval'] ?? null,
            'status'      => $row['status'] ?? null,
        ]);
    }
}
