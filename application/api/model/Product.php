<?php
namespace app\api\model;

class Product extends Base{
    // product表里面的冗余数据可以提升数据查询性能 可以减少join




    // 设置模型的数据集返回类型
    protected $resultSetType = 'collection';

    // 隐藏字段
    protected $hidden=['delete_time','update_time','create_time','category_id','img_id','from','pivot'];//pivot是代表中间的字段 是tp5加上的

    // 获取器
    public function getMainImgUrlAttr($value,$data)
    {
        return $this->prefixImgUrl($value,$data);
    }

    // 获取最新产品
    public static function getRecent($count){
        $recents=self::limit($count)->order('create_time desc')->select();
        return $recents;
    }

    // 根据分类id查询此分类下面的所有商品
    public static function getProductsByCategoryId($categoryId){
        $products=self::where('category_id','=',$categoryId)->select();
        return $products;
    }
}
