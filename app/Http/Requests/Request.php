<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
  public function messages()
  {
      return [
          'title.required' => 'Layer Title is required',
          'url.required' => ' Layer URL is required',
          'default_layer.required' => ' Default Layer for Dynamic Layer is required',
          'type.required'  => 'Layer Type for Dynamic Layer is required',
          'field.required'  => 'Field for Feature Layer is required',
          'id_layer.required'  => 'Layer ID is required',
      ];
  }
}
