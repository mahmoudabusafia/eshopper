<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-Any', User::class);

        $data = User::where('type', '!=', 'admin')->get();
        if ($request->ajax()){
            return  Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('mobile', function ($row) {
                    return $row->mobile ?? 'No Mobile';
                })->addColumn('image', function ($row) {
                    $image = '<img src="'.$row->image_url.'" width="100px" height="100px">';
                    return $image;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                        <a href="'. Route('users.edit', $row->id) .'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details"><span class="svg-icon svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "></path><rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect></g></svg></span></a>
                    ';
                    $btn .=    ' <form action="'. Route('users.destroy', $row->id) .'" method="post" style="display: inline">
                                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                                    <input name="_method" value="DELETE" type="hidden">
                                    <button type="submit" class="btn btn-sm btn-clean btn-icon" title="Delete"><span class="svg-icon svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path><path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path></g></svg></span></button>
                              </form>
                            ';
                    return $btn;
                })
                ->rawColumns(['image', 'mobile', 'action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|unique:users,email',
            'mobile' => 'nullable|unique:users,mobile',
            'type' => 'required',
            'password' => ['required','confirmed'], //, Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'password_confirmation' => 'required|same:password',
            'image' => 'nullable|image|max:512000|dimensions:min_width=100,min_height=100',
        ]);

        Image::addImage($request, 'users');
        $user = User::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'mobile' => $request->post('mobile'),
            'type' => $request->post('type'),
            'password' => Hash::make($request->post('password')),
            'image_path' => $request->image_path,
        ]);

        return redirect()->route('users.index')->with('success', 'User created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', User::class);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', User::class);

        return view('admin.users.edit',[
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', User::class);
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'mobile' => ['nullable', Rule::unique('users')->ignore($user->id)],
            'type' => 'required',
            'image' => 'nullable|image|max:512000|dimensions:min_width=100,min_height=100',
        ]);

        Image::updateImage($request, $user, 'users');
        $user->update([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'mobile' => $request->post('mobile'),
            'type' => $request->post('type'),
            'password' => Hash::make($request->post('password')),
            'image_path' => $request->image_path
        ]);
        return redirect()->route('users.index')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::class);

        $user = User::findOrfail($id);
        Image::deleteImage($user, 'users');
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}
