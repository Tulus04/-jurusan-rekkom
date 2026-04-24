<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nama'             => 'required|string|max:255',
            'nidn'             => 'nullable|string|max:20',
            'jabatan'          => 'nullable|string|max:255',
            'email'            => 'nullable|email|max:255',
            'telepon'          => 'nullable|string|max:20',
            'bidang_keahlian'  => 'nullable|string|max:500',
            'bio'              => 'nullable|string',
            'urutan'           => 'nullable|integer|min:0',
            'is_active'        => 'boolean',
        ];

        if ($this->isMethod('POST')) {
            $rules['foto'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048';
        } else {
            $rules['foto'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama dosen wajib diisi.',
            'foto.image'    => 'File harus berupa gambar.',
            'foto.max'      => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
