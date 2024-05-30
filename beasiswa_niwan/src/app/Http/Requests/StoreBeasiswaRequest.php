<?php

namespace App\Http\Requests;

use App\Models\Beasiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBeasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('beasiswa_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'nim' => [
                'string',
                'nullable',
            ],
            'jurusan' => [
                'string',
                'nullable',
            ],
            'fakultas' => [
                'string',
                'nullable',
            ],
            'indeks' => [
                'string',
                'nullable',
            ],
            'beasiswa' => [
                'nullable',
                'string',
            ],
        ];
    }
}
