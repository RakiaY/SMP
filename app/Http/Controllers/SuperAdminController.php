<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\addAdminRequest;
use App\Http\Requests\updateAdminRequest;

use App\Enums\AdminStatus;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminResource;


class SuperAdminController extends Controller
{
    public function addAdmin(addAdminRequest $request)
    {

        $data = $request->validated();
        dd($data);
        //status actif automatiquement des la creation
        $data['status'] = AdminStatus::Active->value;

        //creer le user
        $admin = User::create($data);

        //lui attribuer le role:
        $admin->assignRole('admin');

        //affichage 
        return response()->json([
            'success' => true,
            'message' => 'Admin ajouté avec succès',
            'admin' => new AdminResource($admin)
        ]);
    }

    public function updateStatusAdmin(updateAdminRequest $request, $admin_id)
    {

        $validated = $request->validate([
            'status' => ['required', Rule::enum(AdminStatus::class)],
        ]);
        $admin = User::role('admin')->findOrfail($admin_id);
        $admin->status = $request->status;
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => 'Statut de l’admin mis à jour avec succès',
            'status' => $admin->status,
        ]);
    }
    public function updateAdmin($admin_id, Request $request)
    {

        $admin = User::role('admin')->findOrfail($admin_id);
        $data = $request->validate();

        $admin = User::update($data);

        return response()->json([
            'success' => true,
            'message' => 'Admin mis à jour avec succès',
            'admin' => new AdminResource($admin)
        ]);
    }
    public function deleteAdmin($admin_id)
    {

        $admin = User::role('admin')->findOrfail($admin_id);
        $admin->status = AdminStatus::Deleted->value;  //statut devient supprime
        $admin->save();
        $admin->delete();

        return response()->json([
            'success' => true,
            'message' => 'Admin supprimé avec succés'
        ], 200);
    }
    public function forceDeleteAdmin($admin_id)
    {
        $admin = User::role('admin')->withTrashed()->findOrfail($admin_id);
        $admin->forceDelete();
        return response()->json([
            'success' => true,
            'message' => 'Admin supprimé définitivement'
        ]);
    }

    public function restoreAdmin($admin_id)
    {

        $admin = User::role('admin')->withTrashed()->findOrfail($admin_id);
        $admin->restore();

        $admin->status = AdminStatus::Active->value;  // statut retourne Active
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur restauré avec succès',
            'admin' => new AdminResource($admin),
        ]);
    }
    //filtre
    public function getAllAdmins(Request $request)
    {
        $query = User::role('admin'); // Spatie: filtre les users avec le rôle 'admin'

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('first_name')) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $admins = $query->paginate(10); //limiter nbmre d'admin par page 

        return response()->json([
            'success' => true,
            'admins' => AdminResource::collection($admins)
        ]);
    }
}
