<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.dashboard');
    }

    public function category() 
    {   
        $categories = DB::select('SELECT * FROM `categories`');
        return view('pages.admin.categories', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $id = uniqid();
        $name = $request->categoryName;
        DB::select('INSERT INTO `categories`(`id`, `name`, `status`) VALUES ("'.$id.'", "'.$name.'", "Active")');
        return redirect()->back();
    }

    public function updateStatus($id)
    {
        $currentStatus = DB::select("SELECT status FROM `categories` WHERE id = '".$id."'");

        foreach($currentStatus as $status)
        {
            $currStat = $status->status;
        }
            if ($currStat == "Active")
            {   
                DB::select('UPDATE categories SET status = "InActive" WHERE id = "'.$id.'"');
            }
            else
            {
                DB::select('UPDATE categories SET status = "Active" WHERE id = "'.$id.'"');
            }

            $newStatus = DB::select("SELECT status FROM `categories` WHERE id = '".$id."'");

        foreach ($newStatus as $status)
        {
            $updatedStatus = $status->status;
        }
            
        return $updatedStatus;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
