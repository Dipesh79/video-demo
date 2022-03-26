<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        return view('video.index',compact('videos'));
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
                'title'=>['required'],
                'description'=>['required'],
            ],
            [
                'title.required'=>'Title is required.',
                'description.required'=>'Description is required.'
            ]
        );
        DB::beginTransaction();
        try {
            $video = new Video();
            $video->title=$request->input('title');
            $video->description=$request->input('description');
            $video->save();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Error While Adding Video.');
        }
        DB::commit();
        return redirect()->back()->with('success','Video Added Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        return view('video.edit',compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title'=>['required'],
                'description'=>['required'],
            ],
            [
                'title.required'=>'Title is required.',
                'description.required'=>'Description is required.'
            ]
        );
        DB::beginTransaction();
        try {
            $video = Video::find($id);
            $video->title=$request->input('title');
            $video->description=$request->input('description');
            $video->update();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Error While Updating Video.');
        }
        DB::commit();
        return redirect()->route('video.index')->with('success','Video Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $video = Video::find($id);
            $video->delete();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Error While Deleting Video.');
        }
        DB::commit();
        return redirect()->back()->with('success','Video Deleted Successfully!!');
    }

    public function activate($id)
    {
        DB::beginTransaction();
        try {
            $video = Video::find($id);
            $video->isActive=1;
            $video->update();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Error While Activating Video.');
        }
        DB::commit();
        return redirect()->route('video.index')->with('success','Video Activated Successfully!!');
    }

    public function deactivate($id)
    {
        DB::beginTransaction();
        try {
            $video = Video::find($id);
            $video->isActive=0;
            $video->update();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Error While Deactivating Video.');
        }
        DB::commit();
        return redirect()->route('video.index')->with('success','Video Deactivated Successfully!!');
    }
}
