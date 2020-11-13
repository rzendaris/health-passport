<?php

namespace App\Model\Table;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
  use \Awobaz\Compoships\Compoships;

  protected $table = 'submission';

  protected $fillable = [
      'id',
      'user_id',
      'test_type',
      'test_location',
      'city',
      'date',
      'exp_date',
      'document',
      'identifier_id',
      'status'
  ];
}
