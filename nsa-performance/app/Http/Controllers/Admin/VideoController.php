<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
  public function index()
  {
    $videos = Video::latest()->paginate(10);
    return view('admin.videos.index', compact('videos'));
  }

  public function create()
  {
    return view('admin.videos.create');
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'title'   => 'required',
      'excerpt' => 'nullable',
      'url'     => 'required',
      'status'  => 'required|in:draft,published',
    ]);

    $data['published_at'] = $data['status'] === 'published' ? now() : null;

    Video::create($data);

    return redirect()->route('admin.videos.index')->with('success', 'Video created successfully.');
  }

  public function edit(Video $video)
  {
    return view('admin.videos.edit', compact('video'));
  }

  public function update(Request $request, Video $video)
  {
    $data = $request->validate([
      'title' => 'required',
      'excerpt' => 'nullable',
      'url' => 'required',
      'status' => 'required|in:draft,published',
    ]);

    $data['published_at'] = $data['status'] === 'published' ? now() : null;

    $video->update($data);

    return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully.');
  }

  public function destroy(Video $video)
  {
    $video->delete();

    return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully.');
  }

  public function togglePublish(Video $video)
  {
    if ($video->status === 'published') {
      $video->update([
        'status' => 'draft',
        'published_at' => null
      ]);
    } else {
      $video->update([
        'status' => 'published',
        'published_at' => now()
      ]);
    }

    return response()->json([
      'status' => $video->status,
      'published_at' => optional($video->published_at)->format('d M Y H:i'),
    ]);
  }
}
