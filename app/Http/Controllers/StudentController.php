<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $students = Student::when($search, function($q) use ($search){
            $q->where('name','like',"%$search%")->orWhere('email','like',"%$search%")->orWhere('course','like',"%$search%");
        })->latest()->paginate(8);
        $total = Student::count();
        $active = Student::where('status','Active')->count();
        return view('students.index', compact('students','total','active'));
    }
    public function create() { return view('students.create'); }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:students,email',
            'phone'=>'nullable|string|max:20',
            'course'=>'required|string|max:100',
            'address'=>'nullable|string',
            'status'=>'required|in:Active,Inactive',
        ]);
        Student::create($request->all());
        return redirect()->route('students.index')->with('success','Student added successfully!');
    }
    public function show(Student $student) { return view('students.show', compact('student')); }
    public function edit(Student $student) { return view('students.edit', compact('student')); }
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:students,email,'.$student->id,
            'phone'=>'nullable|string|max:20',
            'course'=>'required|string|max:100',
            'address'=>'nullable|string',
            'status'=>'required|in:Active,Inactive',
        ]);
        $student->update($request->all());
        return redirect()->route('students.index')->with('success','Student updated successfully!');
    }
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','Student deleted successfully!');
    }
}
