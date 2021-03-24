<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Groups extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration','price','category_id'];

    protected static function getValidator($data)
    {
        $rules=[
          'name'=>[
                'required',
                'unique:groups',
                 'string',
                 'min:2',
                 'max:150'
            ],
            'duration'=>[
                'required',
                'int',
                'min:0'
            ],
            'price'=>[
                'numeric',
                'min:0'
            ],
            'category_id'=>[
                'required',
                'int',
                'exists:group_types,id'
            ],

        ];
        $validator = Validator::make($data,$rules);
        return $validator;

    }
    public function group_types(){
        return $this->belongsTo(GroupTypes::class,'category_id','id');
    }
}
