<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\{Tracks};

trait TrackTrait {
	public function InsertTrack($req, $keys=[], $p='',$req_flag=true){

		if(!$req_flag)
			$file_path = $this->up($p,$keys);
		else
			$file_path = $this->up($req);
		if($file_path){
			$newUrl = $file_path;
			$track = Tracks::create([
                    'track_name' => $req["track_name"],
                    'mp3' => $newUrl,
                    'lyrics' => $req['lyrics'],
                    'artist_id' => $req["artist_id"],
                    'album_id' => $req["album_id"]
            ]);
            return $track;
		}else{
			return null;
		}

	}
	public function up($req,$flg=[])
    {
    	if(!empty($flg)){
    		if(count($flg) == 1){
    			$st = "artist.tracks_to_artist." . $flg[0] .".audio";
    		}else{
    			$st = "artist.albums." . $flg[0].".tracks_to_album." . $flg[1] .".audio";
    		}
    		
    	}else{
    		$st = 'audio';
    	}

        if(!$req->hasFile($st)) {
            return null;
        }else{
        	$rl = url('/');
            preg_match("/[^\/]+$/", $rl, $matches);
            $params_a_file = $req->file($st);
            $originalFileName = $params_a_file->getClientOriginalName();
            $size = $params_a_file->getSize();
            $file_ext = $params_a_file->getClientOriginalExtension();
            $path = $params_a_file->storeAs('/public/audio',$originalFileName);
            $newUrl = str_replace($matches[0],'',$rl)."/storage/app/" . $path;
            return $newUrl;
        }    
    }
}