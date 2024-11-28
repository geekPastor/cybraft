<?php

namespace App\Http\Controllers;

use App\Models\UserFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteUserFileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserFile $file)
    {
        Storage::disk('public')->delete($file->path);

        $file->delete();

        return redirect()->back();
    }
}
