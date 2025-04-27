<?php

namespace App\Http\Controllers;

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

    public function removeBookmark(LowonganKerja $lowongan)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        
        if ($user) {
            $lowongan = LowonganKerja::find($lowongan->id);

            if ($lowongan) {
                if ($user->bookmarks->contains($lowongan->id)) {
                    $user->bookmarks()->detach($lowongan->id);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Bookmark berhasil dihapus!'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'info',
                        'message' => 'Lowongan sudah hilang di bookmark Anda.'
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
        
        return response()->json(['message' => 'Lowongan berhasil dihapus dari bookmark']);
    }

}
