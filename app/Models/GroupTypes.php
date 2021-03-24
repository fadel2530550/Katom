<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class GroupTypes extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['name', 'parent_id'];

    protected static function getValidator($data)
    {
        $rules=[
            'name'=>[
                'required',
                'unique:group_types',
                 'string',
                 'min:2',
                 'max:150'
            ]

        ];
        $validator = Validator::make($data,$rules);
        return $validator;

    }
    public function children(){
        return $this->hasMany(self::class,'parent_id');
    }
    public function parent(){
        return $this->belongsTo(
            GroupTypes::class,
            'parent_id',
            'id')->withDefault([
                'name'=>'لا توجد فئة'
        ]);
    }
    public function groups(){
        return $this->hasMany(Groups::class,'category_id','id');
    }
    public function childs() {
        return $this->hasMany(self::class,'parent_id','id');
    }
}
