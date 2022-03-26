<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $video_lists = VideoList::all();
        $videos = Video::where('isActive',1)->get();
        return view('videolist.index',compact('video_lists','videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=>['required'],
                'link'=>['required','url'],
                'video'=>['required'],
            ],
            [
                'name.required'=>'Name is required.',
                'link.required'=>'Link is required.',
                'link.url'=>'Please insert valid link.',
                'video.required'=>'Video is required.',
            ]
        );
        DB::beginTransaction();
        try {
            $videolist = new VideoList();
            $videolist->name=$request->input('name');
            $videolist->link=$request->input('link');
            $videolist->video_id=$request->input('video');
            $videolist->save();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Error While Adding Video List');
        }
        DB::commit();
        return redirect()->back()->with('success','Video List Added Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoList  $videoList
     * @return \Illuminate\Http\Response
     */
    public function show(VideoList $videoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoList  $videoList
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video_list = VideoList::find($id);
        $videos = Video::where('isActive',1)->get();
        return view('videolist.edit',compact('video_list','videos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoList  $videoList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name'=>['required'],
                'link'=>['required','url'],
                'video'=>['required'],
            ],
            [
                'name.required'=>'Name is required.',
                'link.required'=>'Link is required.',
                'link.url'=>'Please insert valid link.',
                'video.required'=>'Video is required.',
            ]
        );
        DB::beginTransaction();
        try {
            $videolist = VideoList::find($id);
            $videolist->name=$request->input('name');
            $videolist->link=$request->input('link');
            $videolist->video_id=$request->input('video');
            $videolist->update();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Error While Updating Video List');
        }
        DB::commit();
        return redirect()->route('videoList.index')->with('success','Video List Updated Successfully!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoList  $videoList
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $video = VideoList::find($id);
            $video->delete();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Error While Deleting Video List');
        }
        DB::commit();
        return redirect()->back()->with('success','Video List Deleted Successfully!!');
    }
}
