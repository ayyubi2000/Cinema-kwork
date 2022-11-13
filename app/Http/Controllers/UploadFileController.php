<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UploadFileController extends Controller
{
    /**
     * @OA\Post(
     *   path="/api/upload-file",
     *   summary="Upload a file and get path",
     *   description="Upload file",
     *   operationId="uploadFile",
     *   tags={"Files"},
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *       @OA\JsonContent(
     *       @OA\Property(
     *       title="path",
     *       property="path",
     *       type="string",
     *       example="example/example.jpg"
     *       ),
     *     ),
     *   ),
     *   @OA\Response(response="404",description="Product not found"),
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate(
            [
                'file' => 'required'
            ]
        );
        $pathUpload = $request->file('file')->store('files');
        $path = $request->file('file')->move('uploads', $pathUpload);
        unlink(storage_path('app/' . $pathUpload));
        return response()->json(['location' => (string) $path]);
    }
}