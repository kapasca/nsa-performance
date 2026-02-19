<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
  public function latest(Request $request)
  {
    $limit  = (int) $request->get('limit', 3);
    $offset = (int) $request->get('offset', 0);

    $videos = Video::where('status', 'published')
      ->latest();

    return response()->json([
      'data'  => $videos->skip($offset)->take($limit)->get(),
      'total' => $videos->count(),
    ]);
  }

  public function show($id)
  {
    $video = Video::findOrFail($id)
      ->where('status', 'published')
      ->firstOrFail();

    return view('videos.show', compact('video'));
  }
}
