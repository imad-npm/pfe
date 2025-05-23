<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\EmailTeacher;
use App\Services\EmailTeacherService;
use Illuminate\Http\Request;

class EmailTeacherController extends Controller
{

  private $emailTeacherService;

  public function __construct(EmailTeacherService $service)
  {
    $this->emailTeacherService = $service;
  }

  public function index(Request $request)
  {

    $search = $request->input('search');

    $emails = EmailTeacher::where("email", "like", "%$search%")
      ->paginate();

    return view("admin.emails-teacher.index", compact('emails'));
  }

  public function create()
  {

    return view("admin.emails-teacher.create");
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      "email" => "required|email|max:255"
    ]);

    EmailTeacher::create($validated);
    return redirect()->back()->with("success", "Email created successfully.");
  }

  public function destroy(EmailTeacher $email)
  {
    $email->delete();
    return redirect()->back()->with("success", "Email deleted successfully.");
  }
  public function uploadForm()
  {

    return view('admin.emails-teacher.upload');
  }
  public function uploadEmails(Request $request)
  {
    $requiredColumns = ["email"];
    $request->validate([
      "emails_file" => "required|file|csv"
    ]);
    if (!validateColumns($request->file("emails_file")->getRealPath(), $requiredColumns))

      return redirect()->back()->withErrors(
        ["emails_file" => "The CSV file for emails does not 
                                    contain the required columns."]
      );

    if (!containsRows($request->file("emails_file")))
      return redirect()->back()->withErrors(
        ["emails_file" => "The CSV file for does not contain any rows."]
      );

    $request->file("emails_file")->storeAs("uploads", "emails_teachers.csv");
    $this->emailTeacherService->storeUploadedEmails();
    return back()->withSuccess("Emails Uploaded Successfully .");
  }
}
