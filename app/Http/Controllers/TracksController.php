<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\{Artist,Albums,Tracks,TracksToArtist,TracksToAlbum};

class TracksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = DB::select("SELECT t.track_id,t.artist_id,t.track_name,a.name,ab.album_title,ab.album_id FROM tracks t
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
            if($params['album_id']){
                
            }else{
                Tracks::create([
                    'track_name' => $params["track_name"],
                    'mp3' => $params['mp3'],
                    'lyrics' => $params['lyrics'],
                    'artist_id' => $params["artist_id"]
                ]);
            }
            return response("Success", 200);
           
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
