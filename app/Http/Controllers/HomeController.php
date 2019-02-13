<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Google_Service_YouTube;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Call the Youtube API.
     * 
     * @return \Google_Service_YouTube_SearchResult
     */
    public function search(Request $request, Google_Service_YouTube $apiClient)
    {
        // build params
        $params = [
            'maxResults' => 40,
            'q'          => $request->input('term'),
            'type'       => 'video'
        ];

        $results = $apiClient->search->listSearch('snippet', $params)->getItems();
        // if there are results save to session
        if(count($results)) {
            $request->session()->put('searchTerm', $request->input('term'));
            $request->session()->put('searchResults', $results);
        }
        return $results;
    }

    public function view($key)
    {
        $data = session('searchResults')[$key];

        return view('view', ['data' => $data]);
    }
}
