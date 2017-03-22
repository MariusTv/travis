<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Texts;
use App\Http\Requests\CreateTextsRequest;
use App\Http\Requests\UpdateTextsRequest;
use Illuminate\Http\Request;



class TextsController extends Controller {

	/**
	 * Display a listing of texts
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $texts = Texts::all();

		return view('admin.texts.index', compact('texts'));
	}

	/**
	 * Show the form for creating a new texts
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    return view('admin.texts.create');
	}

	/**
	 * Store a newly created texts in storage.
	 *
     * @param CreateTextsRequest|Request $request
	 */
	public function store(CreateTextsRequest $request)
	{
	    
		Texts::create($request->all());

		return redirect()->route('admin.texts.index');
	}

	/**
	 * Show the form for editing the specified texts.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$texts = Texts::find($id);
	    
		return view('admin.texts.edit', compact('texts'));
	}

	/**
	 * Update the specified texts in storage.
     * @param UpdateTextsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTextsRequest $request)
	{
		$texts = Texts::findOrFail($id);

        

		$texts->update($request->all());

		return redirect()->route('admin.texts.index');
	}

	/**
	 * Remove the specified texts from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Texts::destroy($id);

		return redirect()->route('admin.texts.index');
	}

}
