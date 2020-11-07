<?php

namespace App\Model\Table;

use Illuminate\Database\Eloquent\Model;

class SpreadZone extends Model
{
  use \Awobaz\Compoships\Compoships;

  protected $table = 'spreadzone';

  protected $fillable = [
      'id',
      'name',
      'latitude',
      'longitude',
      'radius'
  ];
}
