<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Dokumen - {{ $dokumen->jenis }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Desain Dark Mode yang serasi dengan aplikasi SIAP Anda */
        body { background-color: #0f1015; color: #e0e0e0; font-family: 'Inter', sans-serif; margin: 0; }
        .container { max-width: 700px; margin: 50px auto; padding: 0 20px; }
        .card { background: #1a1c24; padding: 40px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.6); border: 1px solid #2d2f39; }
        
        h2 { color: #fff; margin-bottom: 10px; font-size: 26px; text-align: center; letter-spacing: 0.5px; }
        .doc-info { color: #888; margin-bottom: 35px; font-size: 14px; border-bottom: 1px solid #2d2f39; padding-bottom: 20px; text-align: center; }
        .doc-info strong { color: #ef4444; } /* Warna merah khas SIAP */
        
        /* Desain Timeline Vertikal */
        .timeline { position: relative; padding-left: 35px; }
        .timeline::before {
            content: '';
            position: absolute;
            left: 5px;
            top: 5px;
            bottom: 5px;
            width: 2px;
            background: #2d2f39;
        }

        .timeline-item { position: relative; margin-bottom: 40px; }
        
        /* Marker/Titik status */
        .timeline-marker {
            position: absolute;
            left: -37px;
            top: 4px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #ffc107; /* Warna default Kuning */
            border: 4px solid #1a1c24;
            z-index: 2;
            transition: 0.3s;
        }

        /* Titik Hijau untuk status yang sudah dilewati (Completed) */
        .timeline-item.completed .timeline-marker { 
            background: #10b981; 
            box-shadow: 0 0 8px rgba(16, 185, 129, 0.4);
        }

        /* Titik terakhir tetap Kuning sebagai penanda posisi terkini */
        .timeline-item.current .timeline-marker {
            background: #ffc107;
            box-shadow: 0 0 12px rgba(255, 193, 7, 0.6);
        }

        .timeline-content { padding-left: 15px; }
        .status-title { font-weight: 700; color: #fff; font-size: 18px; margin-bottom: 6px; display: flex; align-items: center; }
        .status-desc { font-size: 15px; color: #9ca3af; margin-bottom: 8px; line-height: 1.6; }
        .status-time { font-size: 12px; color: #6b7280; font-style: italic; display: flex; align-items: center; }
        .status-time i { margin-right: 6px; font-size: 11px; }

        /* Tombol Navigasi */
        .btn-back { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            margin-top: 40px; 
            color: #9ca3af; 
            text-decoration: none; 
            font-size: 14px; 
            font-weight: 500;
            transition: 0.3s;
            padding: 12px;
            border-radius: 8px;
            background: rgba(255,255,255,0.03);
        }
        .btn-back i { margin-right: 10px; }
        .btn-back:hover { color: #fff; background: rgba(255,255,255,0.08); }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Lacak Posisi Dokumen</h2>
            <div class="doc-info">
                Jenis Usulan: <strong>{{ $dokumen->jenis }}</strong><br>
                ID Dokumen: #{{ $dokumen->id }}
            </div>

            <div class="timeline">
                @forelse($tracks as $track)
                {{-- Logika Marker: Jika bukan item terakhir, beri warna hijau (completed) --}}
                <div class="timeline-item {{ $loop->last ? 'current' : 'completed' }}">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <div class="status-title">
                            @if($loop->last)
                                <i class="fas fa-map-marker-alt mr-2 text-yellow-500" style="margin-right: 10px;"></i>
                            @endif
                            {{ $track->status }}
                        </div>
                        <div class="status-desc">{{ $track->keterangan }}</div>
                        <div class="status-time">
                            <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($track->tanggal)->translatedFormat('d F Y, H:i') }} WIB
                        </div>
                    </div>
                </div>
                @empty
                <div style="text-align: center; padding: 20px; color: #6b7280;">
                    <i class="fas fa-search mb-3" style="font-size: 30px; display: block;"></i>
                    <p>Belum ada data tracking untuk dokumen ini.</p>
                </div>
                @endforelse
            </div>

            <a href="{{ route('dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard Utama
            </a>
        </div>
    </div>
</body>
</html>