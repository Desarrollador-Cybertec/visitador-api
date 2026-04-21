<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FarmContactController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FarmGeorreferenceController;
use App\Http\Controllers\FormTemplateController;
use App\Http\Controllers\ProgressReportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\SystemsCatalogController;
use App\Http\Controllers\VisitCommitmentController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\VisitFindingController;
use App\Http\Controllers\VisitMaterialRequestController;
use App\Http\Controllers\VisitMeasurementController;
use App\Http\Controllers\VisitMediaController;
use App\Http\Controllers\VisitParticipantController;
use App\Http\Controllers\VisitSignatureController;
use App\Http\Controllers\VisitStructureController;
use App\Http\Controllers\VisitSystemReviewController;
use App\Http\Controllers\VisitTypeController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Master data
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('farms', FarmController::class);
    Route::apiResource('farm-georreferences', FarmGeorreferenceController::class);
    Route::apiResource('farm-contacts', FarmContactController::class);
    Route::apiResource('structures', StructureController::class);

    // Catalogs
    Route::apiResource('visit-types', VisitTypeController::class);
    Route::apiResource('systems-catalog', SystemsCatalogController::class);
    Route::apiResource('form-templates', FormTemplateController::class);

    // Visits
    Route::apiResource('visits', VisitController::class);
    Route::apiResource('visit-structures', VisitStructureController::class)->except(['show']);
    Route::apiResource('visit-participants', VisitParticipantController::class)->except(['show']);
    Route::apiResource('visit-signatures', VisitSignatureController::class)->except(['show']);
    Route::apiResource('visits.findings', VisitFindingController::class)->shallow()->except(['show']);
    Route::apiResource('visits.commitments', VisitCommitmentController::class)->shallow()->except(['show']);

    // Media
    Route::apiResource('visit-media', VisitMediaController::class);
    Route::post('visit-media/{visitMedia}/annotate', [VisitMediaController::class, 'annotate']);

    // Technical
    Route::apiResource('visit-system-reviews', VisitSystemReviewController::class)->except(['show']);
    Route::apiResource('visits.measurements', VisitMeasurementController::class)->shallow()->except(['show']);
    Route::post('visits/{visit}/material-requests', [VisitMaterialRequestController::class, 'store']);
    Route::apiResource('visit-material-requests', VisitMaterialRequestController::class)->only(['index', 'update', 'destroy']);

    // Projects & progress
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('projects.progress-reports', ProgressReportController::class)->shallow();
});
