<?php

namespace App\Model\Table;

use Illuminate\Database\Eloquent\Model;

class InfraCertificate extends Model
{
  use \Awobaz\Compoships\Compoships;

  protected $table = 'infra_certificate';

  protected $fillable = [
      'id',
      'name',
      'license_no',
      'infra_id',
      'status'
  ];
}
