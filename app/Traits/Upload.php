<?php

namespace App\Traits;

use App\Models\Marker;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait Upload
{
    public static function boot()
    {
        parent::boot();

        self::creating(function($model){

        });

        self::created(function($model){

        });

        self::updating(function($model){
        });

        self::updated(function($model){

        });

        self::deleting(function($model){

        });

        self::deleted(function($model){

        });
    }

    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->save();
        return $post;
    }

    public function edit($fields, $path = null)
    {
        if($path !== null){
            $fields[$path] = $this->$path;
        }
        $this->fill($fields);
        $this->save();
    }

    public function remove($path)
    {
        $this->removeFile($path);
        $this->delete();
    }

    public function removeFile($path)
    {
        if($this->$path != null)
        {
            if (Storage::exists('uploads/' . $this->$path)){
                Storage::delete('uploads/' . $this->$path);
            }
        }
    }

    public function uploadFile($file, $path)
    {
        if($file == null) { return; }
        $this->removeFile($path);
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads', $filename);
        $this->$path = $filename;
        $this->save();
    }

    public function getFile($path)
    {
        if($this->$path == null)
        {
            return '/images/no-image.png';
        }
        else{
            return '/uploads/' . $this->$path;
        }
    }

    public function deleteWithRelations($id, $column)
    {
        $items = Marker::where($column, $id)->get();
        foreach ($items as $item) {
            $item->delete();
        }
    }

    public function getBreedImage($path)
    {
        if($this->$path == null)
        {
            return '/images/no-image.png';
        }
        else{
            return '/images/breeds/' . $this->$path;
        }
    }

    public function uploadBreedImage($file, $path)
    {
        if($file == null) { return; }
        $this->removeBreedImage($path);
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('images/breeds', $filename);
        $this->$path = $filename;
        $this->save();
    }

    public function removeBreedImage($path)
    {
        if($this->$path != null)
        {
            if (Storage::exists('images/breeds/' . $this->$path)){
                Storage::delete('images/breeds/' . $this->$path);
            }
        }
    }
}
