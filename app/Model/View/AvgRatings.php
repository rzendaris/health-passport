<?php

namespace App\Model\View;

use Illuminate\Database\Eloquent\Model;

class AvgRatings extends Model
{
  use \Awobaz\Compoships\Compoships;

  protected $table = 'view_avg_ratings';

  protected $fillable = [
      'avg_ratings','download_counter','id', 'name', 'type', 'app_icon', 'eu_sdk_version','package_name', 'category_id', 'rate', 'version', 'file_size', 'description', 'updates_description',
      'link', 'apk_file', 'expansion_file','media', 'developer_id', 'is_approve','reject_reason', 'is_active', 'is_partnership', 'created_at', 'created_by', 'updated_at', 'updated_by'
  ];
  public function categories()
  {
      return $this->belongsTo('App\Model\Table\MstCategories', 'category_id', 'id');
  }
  public function developers()
  {
      return $this->belongsTo('App\User', 'developer_id', 'id');
  }
  public function ratings()
  {
      return $this->hasMany('App\Model\Table\Ratings', 'apps_id', 'id');
  }
}
