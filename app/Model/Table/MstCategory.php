<?php

namespace App\Model\Table;

use Illuminate\Database\Eloquent\Model;

class MstCategories extends Model
{
  use \Awobaz\Compoships\Compoships;

  protected $table = 'mst_category';

  protected $fillable = [
      'id',
      'name',
      'icon'
  ];
}
