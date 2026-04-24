<?php
declare(strict_types=1);
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class FasilitasRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icon'      => 'nullable|string|max:100',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama fasilitas wajib diisi.',
        ];
    }
}
