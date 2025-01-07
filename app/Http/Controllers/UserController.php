<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\pagination\paginator;
use App\Events\MailEvent;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('gestion_utilisateurs',User::class);
        $users=User::orderBy('created_at','desc')->paginate(5);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $emailRules = [
            'required', 
            'string', 
            'lowercase', 
            'email', 
            'max:255',
            function ($attribute, $value, $fail) {
                if (!preg_match('/@(taalim\.ma|men\.gov\.ma)$/', $value)) {
                    $fail(" يسمح فقط بـ @taalim.ma أو @men.gov.ma");
                }
            },
            function ($attribute, $value, $fail) use ($user) {
                if (User::where('email', $value)->where('id', '!=', $user->id)->exists()) {
                    $fail('هذا البريد الإلكتروني مستخدم بالفعل');
                }
            },
        ];
        $data=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => $emailRules,
            'division' => ['required', 'string', 'max:255'],
            'services' => [ 'nullable','string', 'max:255'],
            'poste' => ['required', 'string', 'max:255'],
        ],[
            'name.required' => 'الرجاء ملئ الخانة',
            'division.required' => 'الرجاء ملئ الخانة',
            'poste.required' => 'الرجاء ملئ الخانة',
        ]);
        $data['services']=$request['services'];
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'تم تعديل المعطيات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        // Vérifier si la requête est AJAX
        if (request()->header('X-Requested-With') == 'XMLHttpRequest') {
            return response()->json(['message' => 'تم حذف العضو بنجاح.'], 200);
        }
            // Si ce n'est pas une requête AJAX, retournez une redirection avec un message flash
            return redirect()->route('users.index')->with('danger', 'تم حذف البريد بنجاح');  
    }

    public function contactSectionIndex(User $user)
    {
        $user = auth()->user();
        $users=User::where(function ($query) {
            $query->where('poste', 'مدير')
                ->orWhere('poste', 'رئيس القسم')
                ->orWhere('poste', 'كاتب عام')
                ->orWhere('poste', 'مسؤول مكتب الضبط');
            })
            ->get();
        $members = User::where('division', $user->division)
            ->orderBy('services')
            ->get();
        return view('users.contactSection',compact('users','members'));
    }
    
    public function storeModalData(Request $request){

        $expediteurs = $request->input('expediteur');
        $object = $request->input('object');
        $messageContent = $request->input('messageContent');

        $fichiersPaths = [];
        if ($request->hasFile('fichiers')) {
            foreach ($request->file('fichiers') as $fichier) {
                $originalName = $fichier->getClientOriginalName();
                $path = $fichier->storeAs('temporary_files', $originalName);
                $fichiersPaths[] = $path;
            }
        }
        foreach ($expediteurs as $expediteur) {
            // Déclencher un événement pour chaque destinataire
            event(new MailEvent($expediteur, $object, $fichiersPaths, $messageContent));
        }
        return redirect()->route('contactSection')->with('succes','تم إرسال الرسالة بنجاح');
    }
    
}
