<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Program;
use App\Models\ScholarshipType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class AdminController extends Controller
{
    // Faculties
    public function faculties()
    {
        $faculties = Faculty::all();
        return view('admin.faculties.index', compact('faculties'));
    }

    public function createFaculty()
    {
        return view('admin.faculties.create');
    }

    public function storeFaculty(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Faculty::create($request->all());

        return redirect()->route('admin.faculties.index')->with('success', 'Faculty created successfully.');
    }

    public function editFaculty(Faculty $faculty)
    {
        return view('admin.faculties.edit', compact('faculty'));
    }

    public function updateFaculty(Request $request, Faculty $faculty)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $faculty->update($request->all());

        return redirect()->route('admin.faculties.index')->with('success', 'Faculty updated successfully.');
    }

    public function destroyFaculty(Faculty $faculty)
    {
        $faculty->delete();

        return redirect()->route('admin.faculties.index')->with('success', 'Faculty deleted successfully.');
    }

    // Programs
    public function programs()
    {
        $programs = Program::all();
        return view('admin.programs.index', compact('programs'));
    }

    public function createProgram()
    {
        $faculties = Faculty::all();
        return view('admin.programs.create', compact('faculties'));
    }

    public function storeProgram(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        Program::create($request->all());

        return redirect()->route('admin.programs.index')->with('success', 'Program created successfully.');
    }

    public function editProgram($id)
    {
        $program = Program::findOrFail($id);
        $faculties = Faculty::all();
        return view('admin.programs.edit', compact('program', 'faculties'));
    }

    public function updateProgram(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        $program->update($request->all());

        return redirect()->route('admin.programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroyProgram(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Program deleted successfully.');
    }

    // Users
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'role' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->roles()->attach($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function editUser(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:4',
            'role' => 'required|exists:roles,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Sync roles
        $user->roles()->sync([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroyUser(User $user)
    {
        // Hapus relasi antara user dan roles
        $user->roles()->detach();
    
        // Hapus user
        $user->delete();
    
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    // Scholarship Types
    public function scholarshipTypes()
    {
        $scholarshipTypes = ScholarshipType::all();
        return view('admin.scholarship_types.index', compact('scholarshipTypes'));
    }

    public function createScholarshipType()
    {
        return view('admin.scholarship_types.create');
    }

    public function storeScholarshipType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ScholarshipType::create($request->all());

        return redirect()->route('admin.scholarship_types.index')->with('success', 'Scholarship Type created successfully.');
    }

    public function editScholarshipType(ScholarshipType $scholarshipType)
    {
        return view('admin.scholarship_types.edit', compact('scholarshipType'));
    }

    public function updateScholarshipType(Request $request, ScholarshipType $scholarshipType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $scholarshipType->update($request->all());

        return redirect()->route('admin.scholarship_types.index')->with('success', 'Scholarship Type updated successfully.');
    }

    public function destroyScholarshipType(ScholarshipType $scholarshipType)
    {
        $scholarshipType->delete();

        return redirect()->route('admin.scholarship_types.index')->with('success', 'Scholarship Type deleted successfully.');
    }
}
