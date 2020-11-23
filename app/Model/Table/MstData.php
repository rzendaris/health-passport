<?php

namespace App\Model\Table;

use Illuminate\Database\Eloquent\Model;

class MstData extends Model
{
  use \Awobaz\Compoships\Compoships;

  protected $table = 'mst_data';

  protected $fillable = [
      'id',
      'name',
      'icon',
      'latitude',
      'longitude',
      'category_id',
      'city',
      'province',
      'address',
      'facility',
      'rating',
      'description',
      'images'
  ];
}
