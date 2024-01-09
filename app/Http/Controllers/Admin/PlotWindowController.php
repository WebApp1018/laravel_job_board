<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\PlotType;

use Illuminate\Http\Request;
use DB;
class PlotWindowController extends Controller
{
    public function addPlotWindow(Request $request){
        return view('admin.plot_window.plotWindow');
    }
 
}
