<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home()
    {
        $students = Student::with('profile')->get();
        return view('home', compact('students'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'আপনার নাম অবশ্যই দিতে হবে!',
            'name.string' => 'নাম অবশ্যই অক্ষরের হতে হবে!',
            'name.max' => 'নাম 255 character এর বেশি হতে পারবে না!',
            'phone.required' => 'ফোন নম্বর অবশ্যই দিতে হবে!',
            'phone.max' => 'ফোন নম্বর সর্বোচ্চ 20 digit হতে পারে!',
            'address.required' => 'ঠিকানা অবশ্যই দিতে হবে!',
            'address.max' => 'ঠিকানা সর্বোচ্চ 500 character হতে পারে!',
            'dob.required' => 'জন্ম তারিখ অবশ্যই দিতে হবে!',
            'dob.date' => 'জন্ম তারিখ সঠিক ফরম্যাটে দিন!',
            'photo.image' => 'ফটো অবশ্যই image হতে হবে!',
            'photo.mimes' => 'ফটো শুধু jpg, jpeg, png ফরম্যাট হতে পারবে!',
            'photo.max' => 'ফটো সর্বোচ্চ 2MB হতে পারবে!',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'dob' => 'required|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], $messages);

        try {
            // Start Transaction
            DB::beginTransaction();
            // Student object
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->save();

            // Profile data
            $profileData = [
                'address' => $request->address,
                'dob' => $request->dob,
            ];

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/photos', $filename);
                $profileData['photo'] = $filename;
            }

            // Create profile
            $student->profile()->create($profileData);

            // Commit Transaction
            DB::commit();

            return redirect()->back()->with('success', 'Student created successfully!');
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();

            return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $student = Student::with('profile')->findOrFail($id);
        return view('edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'আপনার নাম অবশ্যই দিতে হবে!',
            'name.string' => 'নাম অবশ্যই অক্ষরের হতে হবে!',
            'name.max' => 'নাম 255 character এর বেশি হতে পারবে না!',
            'phone.required' => 'ফোন নম্বর অবশ্যই দিতে হবে!',
            'phone.max' => 'ফোন নম্বর সর্বোচ্চ 20 digit হতে পারে!',
            'address.required' => 'ঠিকানা অবশ্যই দিতে হবে!',
            'address.max' => 'ঠিকানা সর্বোচ্চ 500 character হতে পারে!',
            'dob.required' => 'জন্ম তারিখ অবশ্যই দিতে হবে!',
            'dob.date' => 'জন্ম তারিখ সঠিক ফরম্যাটে দিন!',
            'photo.image' => 'ফটো অবশ্যই image হতে হবে!',
            'photo.mimes' => 'ফটো শুধু jpg, jpeg, png ফরম্যাট হতে পারবে!',
            'photo.max' => 'ফটো সর্বোচ্চ 2MB হতে পারবে!',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'dob' => 'required|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], $messages);

        try {
            // Start Transaction
            DB::beginTransaction();

            // Student update
            $student = Student::findOrFail($id);
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->save();

            // Profile data
            $profileData = [
                'address' => $request->address,
                'dob' => $request->dob,
            ];

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/photos', $filename);
                $profileData['photo'] = $filename;
            }

            // Update or create profile
            $student->profile()->updateOrCreate(
                ['student_id' => $student->id],
                $profileData
            );

            // Commit Transaction
            DB::commit();

            return redirect()->back()->with('success', 'Student updated successfully!');
        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();

            return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }
}
