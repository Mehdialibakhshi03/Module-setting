<?php

namespace Modules\Setting\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Setting\app\Models\Setting;
use Modules\Setting\Repositories\SettingRepo;

class SettingController extends Controller
{

    private SettingRepo $settingRepos;

    public function __construct(SettingRepo $settingRepos)
    {
        $this->settingRepos = $settingRepos;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logo = Setting::where('key', 'logo')->pluck('value')->first();
        $fav_icon = Setting::where('key', 'fav_icon')->pluck('value')->first();
        $title = Setting::where('key', 'title')->pluck('value')->first();
        $meta_keywords = Setting::where('key', 'meta_keywords')->pluck('value')->first();
        $robot_index = Setting::where('key', 'robot_index')->pluck('value')->first();
        $meta_description = Setting::where('key', 'meta_description')->pluck('value')->first();
        $footer_logo = Setting::where('key', 'footer_logo')->pluck('value')->first();
        $start_market = Setting::where('key', 'start_market')->pluck('value')->first();
        $end_market = Setting::where('key', 'end_market')->pluck('value')->first();
        $email = Setting::where('key', 'email')->pluck('value')->first();
        $admin_avatar = Setting::where('key', 'admin_avatar')->pluck('value')->first();
        $side_bar_color = Setting::where('key', 'side_bar_color')->pluck('value')->first();
        $top_bar_color = Setting::where('key', 'top_bar_color')->pluck('value')->first();
        $alert_description = Setting::where('key', 'alert_description')->pluck('value')->first();
        $alert_bg_color = Setting::where('key', 'alert_bg_color')->pluck('value')->first();
        $alert_text_color = Setting::where('key', 'alert_text_color')->pluck('value')->first();
        $alert_font_size = Setting::where('key', 'alert_font_size')->pluck('value')->first();
        $alert_height = Setting::where('key', 'alert_height')->pluck('value')->first();
        $alert_active = Setting::where('key', 'alert_active')->pluck('value')->first();
        return view('setting::index', compact('logo',
            'fav_icon',
            'title',
            'meta_keywords',
            'robot_index',
            'meta_description',
            'footer_logo',
            'start_market',
            'end_market',
            'email',
            'admin_avatar',
            'side_bar_color',
            'top_bar_color',
            'alert_description',
            'alert_bg_color',
            'alert_text_color',
            'alert_font_size',
            'alert_height',
        'alert_active'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $settings = Setting::all();
        return view('setting::edit', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $result = $this->settingRepos->update($request);
        return redirect()->back()->with($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($setting)
    {

        $result = $this->settingRepos->delete($setting);
        session()->flash($result[0], $result[1]);
        return \response()->json($result);
    }


}
