<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;

class BlockController extends Controller
{
  /**
   * Show the blocks dashboard.
   *
   */
  public function index()
  {
    return view('blocks.index')->with('blocks', Block::orderBy('display_name')->get());
  }

  /**
   * Show the block edit form.
   *
   * @return view()
   *
   */
  public function create()
  {
    return view('blocks.form')
      ->with('scripts', ['vendor/unisharp/laravel-ckeditor/ckeditor.js'])
      ->with('action', 'Add');
  }

  /**
   * Show the block edit form.
   *
   * @param $id integer
   *
   * @return view()
   *
   */
  public function edit($id)
  {
    return view('blocks.form')
      ->with('scripts', ['vendor/unisharp/laravel-ckeditor/ckeditor.js'])
      ->with('action', 'Edit')
      ->with('block', Block::findOrFail($id));
  }

  /**
   * Store the block edit form submission.
   *
   * @param $request Illuminate\Http\Request
   *
   * @return redirect()
   *
   */
  public function store(Request $request)
  {
    if ($request->has('id')) {
      $block = Block::findOrFail($request->get('id'));
      $block->display_name = $request->get('display_name');
      $block->title = $request->get('title');
      $block->body = $request->get('body');
    }
    else {
      $block = new Block($request->only(['display_name', 'title', 'body']));
    }

    $block->machine_name = strtolower(str_replace(['-', ' '], '_', $request->get('display_name')));
    $block->save();
    $request->session()->flash('status', 'Saved block.');
    return redirect()->route('blocks.index');
  }
}
