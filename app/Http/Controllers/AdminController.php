<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private const ROLE_ADMIN = 'admin';
    private const ROLE_TAMU = 'tamu';

    public function index()
    {
        $admins = $this->getAdmins();

        return view('admin.kelola-admin.index', compact('admins'));
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function create()
    {
        return view('admin.kelola-admin.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateAdminStore($request);

        $this->createAdmin($validated);

        return redirect()
            ->route('admin.kelola-admin.index')
            ->with('sukses', 'Admin berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $admin = $this->findAdmin($id);

        return view('admin.kelola-admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = $this->findAdmin($id);

        $validated = $this->validateAdminUpdate($request, $admin->id);

        $this->updateAdmin($admin, $validated);

        return redirect()
            ->route('admin.kelola-admin.index')
            ->with('sukses', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = $this->findAdmin($id);

        $admin->delete();

        return redirect()
            ->route('admin.kelola-admin.index')
            ->with('sukses', 'Admin berhasil dihapus.');
    }

    public function kelolaPelanggan()
    {
        $pelanggan = $this->getPelanggan();

        return view('admin.kelola-pelanggan.index', compact('pelanggan'));
    }

    public function destroyPelanggan($id)
    {
        $pelanggan = $this->findPelanggan($id);

        $pelanggan->delete();

        return redirect()
            ->route('admin.kelola-pelanggan.index')
            ->with('sukses', 'Pelanggan berhasil dihapus.');
    }

    private function getAdmins()
    {
        return User::where('role', self::ROLE_ADMIN)->get();
    }

    private function getPelanggan()
    {
        return User::where('role', self::ROLE_TAMU)->get();
    }

    private function findAdmin($id)
    {
        return User::where('role', self::ROLE_ADMIN)->findOrFail($id);
    }

    private function findPelanggan($id)
    {
        return User::where('role', self::ROLE_TAMU)->findOrFail($id);
    }

    private function validateAdminStore(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    private function validateAdminUpdate(Request $request, $adminId)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $adminId,
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    }

    private function createAdmin(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => self::ROLE_ADMIN,
        ]);
    }

    private function updateAdmin(User $admin, array $data)
    {
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        return $admin->update($updateData);
    }
}
