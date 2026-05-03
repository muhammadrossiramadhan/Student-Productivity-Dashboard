<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $search = $request->search;

        // 1. Ambil data tugas aktif (Belum Selesai) beserta logika pencarian
        $query = $user->tasks()->where('status', 'Belum Selesai');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_tugas', 'like', "%$search%")
                  ->orWhere('deskripsi', 'like', "%$search%");
            });
        }
        $activeTasks = $query->orderBy('deadline', 'asc')->orderBy('waktu', 'asc')->get();

        // Tambahkan label status_waktu (Mendatang / Terlambat)
        foreach ($activeTasks as $task) {
            $datetime = Carbon::parse($task->deadline . ' ' . $task->waktu);
            $task->status_waktu = $datetime->isPast() ? 'Terlambat' : 'Mendatang';
        }

        // 2. Ambil 5 riwayat terakhir
        $historyTasks = $user->tasks()->where('status', 'Selesai')
                             ->orderBy('selesai_at', 'desc')->take(5)->get();

        // 3. Ambil data grafik performa (7 hari terakhir)
        $labels = [];
        $data_poin = [];
        for ($i = 6; $i >= 0; $i--) {
            $tgl = date('Y-m-d', strtotime("-$i days"));
            $labels[] = date('d M', strtotime($tgl));
            $poin = $user->tasks()->whereDate('selesai_at', $tgl)->sum('poin_konsistensi');
            $data_poin[] = (int) $poin;
        }
        $chartData = ['labels' => $labels, 'data' => $data_poin];

        return view('dashboard', compact('activeTasks', 'historyTasks', 'chartData'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_tugas' => 'required',
            'deadline' => 'required|date',
            'waktu' => 'required',
            'prioritas' => 'required|in:Tinggi,Sedang,Rendah'
        ]);

        Auth::user()->tasks()->create($request->all());
        return back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function update(Request $request, Task $task) {
        if ($task->user_id !== Auth::id()) abort(403);
        $task->update($request->all());
        return back()->with('success', 'Tugas berhasil diperbarui!');
    }

    public function markAsDone(Task $task) {
        if ($task->user_id !== Auth::id()) abort(403);

        $tenggat = Carbon::parse($task->deadline . ' ' . $task->waktu);
        $skrg = Carbon::now();
        
        $is_ontime = $skrg->lte($tenggat);
        $poin = $is_ontime 
            ? ($task->prioritas === 'Tinggi' ? 15 : ($task->prioritas === 'Sedang' ? 10 : 5))
            : ($task->prioritas === 'Tinggi' ? 5 : ($task->prioritas === 'Sedang' ? 3 : 1));

        $task->update(['status' => 'Selesai', 'selesai_at' => $skrg, 'poin_konsistensi' => $poin]);
        return back()->with('success', 'Tugas diselesaikan! +' . $poin . ' Poin');
    }

    public function destroy(Task $task) {
        if ($task->user_id !== Auth::id()) abort(403);
        $task->delete();
        return back()->with('success', 'Tugas berhasil dihapus!');
    }

    public function clearHistory() {
        // Menghapus semua tugas milik user yang statusnya sudah 'Selesai'
        Auth::user()->tasks()->where('status', 'Selesai')->delete();
        return back()->with('success', 'Semua riwayat tugas berhasil dibersihkan!');
    }
}