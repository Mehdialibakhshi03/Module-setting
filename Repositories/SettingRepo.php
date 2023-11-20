<?php

namespace Modules\Setting\Repositories;

use Illuminate\Http\Client\Request;
use Modules\Setting\App\Models\Setting;



class SettingRepo
{

    public function update($request)
    {
        try {
            $logo = $this->fileUploader($request, 'logo');
            $fav_icon = $this->fileUploader($request, 'fav_icon');
            $footer_logo = $this->fileUploader($request, 'footer_logo');
            $admin_avatar = $this->fileUploader($request, 'admin_avatar');
            $title = $request->title;
            $meta_keywords = $request->meta_keywords;
            $robot_index = $request->robot_index;
            $meta_description = $request->meta_description;
            $start_market = $request->start_market;
            $end_market = $request->end_market;
            $email = $request->email;
            $top_bar_color = $request->top_bar_color;
            $side_bar_color = $request->side_bar_color;
            $array = [
                'logo' => $logo,
                'fav_icon' => $fav_icon,
                'footer_logo' => $footer_logo,
                'title' => $title,
                'meta_keywords' => $meta_keywords,
                'robot_index' => $robot_index,
                'email' => $email,
                'meta_description' => $meta_description,
                'start_market' => $start_market,
                'end_market' => $end_market,
                'admin_avatar' => $admin_avatar,
                'top_bar_color' => $top_bar_color,
                'side_bar_color' => $side_bar_color,
            ];
            foreach ($array as $key => $value) {
                Setting::where("key", $key)->update(["value"=> $value]);
            }
            return ['success'=>'Items updated successfully'];
        }catch (\Exception $exception){
            return ['failed'=>$exception->getMessage()];
        }

    }
    public function delete($setting){
        try {
            $setting=Setting::where("value", $setting)->firstOrFail();
            $setting->update(['value'=>null]);
            return [0=>'success',1=>'Items deleted successfully'];
        }catch (\Exception $exception){
            return [0=>'failed',1=>$exception->getMessage()];
        }
    }
    private function fileUploader($request, $file_name)
    {
        if ($request->has($file_name)) {
            $env = env('UPLOAD_SETTING');
            $fileNameImage = generateFileName($request->$file_name->getClientOriginalName());
            $request->$file_name->move(public_path($env), $fileNameImage);
        } else {
            $fileNameImage = Setting::where('key', $file_name)->pluck('value')->first();
        }
        return $fileNameImage;
    }







}
