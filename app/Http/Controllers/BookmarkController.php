<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\LowonganKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function addBookmark($lowonganId)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);

        if ($user) {
            $lowongan = LowonganKerja::find($lowonganId);

            if ($lowongan) {
                if (!$user->bookmarks->contains($lowongan->id)) {
                    $user->bookmarks()->attach($lowongan->id);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Bookmark berhasil ditambahkan!'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'info',
                        'message' => 'Lowongan sudah ada di bookmark Anda.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lowongan tidak ditemukan.'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan.'
            ]);
        }
    }

    public function removeBookmark($lowonganId)
    {
        $user = auth()->user();
    
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan.'
            ], 404);
        }
    
        $lowongan = LowonganKerja::find($lowonganId);
    
        if (!$lowongan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lowongan tidak ditemukan.'
            ], 404);
        }
    
        if (!$user->bookmarks()->where('lowongan_id', $lowonganId)->exists()) {
            return response()->json([
                'status' => 'info',
                'message' => 'Lowongan tidak ada di bookmark Anda.'
            ]);
        }
    
        $user->bookmarks()->detach($lowonganId);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Bookmark berhasil dihapus!'
        ]);
    }
    

    public function index()
    {
        $bookmarks = Bookmark::with(['user', 'lowongan_kerja'])->paginate(6);
        return view('bookmarks.index', compact('bookmarks'));
    }

}
