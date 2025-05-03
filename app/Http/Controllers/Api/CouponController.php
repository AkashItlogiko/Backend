<?php

namespace App\Http\Controllers\Api;


use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\CouponController;


class CouponController extends Controller
{
    //
    /**
     * Apply coupon
     */
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::whereName($request->name)->first();
        if($coupon && $coupon->checkIfValid()) {
            return response()->json([
                'message' => 'Coupon applied successfully',
                'coupon' => $coupon
            ]);
        }else {
            return response()->json([
                'error' => 'Invalid or expired coupon'
            ]);
        }
    }
}
