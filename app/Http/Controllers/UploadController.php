<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function create()
	{
		return view('uploads.create');
	}
	
	public function store(Request $request)
	{
		$this->validate($request, [
		'name' => 'required',
		'image' => 'required|mimes:jpeg,png,jpg',
		'file' => 'required|mimes:pdf,doc,docx',
		]);
		
		$input = $request->all();
		
		$imageName = '';
		if ($request->hasFile('image')) {
			$imageExtension = $request->file('image')->getClientOriginalExtension();
			$imageName = 'image_'.time().'.'.$imageExtension; //file akan disimpan dg nama image_waktu upload, itu terserah, bisa namanya saja
			$imageDestination = base_path() . '/public/uploads';
			$request->file('image')->move($imageDestination, $imageName);
			$input['image'] = $imageName;
		}
		
		$fileName = '';
		if ($request->hasFile('file')) {
			$fileExtension = $request->file('file')->getClientOriginalExtension();
			$fileName = 'file_'.time().'.'.$fileExtension;
			$fileDestination = base_path() . '/public/uploads'; //akan disimpan di folder public/uploads
			$request->file('file')->move($fileDestination, $fileName);
			$input['file'] = $fileName;
		}
		
		$upload = Upload::create($input);
		return redirect()->route('upload.index')
		->with('success','Image/file successfully added');
	}
}
