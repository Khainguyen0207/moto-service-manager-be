<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CustomerRequest;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController
{
    public function updateProfile(CustomerRequest $request)
    {
        try {
            $user = $request->user();

            $user->update([
                'email' => $request->email,
            ]);

            $user->customer->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'note' => $request->note,
            ]);

            return response()->json([
                'error' => false,
                'data' => CustomerResource::make($user->customer),
                'message' => 'Cập nhật thông tin thành công',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'data' => null,
                'message' => $e->getMessage(),
            ], $e->getCode());
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6',
            'password' => 'required|confirmed|min:6'
        ]);

        if (! Hash::check($request->current_password, $request->user()->password)) {
            return response()->json([
                'error' => true,
                'message' => 'Mật khẩu hiện tại không chính xác',
            ]);
        }

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Đổi mật khẩu thành công',
        ]);
    }
}
