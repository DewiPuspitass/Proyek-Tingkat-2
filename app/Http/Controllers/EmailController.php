<?php

namespace App\Http\Controllers;

use App\Mail\BroadcastEmail;
use App\Models\LowonganKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendLowonganEmail($lowonganId)
    {
        $lowongan = LowonganKerja::findOrFail($lowonganId)->load(['jurusan.users', 'tipeLoker']);

        $users = collect();

        foreach ($lowongan->jurusan as $jurusan) {
            $users = $users->merge($jurusan->users()->whereNotNull('email')->get());
        }

        $users = $users->unique('id');

        $sentUserIds = [];

        foreach ($users as $user) {
            Mail::to($user->email)->send(new BroadcastEmail(
                name: $user->name,
                nama_perusahaan: $lowongan->nama_perusahaan,
                nama_pekerjaan: $lowongan->nama_pekerjaan,
                domisili_penempatan: $lowongan->domisili_penempatan,
                foto_loker: $lowongan->foto_loker,
                tipe_lowongan: $lowongan->tipeLoker,
                link: $lowongan->link_submit,
            ));

            $sentUserIds[] = $user->id;
        }

        return response()->json([
            'message' => 'Email berhasil dikirim ke semua user di jurusan terkait.',
            'sent_to' => $sentUserIds,
        ]);
    }
}
