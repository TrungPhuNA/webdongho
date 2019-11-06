<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table   = 'categories';
    protected $guarded = ['*'];
    
    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;
    
    const HOME = 1;
    
    protected $status = [
		1 => [
			'name' => 'Public',
			'class' => 'label-danger'
		],
		0 => [
			'name' => 'Private',
			'class' => 'label-default'
		]
	];
	
	protected $home = [
		1 => [
			'name' => 'Public',
			'class' => 'label-success'
		],
		0 => [
			'name' => 'Private',
			'class' => 'label-default'
		]
	];

    public static function recursive($categories, $parents = 0, $level = 1, &$categoriesSort)
    {
        if (count($categories) > 0) {
            foreach ($categories as $key => $value) {
                if ($value->c_parent_id == $parents) {
                    $value->level     = $level;
                    $categoriesSort[] = $value;
                    unset($categories[$key]);
                    $new_parent = $value->id;

                    self::recursive($categories, $new_parent, $level + 1, $categoriesSort);
                }
            }
        }
    }
    
    public function getStatus()
	{
		return array_get($this->status,$this->c_active,'[N\A]');
	}
	
	public function getHome()
	{
		return array_get($this->home,$this->c_home,'[N\A]');
	}
	
	public function products()
	{
		return $this->hasMany(Product::class,'pro_category_id');
	}

	public function children()
    {
        return $this->hasMany(Category::class,'c_parent_id','id');
    }

    public static function getListMenuSort()
    {
        $categories = Category::all();
        Category::recursive($categories,$parent = 0,$level = 1,$categoriesSort);

        return $categoriesSort;
    }
}
