<?php

namespace App\Http\Controllers\Play;

use App\Facades\Leancloud;
use App\Http\Controllers\Controller;
use App\Models\Liveinfo;
use App\Models\User;
use App\Models\Userinfo;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiveController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //首页顶部直播获取
        $random_live = Liveinfo::select('activityId')->where('ctime', '>', time() - 43200)->orderByRaw("RAND()")->first();

        if ($random_live) {
            $activityId = $random_live['activityId'];
        } else {
            $activityId = 'A2016060100001e4';
        }

        //获取正在进行的直播数量
        $living_count = Liveinfo::where('ctime', '>', time() - 43200)->count();
        //获取最后创建的4个直播
        $live_info = [];
        $living_user = Liveinfo::select('uid')->where('ctime', '>', time() - 43200)->orderBy('id', 'desc')->limit(4)->get();
        foreach ($living_user as $user) {
            $arr['uid'] = $user['uid'];
            $user_info = Userinfo::select('cover', 'room_name', 'room_desc')->where('uid', $user['uid'])->first();
            $user_email = User::select('email')->where('id', $user['uid'])->first();
            $arr['title'] = $user_info['room_name'];
            $arr['email'] = $user_email['email'];
            $arr['cover'] = $user_info['cover'];
            $arr['description'] = $user_info['room_desc'];
            array_push($live_info, $arr);
        }

        return view('video.index', [
            'activityId' => $activityId,
            'living_count' => $living_count,
            'live_info' => $live_info
        ]);
    }

    /**
     * 正在进行的全部直播
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        $living_info = [];
        $living_user = Liveinfo::select('uid', 'title')->where('ctime', '>', time() - 43200)->orderBy('id', 'desc')->get();
        foreach ($living_user as $user) {
            $arr['uid'] = $user['uid'];
            $user_info = Userinfo::select('cover', 'room_name', 'room_desc')->where('uid', $user['uid'])->first();
            $user_email = User::select('email')->where('id', $user['uid'])->first();
            $arr['email'] = $user_email['email'];
            $arr['cover'] = $user_info['cover'];
            $arr['title'] = $user_info['room_name'] ? $user_info['room_name'] : 'Niconiconi';
            $arr['description'] = $user_info['room_desc'] ? $user_info['room_desc'] : '暂无简介';
            array_push($living_info, $arr);
        }

        $live_count = count($living_info);

        return view('video.all', [
            'title' => '全部直播',
            'count' => $live_count,
            'liveInfo' => $living_info,
        ]);
    }

    /**
     * 直播房间页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getLive($id, Request $request)
    {
        $live_info = DB::table('liveinfo')->select('title', 'activityId', 'liveId')->where('uid', $id)->first();
        $user = User::select('name', 'email')->where('id', $id)->first();
        //判断有无该user
        if (!$user) {
            return redirect()->route('index');
        }
        //获取用户详细信息
        $user_info = Userinfo::select('roomId', 'room_name', 'room_desc', 'long_desc')->where('uid', $id)->first();

        if (!$user_info['roomId']) {
            $json = Leancloud::createRoom('room' . $id);
            $res_arr = json_decode($json, true);
            $roomId = array_key_exists('objectId', $res_arr) ? $res_arr['objectId'] : false;
            if ($roomId) {
                Userinfo::where('uid', $id)->update([
                    'roomId' => $roomId
                ]);
            }
        } else {
            $roomId = $user_info['roomId'];
        }

        $title = $user_info['room_name'];
        $description = Markdown::convertToHtml($user_info['long_desc']);

        if ($live_info) {
            $activityId = $live_info->activityId;
        } else {
            $activityId = null;
        }

        $name = $user->name;
        $email = $user->email;
        $appId = Leancloud::getAppId();

        return view('video.flash', [
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'name' => $name,
            'activityId' => $activityId,
            'email' => $email,
            'appId' => $appId,
            'roomId' => $roomId,
        ]);
    }
}
