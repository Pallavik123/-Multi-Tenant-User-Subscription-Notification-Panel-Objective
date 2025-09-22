<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;



class UsageController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $company = $user->company()->with('plan', 'usages')->first();

        if (!$company) {
            return response()->json([
                'message' => 'Company not found',
            ], 404);
        }

        // Fallback values
        $messagesUsed = 0;
        $apiCallsUsed = 0;

        if ($company->usages) {
            $messagesUsed = $company->usages->messages_used ?? 0;
            $apiCallsUsed = $company->usages->api_calls_used ?? 0;
        }

        return response()->json([
            'plan' => $company->plan->name,
            'limits' => [
                'message_limit' => $company->plan->message_limit,
                'api_limit' => $company->plan->api_limit,
            ],
            'usage' => [
                'messages_used'  => $messagesUsed,
                'api_calls_used' => $apiCallsUsed,
            ],
        ], 200);
    }
}

   