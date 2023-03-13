<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class MmrController extends Controller
{
    public function index() {
        return view('index');
    }

    public function store(Request $request) {

        $file = $request->file('file');
        if (is_null($file)) {
            throw ValidationException::withMessages(['file' => 'please choose wowsreplay file']);
        }

        $clientOriginalName = $file->getClientOriginalName();
        $extension = pathinfo($clientOriginalName, PATHINFO_EXTENSION);

        if ($extension != 'wowsreplay') {
            throw ValidationException::withMessages(['file' => 'is not wowsreplay file']);
        }

        $file->storeAs('', $clientOriginalName);

        $path = storage_path() . '/app/';
        $command = 'python3 -m render --replay ' . $path . $clientOriginalName;
        exec($command);

        Storage::delete($clientOriginalName);

        $renderedName = substr_replace($clientOriginalName, 'mp4', strlen($extension) * -1);

        return Response::download($path . $renderedName, $renderedName, ['Content-Type: video/mp4']);
    }
}
