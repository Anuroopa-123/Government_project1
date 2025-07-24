<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\URL;

use App\Http\Controllers\Controller;
use App\Models\Entrepreneurship;
use App\Models\Event;
use App\Models\Member;
use App\Models\Hackathon;
use App\Models\Job;
use App\Models\MediaCategory;
use App\Models\MediaItem;
use App\Models\News;
use App\Models\Slider;
use App\Models\Workshop;

class FrontendResourceController extends Controller
{
    public function entrepreneurships()
    {
        $result = Entrepreneurship::where('is_published', true)
                                    ->orderBy('created_at','desc')
                                    ->get()->toArray();
        return $result;
    }

    public function events($category)
    {
        $result = Event::where('is_published', true)
                        ->where('category',$category)
                        ->get()->toArray();
        return $result;
    }

    public function hackathons()
    {
        $result = Hackathon::where('is_published', true)->with('showcaseImages')->get();
        return $result;
    }

    public function jobs()
    {
        $result = Job::where('is_published', true)->get()->toArray();
        return $result;
    }

    public function mediaCategories()
    {
        $result = MediaCategory::where('is_published', true)->get()->toArray();
        return $result;
    }

    public function mediaItems($category)
    {
        $result = MediaItem::where('is_published', true)
                            ->where('category',$category)
                            ->get()->toArray();
        return $result;
    }

  public function news()
{
    $result = News::where('is_published', true)->get();

    return response()->json([
        'status' => 'success',
        'data' => $result,
    ]);
}


    public function sliders()
    {
        $result = Slider::where('is_published', true)->get()->toArray();
        return $result;
    }
    // Updated workshops() to return video URL instead of image
    public function workshops()
    {
        $workshops = Workshop::where('is_published', true)->get(['id', 'video', 'is_published', 'created_at', 'updated_at']);

        $workshops->transform(function ($workshop) {
            if ($workshop->video && is_string($workshop->video)) {
                $workshop->video_url = URL::to($workshop->video);
            } else {
                $workshop->video_url = null;
            }
            return $workshop;
        });

        return response()->json([
            'status' => 'success',
            'data' => $workshops,
        ]);
    }
     public function getHeaderContent()
    {
        $sliders = Slider::where('is_published', 1)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get(['id', 'slider_image', 'slider_title']);

        $sliders->transform(function ($slider) {
            $slider->slider_image = asset($slider->slider_image);
            return $slider;
        });

        return response()->json([
            'status' => 'success',
            'data' => $sliders,
        ]);
    }
    public function index()
{
    // Directly query for members where the role is not null
    $members = Member::where('role', '!=', null)->get();

    return response()->json([
        'status' => 'success',
        'data' => $members,  // Return the members data directly
    ]);
}
public function heroContent()
{
    $latestWorkshop = Workshop::where('is_published', true)
                                ->latest()
                                ->first(['id', 'video', 'created_at']);

    if ($latestWorkshop) {
        $latestWorkshop->video_url = $latestWorkshop->video
            ? URL::to($latestWorkshop->video)
            : null;
    }

    return response()->json([
        'status' => 'success',
        'data' => $latestWorkshop,
    ]);
}



}
