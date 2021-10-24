<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\{Artist,Albums,Tracks};
use App\Http\Traits\TrackTrait;

class TracksController extends Controller
{
    use TrackTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = DB::select("SELECT t.track_id,t.artist_id,t.track_name,t.mp3,a.name,ab.album_title,ab.album_id FROM tracks t
                                LEFT JOIN artist a ON t.artist_id = a.artist_id
                                LEFT JOIN albums ab on ab.artist_id = a.artist_id");
        return $tracks;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request;
        $validate = $params->validate([
             'track_name' => ['required']
        ]);
        if($validate){
            $track_id = $this->InsertTrack($params);
            if($track_id){
                 return response("Success", 200);
            }else{
                return response("no file uploaded", 401);
            }

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
