<?php

namespace BRCas\Package\Traits\Support;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

trait Execute {
    private function responseError($status, $message)
    {
        if (!request()->isJson()) {
            return redirect()->back()->withErrors($message)->withInput();
        }

        return response()->json([
            'status' => $status,
            'msg' => $message,
        ]);
    }
    
    public function execute($function)
    {
        try {
            return $function();
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error($e->getTraceAsString());
            return $this->responseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e){
            Log::error($e);
        }
    }
}