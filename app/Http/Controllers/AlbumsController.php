<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\{Artist,Albums,Tracks};

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $album_attr = $params['album'];
        $track_attr = $params['album']['tracks'];
        $validate = $params->validate([
             'album.album_title' => ['required'],
             'album.artist_id' => ['required']
        ]);
        if($validate){
            $artist = Artist::find($album_attr["artist_id"]);
            DB::beginTransaction();
            if($artist){
                $album = Albums::create([
                    'artist_id'=>$album_attr['artist_id'],
                    'album_title'=>$album_attr['album_title'],
                    'album_cover'=>$album_attr['album_cover']
                ]);
                if(!empty($track_attr)){
                    foreach ($track_attr as $key => $value) {
                        $track_attr[$key]['artist_id'] = $album_attr['artist_id'];
                        $track_attr[$key]['album_id'] = $album["album_id"];
                        $tracks_inserted = Tracks::create($track_attr[$key]);   
                    }
                }
                DB::commit();
                return response("success", 200);
            }else{
                DB::rollback();
                return response("Artist not found", 401);
            }
        }else{
            return $validate;
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
