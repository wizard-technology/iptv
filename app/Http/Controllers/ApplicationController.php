<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppResourse;
use App\Application;
use App\Channel;
use App\ChannelApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Application::orderBy('created_at', 'DESC')->get();
        return view('setting.pages.application.index')->with(['data' => $data]);
    }
    public function deletechannel($id)
    {
        $channelapp = ChannelApp::with('channel')->findOrfail($id);
        if ($channelapp->delete()) {
            return redirect()->back()->withSuccess('Removed Channel Successfully !');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.pages.application.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'access' => 'required|string|max:255',
            'secret' => 'required|string|max:255',
            'fcm' => 'required|string|max:255',
            'platform' => 'required|in:IOS,Android,Desktop,Website',
            'state' => 'required|boolean',
        ]);
        $app = new Application;
        $app->app_name = $request->name;
        $app->app_access = $request->access;
        $app->app_secret = $request->secret;
        $app->app_fcm = $request->fcm;
        $app->app_type = $request->platform;
        $app->app_state = $request->state;
        $app->app_admin = $request->user()->id;
        if ($app->save()) {
            return new AppResourse($app);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = Application::with(['channel.channel'])->findOrfail($id);

        $exception = $application->channel->pluck('channel.id')->toArray();
        $channel = Channel::whereNotIn('id', $exception)->get();
        // dd($exception);
        return view('setting.pages.application.show')->with(['data' => $application, 'out_app' => $channel]);
    }

    public function channelappSet(Request $request, $id)
    {
        $request->validate([
            'channel' => 'required|exists:channels,id',
        ]);
        $channelapp = new ChannelApp;
        $channelapp->ac_app = $id;
        $channelapp->ac_channel = $request->channel;
        $channelapp->ac_admin = $request->user()->id;
        if ($channelapp->save()) {
            return redirect()->back()->withSuccess('Added Channel Successfully !');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Application::findOrfail($id);
        $application->app_state = !$application->app_state;
        if ($application->save()) {
            return new AppResourse($application);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->input();
        $request->validate([
            'name' => 'required|string|max:255',
            'access' => 'required|string|max:255',
            'secret' => 'required|string|max:255',
            'fcm' => 'required|string|max:255',
            'platform' => 'required|in:IOS,Android,Desktop,Website',
            'state' => 'required|boolean',
        ]);
        $app = Application::findOrFail($id);
        $app->app_name = $request->name;
        $app->app_access = $request->access;
        $app->app_secret = $request->secret;
        $app->app_fcm = $request->fcm;
        $app->app_type = $request->platform;
        $app->app_state = $request->state;
        $app->app_admin = $request->user()->id;
        if ($app->save()) {
            return new AppResourse($app);
        }
    }
    public function test(Request $request)
    {
        return $request->input();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::findOrfail($id);
        if ($application->delete()) {
            return new AppResourse($application);
        }
    }
}
