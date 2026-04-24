<?php
declare(strict_types=1);
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class GaleriRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar'    => ($this->isMethod('POST') ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kategori'  => 'nullable|string|max:100',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'  => 'Judul galeri wajib diisi.',
            'gambar.required' => 'Gambar wajib diupload.',
            'gambar.image'    => 'File harus berupa gambar.',
        ];
    }
}
