<?php

class PostsController extends BaseController {
	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$nap = new stdClass();
		$nap->name = "nap";
		$nap->age = 18;

		$nan = new stdClass();
		$nan->name = "nan";
		$nan->age = 20;

		$a = array($nap, $nan);

		$mom = new stdClass();
		$mom->name = "saona";
		$mom->age = 19;

		array_push($a, $mom);	
					
		return Response::json($a, 200);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$nap = new stdClass();
		$nap->name = "nap";
		$nap->age = 18;

		$nan = new stdClass();
		$nan->name = "nan";
		$nan->age = 20;

		$a = array($nap, $nan);

		$mom = new stdClass();
		$mom->name = "saona";
		$mom->age = 19;

		array_push($a, $mom);

		if ($id >= count($a))
			return Response::json("Error", 406);

		if (!is_numeric($id))
			return Response::json("Not a number", 406);

		return Response::json($a[$id], 200);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
