<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\{Artist,Albums,Tracks};


class ArtistController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Artist::all();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request;
        $artist_attr = $params['artist'];
        $album_attr = $artist_attr['albums'];
        $track_attr = $artist_attr['tracks_to_artist'];  
        $validate = $params->validate([
             'artist.name' => ['required','unique:artist,name']
        ]);
        if($validate){
            DB::beginTransaction();
            $artist = Artist::create([
                'name' => $artist_attr['name'],
                'user_id' => 1
            ]);
            $artist_id = $artist['artist_id'];
            if(empty($album_attr) && empty($track_attr)){
                DB::commit();    
            }else{
                if(!empty($album_attr)){
                    foreach($album_attr as $value){
                        $aData = [
                                    'artist_id'=>$artist_id,
                                    'album_title'=>$value['album_title'],
                                    'album_cover'=>$value['album_cover']
                                ];
                        $album = Albums::create($aData);
                        $album_id = $album['album_id'];
                        if(!empty($value["tracks_to_album"])){
                            foreach($value["tracks_to_album"] as $vx){
                                if($vx['track_name'] =="" || $vx['mp3']==""){
                                    DB::rollback();
                                    return response("Please fill out the form", 401);
                                }
                                $vx["artist_id"] = $artist_id;
                                $vx['album_id'] = $album_id;
                                $tracks = Tracks::create($vx);
                            }
                        }
                    }
                }
                if(!empty($track_attr)){
                    foreach($track_attr as $value){
                        if($value['track_name'] =="" || $value['mp3']==""){
                            DB::rollback();
                            return response("Please fill out the form", 401);
                        }
                        $value["artist_id"] = $artist_id;
                        $value['album_id'] = null;
                        $tracks = Tracks::create($value);
                    } 
                }
            }
            DB::commit();
            return response("Success", 200);
        }else{
            return $validate;
        }
    }
    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist= Artist::firstWhere('artist_id', $id);
        if($artist){
            return response($artist,200);
        }else{
            return response("Not Found",401);
        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request;
        $artist_attr = $params['artist'];
        $album_attr = $artist_attr['artist_album'];
        $track_attr = $params["tracks_to_artist"];
        $find_artist = Artist::find($id);
        $validate = $params->validate([
            'artist.name' => ['required']
        ]);
        DB::beginTransaction();
        if($validate){
            try {
                $find_artist->update(['name' => $artist_attr["name"]]);
            }catch (\Exception $e) {
                DB::rollback();
                return response($e->getMessage(),401);
            }
            if(!empty($album_attr)){
                foreach($album_attr as $value){
                    $find_album = Albums::find($value["album_id"]);
                    $find_album->update($value);
                    if(!empty($value["tracks_to_album"])){
                        foreach ($value["tracks_to_album"] as $val) {
                            $find_track = Tracks::find($val["track_id"]);
                            unset($val["track_id"]);
                            $find_track->update($val);
                        }
                    }
                }
            }
            if(!empty($track_attr)){
                foreach($track_attr as $value){
                    $find_track = Tracks::find($val["track_id"]);
                    unset($value["track_id"]);
                    $find_track->update($value);
                }
            }
            DB::commit();
            return response("successfully updated",201);
        }
          
        
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $artist = Artist::find($id);
        if($artist){
            try {
                $artist->delete();
            } catch (\Exception $e) {
                return response($e->getMessage(),401);
            }  
        }else{
            return response("Nothing to delete",401);
        }
    }
    ////
    public function artistFillter(Request $request){
        return "test";
    }
}
