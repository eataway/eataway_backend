<?php
namespace Home\Controller;
use Think\Controller;
// 纯算法参数提供类
class SuanFaController extends Controller
{
    /**
     * @desc 根据两点间的经纬度计算距离
     * @param float $lat 纬度值
     * @param float $lng 经度值
     */
    public function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6367.000; //approximate radius of earth in meters地球的近似半径 单位：千米

        /*
        Convert these degrees to radians
        to work with the formula
        */
        $lat1 = ($lat1 * pi() ) / 180;
        $lng1 = ($lng1 * pi() ) / 180;

        $lat2 = ($lat2 * pi() ) / 180;
        $lng2 = ($lng2 * pi() ) / 180;

        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;

        return round($calculatedDistance);
    }
    /**
     * @desc 自定义分页
     * @param $page当前页数，从1开始，$pagenum每页显示个数,$arr数组
     * @return array
     * 二维数组
     */
    public function goPage($page,$pagenum,$arr){
        $beginPage = ($page-1)*$pagenum;
        $endPage = $page*$pagenum;
        $arid = 0;
        $kid = 0;
        $data = array();
        for ($i=$beginPage;$i<$endPage;$arid ++){
            if($arid == $i){
                $data[$kid] = $arr[$i];
                $i++;
                $kid ++;
            }
        }
        // 返回分页后的数组
        $kid = 0;
        foreach ($data as $k){
            if(empty($k)){
                unset($data[$kid]);
            }
            $kid ++;
        }
        ksort($data);
        return $data;
    }
    /**
     * @desc 对数组进行排空处理，如果有空则删掉空
     */
}