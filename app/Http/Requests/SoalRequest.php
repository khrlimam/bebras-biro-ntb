<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SoalRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      "module_id" => 'required',
      'soal' => 'required',
      "jenis_jawaban" => 'required',
      "pilihans.*" => 'required_if:jenis_jawaban,pilihan',
      'jawaban' => 'required'
    ];
  }

  public function attributes()
  {
    return [
      'jenis_jawaban' => 'Jenis jawaban',
      'pilihans.0' => 'Pilihan pertama',
      'pilihans.1' => 'Pilihan kedua',
      'pilihans.2' => 'Pilihan ketiga',
      'pilihans.3' => 'Pilihan keempat'
    ];
  }

}
