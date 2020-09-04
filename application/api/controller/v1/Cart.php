<?php

namespace app\api\controller\v1;

use app\api\model\Cart as ModelCart;
use app\api\model\Goods;
use app\api\model\GoodsSpecifications;
use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Cart extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        Db::startTrans();
        try {
            $goods_id = $_POST['goods_id'];
            $spec_id = $_POST['spec_id'];
            $num = $_POST['num'];
            
            $goods = Goods::find($goods_id);
            if (!$goods) 
                throw new Exception('未查询到商品', 1);

            $spec = GoodsSpecifications::find($spec_id);
            if (!$spec) 
                throw new Exception('未查询到规格数据', 1);
            
            if ($spec->stock < $num) 
                throw new Exception('库存不足', 1);
            
            if ($spec->goods_id != $goods_id) 
                throw new Exception('数据异常', 1);
            

            if (ModelCart::find(['user_id'=>$uid, 'goods_id'=>$goods_id, 'goods_spec_id'=>$spec_id])) {
                throw new Exception('该规格商品您已经加入购物车了', 1);
            }

            $data = array(
                'user_id'       => $uid,
                'goods_id'      => $goods_id,
                'shop_id'       => $goods->shop_id,
                'goods_spec_id' => $spec_id,
                'num'           => $num,
                'join_price'    => $spec->price,
            );
            
            if (!ModelCart::create($data)) {
                throw new Exception('加入购物车失败', 1);
            }

            Db::commit();
            success('加入购物车成功');
        } catch (Exception $e) {
            Db::rollback();
            error($e->getMessage());
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
