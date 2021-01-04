<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChannelResource;
use App\Categore;
use App\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categore::all();
        $data = Channel::with(['category'])->get();
        return view('setting.pages.channel.index')->with(['data' => $data, 'category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.pages.channel.create')->with([]);
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
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'category' => 'required|exists:categores,id',
            'star' => 'required|numeric|gt:0|lte:5',
            'state' => 'sometimes|in:on,' . null,
            'imgs' => 'image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);
        $channel = new Channel;
        $channel->ch_title = $request->title;
        $channel->ch_subtitle = $request->subtitle;
        $channel->ch_link = $request->link;
        $channel->ch_star = $request->star;
        $channel->ch_category = $request->category;
        $channel->ch_state =  $request->state == 'on' ? 1 : 0;
        $channel->ch_image =  isset($request->imgs)  ? $request->imgs->store('uploads', 'public') : null;
        $channel->ch_admin = $request->user()->id;
        if ($channel->save()) {
            return redirect()->back()->withSuccess('Added Channel Successfully !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $channel = Channel::findOrfail($id);
        return view('setting.pages.channel.create')->with(['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $channel = Channel::findOrfail($id);
        $channel->ch_state = !$channel->ch_state;
        if ($channel->save()) {
            return new ChannelResource($channel);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'category' => 'required|exists:categores,id',
            'star' => 'required|numeric|gt:0|lte:5',
            'state' => 'sometimes|in:on,' . null,
            'imgs' => 'image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);
        $channel = Channel::findOrFail($id);
        $channel->ch_title = $request->title;
        $channel->ch_subtitle = $request->subtitle;
        $channel->ch_link = $request->link;
        $channel->ch_category = $request->category;
        $channel->ch_star = $request->star;
        $channel->ch_state =  $request->state == 'on' ? 1 : 0;
        $channel->ch_image =  isset($request->imgs)  ? $request->imgs->store('uploads', 'public') : $channel->ch_image;
        $channel->ch_admin = $request->user()->id;
        if ($channel->save()) {
            return redirect()->back()->withSuccess('Updated Channel Successfully !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $channel = Channel::findOrfail($id);
        if ($channel->delete()) {
            return new ChannelResource($channel);
        }
    }
}
