<?php



namespace App;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;



class Picture extends Model

{



public $timestamps = true;



    public function user()

    {

        return $this->belongsToMany(User::class);

    }



    public function getPicture(): string

    {

        if ($this->picture_location == null) {

            return env('APP_URL') . '/pictures/default.png';

        }

        return Storage::url($this->picture_location);

    }



    public function getURL(): string

    {

        $picture = Storage::exists($this->profile_picture);



        if ($picture === false) {



            $picture = $this->profile_picture;

        }

        return $picture;

    }

}

