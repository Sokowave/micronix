<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\Staff\StoreStaffRequest;
use App\Http\Requests\Backoffice\Staff\UpdateStaffRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Allowed backoffice user types.
     */
    protected array $staffTypes = [
        'superadmin',
        'staff',
    ];

    public function index()
    {
        $staff = User::query()
            ->whereIn('user_type', $this->staffTypes)
            ->latest()
            ->paginate(20);

        return view('backend.staff.index', compact('staff'));
    }

    public function create()
    {
        $userTypes = $this->staffTypes;

        return view('backend.staff.create', compact('userTypes'));
    }

    public function store(StoreStaffRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $data['status'] ??= 'active';

        User::create($data);

        return redirect()
            ->route('backoffice.staff.index')
            ->with('success', 'Staff user created successfully.');
    }

    public function show(User $staff)
    {
        abort_unless(
            in_array($staff->user_type, $this->staffTypes, true),
            404
        );

        return view('backend.staff.show', compact('staff'));
    }

    public function edit(User $staff)
    {
        abort_unless(
            in_array($staff->user_type, $this->staffTypes, true),
            404
        );

        return view('backend.staff.edit', [
            'staff'        => $staff,
            'userTypes'    => $this->staffTypes,
            'loggedInUser' => Auth::user(),
        ]);
    }

    public function update(
        UpdateStaffRequest $request,
        User $staff
    ) {
        abort_unless(
            in_array($staff->user_type, $this->staffTypes, true),
            404
        );

        $loggedInUser = Auth::user();

        $data = $request->validated();

        // Prevent users from changing their own user type.
        if ($staff->is($loggedInUser)) {
            unset($data['user_type']);
        }

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $staff->update($data);

        return redirect()
            ->route('backoffice.staff.index')
            ->with('success', 'Staff user updated successfully.');
    }

    public function destroy(User $staff)
    {
        abort_unless(
            in_array($staff->user_type, $this->staffTypes, true),
            404
        );

        if ($staff->is(Auth::user())) {
            return redirect()
                ->route('backoffice.staff.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $staff->delete();

        return redirect()
            ->route('backoffice.staff.index')
            ->with('success', 'Staff user deleted successfully.');
    }
}