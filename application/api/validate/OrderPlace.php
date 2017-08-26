<?php
namespace app\api\validate;
use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate{

    /*[
        [
            'product_id'=>1,
            'count'=>2
        ],
        [
            'product_id'=>2,
            'count'=>4
        ]
    ];*///模拟数据结构


    protected $rule=[
        'products'='array|checkProducts'
    ];

    $singleRule=[
        'product_id'='require|isPositiveInteger',
        'count'='require|isPositiveInteger'
    ];
    // 自定义验证规则 验证验证用户提交的订单数据必须是一个指定格式的二维数组
    protected function checkProducts($values){

        if(!is_array($values)){
            throw new ParameterException([
                'msg'=>'商品参数不正确'
            ]);
        }
        if(empty($values)){
            throw new ParameterException([
                'msg'=>'商品列表不能为空'
            ]);
        }

        foreach ($values as $v) {
            $this->checkProducts($v);
        }
        return true;

    }

    protected function checkProduct($value){
        $validate=new BaseValidate($this->singleRule);

        $result=$validate->check($value);
        if(!$result){
            throw new ParameterException([
                'msg'=>'商品列表参数错误'
            ]);
        }
    }


}
