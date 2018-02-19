<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
use App\NodeType;

class NodeController extends Controller
{
  /**
   * Show the nodes dashboard.
   *
   */
  public function index()
  {
    return view('nodes.index')->with('nodes', Node::orderBy('title')->get());
  }

  /**
   * Show the node edit form.
   *
   */
  public function create()
  {
    return view('nodes.form')
      ->with('types', NodeType::orderBy('display_name')->get())
      ->with('action', 'Add');
  }

  /**
   * Show the node edit form.
   *
   * @param $id integer
   *
   */
  public function edit($id)
  {
    return view('nodes.form')
      ->with('types', NodeType::orderBy('display_name')->get())
      ->with('action', 'Edit')
      ->with('node', Node::findOrFail($id));
  }

  /**
   * Store the node edit form submission.
   *
   * @param $request Illuminate\Http\Request
   *
   */
  public function store(Request $request)
  {
    if ($request->has('id')) {
      $node = Node::findOrFail($request->get('id'));
      $node->title = $request->get('title');
      $node->body = $request->get('body');
      $node->node_type_id = $request->get('node_type_id');
    }
    else {
      $node = new Node($request->only(['title', 'body', 'node_type_id']));
    }

    $node->slug = str_slug($node->title);
    $node->save();
    $request->session()->flash('status', 'Saved node.');
    return redirect()->route('nodes.index');
  }

  /**
   * Show a single node.
   *
   * @param $id integer
   *
   */
  public function show($id)
  {
    return view('nodes.show')
      ->with('node', Node::findOrFail($id));
  }

  /**
   * Show a single node on a prettified URL.
   *
   * @param $id string
   *
   */
  public function slug($slug)
  {
    $node = Node::where('slug', $slug)->first();
    if(!isset($node)) {
      abort(404);
    }

    return view('nodes.show')
      ->with('node', $node);
  }
}
