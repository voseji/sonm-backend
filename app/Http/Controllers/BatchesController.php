<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use App\Models\Batches;

class BatchesController extends Controller
{
  // Pull all batches
  public function getAllBatches()
  {
    return Batches::orderBy('created_at', 'asc')->get();
  }

  public function createBatches(Request $request)
  {
    $batch = new Batches();

    $batch->batchId = $request->batchId;
    $batch->batch = $request->batch;
    $batch->day = $request->day;
    $batch->time = $request->time;
    // $batch->status = $request->status;

    $batch->save();

    return response()->json([
      "message" => "batch record created"
    ], 201);
  }


  public function updateBatch(Request $request, $batch_id)
  {
    $batch = Batch::findOrFail($batch_id);
    $batch->update($request->except(['id']));
    \Log::info($batch);
  }
}
