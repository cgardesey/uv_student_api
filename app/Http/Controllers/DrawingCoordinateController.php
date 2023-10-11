<?php

namespace App\Http\Controllers;

use App\DrawingCoordinate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class DrawingCoordinateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                return DrawingCoordinate::all();
            case 'student':
                $instructorcourses = $user->info->instructorCourses;
                $drawing_coordinates = [];
                $instructor_course_drawing_coordinates_arrays = [];
                foreach ($instructorcourses as $instructorcourse) {
                    $instructor_course_drawing_coordinates_arrays[] = $instructorcourse->drawingCoordinates;
                }
                foreach ($instructor_course_drawing_coordinates_arrays as $instructor_course_drawing_coordinates_array) {
                    foreach ($instructor_course_drawing_coordinates_array as $instructor_course_drawing_coordinate) {
                        $drawing_coordinates[] = $instructor_course_drawing_coordinate;
                    }
                }
                return $drawing_coordinates;
            default:
                'default';
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $drawingcoordinateid = Str::uuid();
        DrawingCoordinate::forceCreate(
            ['drawingcoordinateid' => $drawingcoordinateid] +
            $request->all());

        $drawingCoordinate = DrawingCoordinate::where('drawingcoordinateid', $drawingcoordinateid)->first();

        return response()->json($drawingCoordinate);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\DrawingCoordinate  $drawingCoordinate
     * @return \Illuminate\Http\Response
     */
    public function show(DrawingCoordinate $drawingCoordinate)
    {
        return $drawingCoordinate;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DrawingCoordinate  $drawingCoordinate
     * @return \Illuminate\Http\Response
     */
    public function edit(DrawingCoordinate $drawingCoordinate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DrawingCoordinate  $drawingCoordinate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DrawingCoordinate $drawingCoordinate)
    {
        $drawingCoordinate->update($request->all());

        $updated_drawing_coordinate = DrawingCoordinate::where('drawingcoordinateid', $drawingCoordinate->drawingcoordinateid)->first();

        return response()->json($updated_drawing_coordinate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DrawingCoordinate  $drawingCoordinate
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrawingCoordinate $drawingCoordinate)
    {
        //
    }

    public function getSessionCoordinates(Request $request)
    {
        return DB::table('drawing_coordinates')->where('classsessionid', request('sessionid'))->get();
    }

    public function getSessionData(Request $request)
    {
        $drawing_coordinates = DB::table('drawing_coordinates')->where('classsessionid', request('sessionid'))->get();
        $pdfpath_objs = DB::table('drawing_coordinates')
            ->select('pdfpath')
            ->whereNotNull ('pdfpath')
            ->where ('pdfpath', '!=' , '')
            ->where('classsessionid', request('sessionid'))
            ->groupBy('pdfpath')
            ->get();
        $pdfpaths = [];
        foreach ($pdfpath_objs as $pdf_urls_obj) {
            $pdfpaths[] = $pdf_urls_obj->pdfpath;
        }

        return Response::json(array(
            'drawing_coordinates' => $drawing_coordinates,
            'password' => 'kowsamadmin404@prepeez.com',
            'pdfpaths' => $pdfpaths
        ));
    }

    public function getSessionDrawingCoordinates(Request $request)
    {
        return DB::table('drawing_coordinates')->where('classsessionid', request('sessionid'))->get();
    }
}
