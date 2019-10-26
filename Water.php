<?php
class Water
{
    protected $water;
    public function __construct(string $water)
    {
        $this->water = $water;
    }
    //$pos 水印位置  按九宫格1-9设置
    public function make(string $image, $filename = null, $pos = 9)
    {
        $this->checkImage($image);
        $res = $this->resource($image);
        $water = $this->resource($this->water);
        $position = $this->position($res, $water, $pos);
        imagecopy($res, $water, $position['x'], $position['y'], 0, 0, imagesx($water), imagesy($water));
        return $this->showAction($image)($res, $filename ?? $image);
    }
    //获取水印位置
    protected function position($res, $water, $pos)
    {
        $info = ['x' => 20, 'y' => 20];
        switch ($pos) {
            case 1:
                break;
            case 2:
                $info['x'] = (imagesx($res) - imagesx($water)) / 2;
                // $info['x'] = imagesx($res) / 3;
                break;
            case 3:
                $info['x'] = (imagesx($res) - imagesx($water)) - 30;
                break;
            case 4:
                $info['y'] = (imagesy($res) - imagesy($water)) / 2;
                break;
            case 5:
                $info['x'] = (imagesx($res) - imagesx($water)) / 2;
                $info['y'] = (imagesy($res) - imagesy($water)) / 2;
                break;
            case 6:
                $info['x'] = (imagesx($res) - imagesx($water)) - 30;
                $info['y'] = (imagesy($res) - imagesy($water)) / 2;
                break;
            case 7:
                $info['y'] = (imagesy($res) - imagesy($water)) - 30;
                break;
            case 8:
                $info['x'] = (imagesx($res) - imagesx($water)) / 2;
                $info['y'] = (imagesy($res) - imagesy($water)) - 30;
                break;
            case 9:
                $info['x'] = (imagesx($res) - imagesx($water)) - 30;
                $info['y'] = (imagesy($res) - imagesy($water)) - 30;
                break;
        }
        return $info;
    }
    //图片检测
    protected function checkImage($image)
    {
        if (!is_file($image) || getimagesize($image) == false) {
            throw new Exception('file is not image');
        }
    }
    //显示生成图片
    protected function showAction(string $image)
    {
        $info = getimagesize($image);
        $functions = [
            1 => 'imagegif',
            2 => 'imagejpeg',
            3 => 'imagepng'
        ];
        return $functions[$info[2]];
    }
    //根据图片生成面板
    protected function resource(string $image)
    {
        $info = getimagesize($image);
        $functions = [
            1 => 'imagecreatefromgif',
            2 => 'imagecreatefromjpeg',
            3 => 'imagecreatefrompng'
        ];
        // print_r($info);
        $call = $functions[$info['2']]; //获取生成图片面板
        return $call($image); //返回生成图片面板函数
    }
}
