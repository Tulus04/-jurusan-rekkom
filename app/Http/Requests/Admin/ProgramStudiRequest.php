<?php
declare(strict_types=1);
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class ProgramStudiRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nama'       => 'required|string|max:255',
            'jenjang'    => 'required|string|max:10',
            'akreditasi' => 'nullable|string|max:50',
            'deskripsi'  => 'nullable|string',
            'visi'       => 'nullable|string',
            'misi'       => 'nullable|string',
            'gambar'     => ($this->isMethod('POST') ? 'nullable' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'  => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'    => 'Nama program studi wajib diisi.',
            'jenjang.required' => 'Jenjang wajib diisi (D3/D4/S1).',
        ];
    }
}
