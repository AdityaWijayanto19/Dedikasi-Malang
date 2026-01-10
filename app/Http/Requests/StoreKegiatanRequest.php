<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\PendaftaranStatus;
use App\Enums\StatusPostingan;
use Illuminate\Validation\Rules\Enum;

class StoreKegiatanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'batch' => 'required|max:255|unique:kegiatans,batch',
            'title' => 'required|max:255',
            'deskripsi' => 'required|string|max:1000',
            'tanggal' => 'required|string|max:100',
            'gambar' => 'required|file|mimes:jpeg,jpg,png,svg|max:2048',
            'lokasi' => 'required|max:255',
            'link_dokumentasi' => 'required|max:255',
            'status' => ['required', new Enum(StatusPostingan::class)],
            'link_whatsapp_group' => 'nullable|max:255',
            'is_open_for_registration' => ['required', new Enum(PendaftaranStatus::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'batch.unique' => 'Batch kegiatan sudah ada, silakan gunakan Batch lain.',
            'batch.required' => 'Batch kegiatan wajib diisi.',
            'title.required' => 'Judul kegiatan wajib diisi.',
            'gambar.required' => 'Gambar kegiatan wajib diisi.',
            'gambar.max' => 'Gambar yang di upload Maksimal 2MB',
            'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
            'tanggal.required' => 'Tanggal kegiatan wajib diisi.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
            'link_dokumentasi.required' => 'Link Url kegiatan wajib diisi.',
        ];
    }
}
