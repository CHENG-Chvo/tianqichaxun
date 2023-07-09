<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Http;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->param('location'); // 获取用户发送的地点

        $api_key = "PeKpZPeGMdYI-Cdno"; // 在心知天气官网注册并获取API Key
        $api_url = "https://api.seniverse.com/v3/weather/now.json?key={$api_key}&location={$location}&language=zh-Hans&unit=c";

        $response = Http::get($api_url);
        $data = json_decode($response->getBody(), true);

        // 解析天气信息
        if (isset($data["results"])) {
            $weather = $data["results"][0]["now"]["text"];
            $temperature = $data["results"][0]["now"]["temperature"];
            return "地点：{$location}\n天气：{$weather}\n温度：{$temperature}℃";
        } else {
            return "无法获取天气信息，请检查地点是否正确。";
        }
    }
}
