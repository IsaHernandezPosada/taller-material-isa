<?php
/*
 * Author: Isabella Hernandez Posada
 * File: UserController.php
 * Description: User controller with CRUD operations
 * Created: 2025-03-22
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display home page with action buttons
     *
     * @return View
     */
    public function home(): View
    {
        $viewData = [];
        $viewData['title'] = 'Home';
        return view('user.home')->with('viewData', $viewData);
    }

    /**
     * Display form to create a new user
     *
     * @return View
     */
    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create User';
        return view('user.create')->with('viewData', $viewData);
    }

    /**
     * Store a new user in the database
     * Validates input and creates user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        User::create([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('users.index')
                       ->with('success', 'User created successfully');
    }

    /**
     * Display list of all users
     *
     * @return View
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Users List';
        $viewData['users'] = User::all();
        return view('user.index')->with('viewData', $viewData);
    }

    /**
     * Display details of a specific user
     *
     * @param string $id
     * @return View
     */
    public function show(string $id): View
    {
        $viewData = [];
        $viewData['title'] = 'User Details';
        $viewData['user'] = User::findOrFail($id);
        return view('user.show')->with('viewData', $viewData);
    }

    /**
     * Delete a user from database
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        User::findOrFail($id)->delete();

        return redirect()->route('users.index')
                       ->with('success', 'User deleted successfully');
    }
}