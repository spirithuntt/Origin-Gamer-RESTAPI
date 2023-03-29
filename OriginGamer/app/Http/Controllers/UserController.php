<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if(auth()->user()->hasPermissionTo('show users') == false){
            return response()->json(['message' => 'You are not authorized to view users'], 403);
        }
        else 
        {
        $users = User::all();

        return response()->json([
            'status' => 'success',
            'length' => count($users),
            'data' => $users,
        ]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        if(auth()->user()->hasPermissionTo('show user') == false){
            return response()->json(['message' => 'You are not authorized to view users'], 403);
        }
        else 
        {
        $user = User::find($id);

        if(!$user){
            return response()->json([
               'status' => 'error',
               'message' => 'user not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        if(auth()->user()->hasPermissionTo('update user') == false){
            return response()->json(['message' => 'You are not authorized to edit users'], 403);
        }
        else 
        {
        $user = User::find($id);

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'user not found',
            ], 404);
        }

        $user->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully update user information\'s',
            'data' => $user,
        ]);
    }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update_password(Request $request, int $id): JsonResponse
    {
        if(auth()->user()->hasPermissionTo('edit users') == false){
            return response()->json(['message' => 'You are not authorized to edit users'], 403);
        }
        else 
        {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'no user found',
            ]);
        }
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully update password',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'incorrect old password',
            ], 406);
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if(auth()->user()->hasPermissionTo('delete user') == false){
            return response()->json(['message' => 'You are not authorized to delete users'], 403);
        }
        else 
        {
        $user = User::find($id);

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'user not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully delete user',
            'data' => $user,
        ]);
    }
    }
}
