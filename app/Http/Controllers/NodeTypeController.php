<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NodeType;

class NodeTypeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the nodet type dashboard.
   *
   */
  public function index()
  {
    return view('nodetype.index')->with('types', NodeType::orderBy('display_name')->get());
  }

  /**
   * Show the node type edit form.
   *
   */
  public function create()
  {
    return view('nodetype.form')->with('action', 'Add');
  }

  /**
   * Show the node type edit form.
   *
   * @param $id integer
   *
   */
  public function edit($id)
  {
    return view('nodetype.form')
      ->with('action', 'Edit')
      ->with('type', NodeType::findOrFail($id));
  }

  /**
   * Show the node type edit form.
   *
   * @param $id integer
   *
   */
  public function store(Request $request)
  {
    if ($request->has('id')) {
      $type = NodeType::findOrFail($request->get('id'));
    }
    else {
      $type = new NodeType;
      $type->machine_name = str_replace(['-', ' '], '_', $request->get('display_name'));
    }

    $type->display_name = $request->get('display_name');
    $type->save();
    $request->session()->flash('status', 'Saved node type.');
    return redirect()->route('nodetypes.index');
  }
}
