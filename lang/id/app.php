<?php
return [
    'home' => 'Beranda',
    'user' => 'Pengguna',
    'role-and-permission' => 'Peran dan Izin',
    'problem' => 'Keluhan',

    'name' => 'Nama',
    'password' => 'Sandi',
    'email' => 'Email',
    'roles' => 'Peran',

    'problem' => 'Keluhan',
    'status' => 'Tindakan',
    'note' => 'Keterangan',
    'id' => 'Code',
    'answer' => 'Jawaban',

    'response' => [
        'success' => [
            'store' => 'Berhasil disimpan',
            'update' => 'Berhasil diubah',
            'delete' => 'Berhasil dihapus',
            'answer' => 'Berhasil di jawab',
        ],
        'error' => [
            'store' => 'Gagal disimpan',
            'update' => 'Gagal diubah',
            'delete' => 'Gagal dihapus',
            'answer' => 'Gagal di jawab',
            'permission_denied' => 'Anda tidak memiliki izin untuk melakukan tindakan ini',
        ],
    ],

    'validation' => [
        'id.required' => ':attribute wajib diisi',
        'id.string' => ':attribute tidak valid',
        'name.required' => ':attribute wajib diisi',
        'name.string' => ':attribute tidak valid',
        'email.required' => ':attribute wajib diisi',
        'email.email' => ':attribute tidak valid',
        'email.unique' => ':attribute sudah terdaftar',
        'password.required' => ':attribute wajib diisi',
        'password.string' => ':attribute tidak valid',
        'roles.required' => ':attribute wajib diisi',
        'roles.array' => ':attribute tidak valid',
        'problem.required' => ':attribute wajib diisi',
        'problem.string' => ':attribute tidak valid',
        'status.required' => ':attribute wajib diisi',
        'status.string' => ':attribute tidak valid',
        'note.required' => ':attribute wajib diisi',
        'note.string' => ':attribute tidak valid',
    ],

    'permission' => [
        'PROBLEM' => 'Keluhan',
        'read PROBLEM' => 'Melihat Keluhan',
        'create PROBLEM' => 'Membuat Keluhan',
        'update PROBLEM' => 'Mengubah Keluhan',
        'delete PROBLEM' => 'Menghapus Keluhan',
        'answer problem' => 'Mengjawab Keluhan',

        'ROLE_AND_PERMISSION' => 'Hak akses',
        'read ROLE_AND_PERMISSION' => 'Melihat Hak akses',
        'create ROLE_AND_PERMISSION' => 'Membuat Hak akses',
        'update ROLE_AND_PERMISSION' => 'Mengubah Hak akses',
        'delete ROLE_AND_PERMISSION' => 'Menghapus Hak akses',

        'USER' => 'Pengguna',
        'read USER' => 'Melihat Pengguna',
        'create USER' => 'Membuat Pengguna',
        'update USER' => 'Mengubah Pengguna',
        'delete USER' => 'Menghapus Pengguna',
    ],
];
