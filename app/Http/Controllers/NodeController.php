<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
use App\NodeType;
use App\File;

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
      ->with('scripts', ['vendor/unisharp/laravel-ckeditor/ckeditor.js'])
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
      ->with('scripts', ['vendor/unisharp/laravel-ckeditor/ckeditor.js'])
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
      $title_constraints = 'required|string|max:255';
    }
    else {
      $title_constraints = 'required|string|max:255|unique:blocks';
    }
    $constraints = [
      'title' => $title_constraints,
      'node_type_id' => 'required'
    ];

    $uploaded_file = $request->file('image');
    if (!empty($uploaded_file)) {
      $constraints['file_id'] = 'image';
    }

    $this->validate($request, $constraints);

    if ($request->has('id')) {
      $node = Node::findOrFail($request->get('id'));
      $node->title = $request->get('title');
      $node->body = $request->get('body');
      $node->node_type_id = $request->get('node_type_id');
    }
    else {
      $node = new Node($request->only(['title', 'body', 'node_type_id']));
    }

    if (!empty($uploaded_file)) {
      $path = $uploaded_file->store('public/' . Node::NODE_IMAGES_DIR);
      $saved_file = new File;
      $saved_file->filepath = Node::NODE_IMAGES_DIR . '/' . $uploaded_file->hashName();
      $saved_file->handleUploadedFile($uploaded_file);
      $node->file_id = $saved_file->id;
    }
    else {
      $node->file_id = NULL;
    }

    $node->slug = str_slug($node->title);
    $node->save();
    $request->session()->flash('status', 'Saved node.');
    return redirect()->route('nodes.list');
  }

  /**
   * Show a single node.
   *
   * @param $id integer
   *
   */
  public function show($id)
  {
    $node = Node::findOrFail($id);

    if (!$node->status) {
      abort(404);
    }

    return view('nodes.show')
      ->with('node', $node);
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

  /**
   * Store an image uploaded in ckeditor.
   *
   * @param $request Illuminate\Http\Request
   *
   */
  public function ckimage(Request $request) {
    // $path = $request->file('upload')->store('nodes');
    // return $path;

    $CKEditor = $request->get('CKEditor');
    $funcNum = $request->get('CKEditorFuncNum');
    $message = $url = '';
    if ($request->hasFile('upload')) {
      $file = $request->file('upload');
      if ($file->isValid()) {
        $filename = $file->getClientOriginalName();
        $file->move(storage_path().'/nodes/', $filename);
        $url = public_path() .'/nodes/' . $filename;
      } else {
        $message = 'An error occured while uploading the file.';
      }
    } else {
        $message = 'No file uploaded.';
    }

    return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
  }

  /**
   * Set the node status.
   *
   * @param $id integer
   *
   * @return redirect()
   *
   */
  public function status($id, Request $request)
  {
    $node = Node::findOrFail($id);
    $node->status = !$node->status;
    $node->save();
    $request->session()->flash('status', 'Node status changed.');
    return redirect()->route('nodes.list');
  }

  /**
   * Request confirmation of delete.
   *
   * @param $id integer
   *
   * @return view()
   *
   */
  public function delete($id)
  {
    return view('nodes.delete')
      ->with('node', Node::findOrFail($id));
  }

  /**
   * Delete a node.
   *
   * @param $id integer
   * @param $request Illuminate\Http\Request
   *
   * @return view()
   *
   */
  public function deleteConfirmed($id, Request $request)
  {
    $node = Node::findOrFail($id);
    $node->delete();
    $request->session()->flash('status', 'Node deleted.');
    return redirect()->route('nodes.list');
  }
}
