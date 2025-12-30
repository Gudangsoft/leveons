@extends('layouts.frontend')

@section('title', 'Booking Confirmation - ' . $company->name)

@push('styles')
<style>
    .booking-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .success-icon {
        text-align: center;
        margin-bottom: 30px;
    }

    .success-icon i {
        font-size: 80px;
        color: #28a745;
        animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .confirmation-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .confirmation-header h1 {
        color: #28a745;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .confirmation-header p {
        color: #666;
        font-size: 1.1rem;
    }

    .booking-card {
        background: white;
        padding: 35px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
    }

    .booking-reference {
        background: linear-gradient(135deg, var(--primary-color), #1a5c96);
        color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 30px;
    }

    .booking-reference .label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 5px;
    }

    .booking-reference .reference-number {
        font-size: 1.8rem;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #666;
        flex: 0 0 140px;
    }

    .detail-value {
        flex: 1;
        text-align: right;
        color: #333;
        font-weight: 500;
    }

    .next-steps {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .next-steps h3 {
        margin-bottom: 20px;
        font-weight: 700;
    }

    .step {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        align-items: flex-start;
    }

    .step:last-child {
        margin-bottom: 0;
    }

    .step-number {
        flex: 0 0 35px;
        height: 35px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .step-content {
        flex: 1;
        padding-top: 5px;
    }

    .step-content strong {
        display: block;
        margin-bottom: 5px;
    }

    .step-content p {
        margin: 0;
        color: #666;
        font-size: 0.95rem;
    }

    .contact-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 30px;
    }

    .contact-card h4 {
        margin-bottom: 15px;
        font-weight: 700;
    }

    .contact-card p {
        margin: 5px 0;
        opacity: 0.95;
    }

    .actions {
        display: flex;
        gap: 15px;
    }

    .btn {
        flex: 1;
        padding: 15px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background: #1a5c96;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(30, 109, 170, 0.3);
    }

    .btn-outline {
        background: white;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
    }

    .btn-outline:hover {
        background: var(--primary-color);
        color: white;
    }

    .whatsapp-btn:hover {
        background: #20ba5a !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.4);
    }

    .email-btn:hover {
        background: #f0fdf4 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.2);
    }

    @media (max-width: 768px) {
        .booking-card {
            padding: 25px;
        }

        .detail-row {
            flex-direction: column;
            gap: 5px;
        }

        .detail-label {
            flex: none;
        }

        .detail-value {
            text-align: left;
        }

        .actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="booking-container">
    <div class="success-icon">
        <i class="bi bi-check-circle-fill"></i>
    </div>

    <div class="confirmation-header">
        <h1>Booking Berhasil!</h1>
        <p>Terima kasih telah melakukan booking konsultasi</p>
    </div>

    <div class="booking-card">
        <div class="booking-reference">
            <div class="label">Nomor Booking</div>
            <div class="reference-number">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
        </div>

        <div class="detail-row">
            <span class="detail-label">Konsultan</span>
            <span class="detail-value">{{ $booking->consultant->name }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Paket</span>
            <span class="detail-value">{{ $booking->package_name }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Durasi</span>
            <span class="detail-value">{{ $booking->duration }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Tanggal</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($booking->booking_date)->isoFormat('dddd, D MMMM YYYY') }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Waktu</span>
            <span class="detail-value">{{ $booking->booking_time }} WIB</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Harga</span>
            <span class="detail-value">{{ $booking->price }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Nama</span>
            <span class="detail-value">{{ $booking->full_name }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Email</span>
            <span class="detail-value">{{ $booking->email }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Telepon</span>
            <span class="detail-value">{{ $booking->phone }}</span>
        </div>

        @if($booking->company)
        <div class="detail-row">
            <span class="detail-label">Perusahaan</span>
            <span class="detail-value">{{ $booking->company }}</span>
        </div>
        @endif

        @if($booking->notes)
        <div class="detail-row">
            <span class="detail-label">Catatan</span>
            <span class="detail-value">{{ $booking->notes }}</span>
        </div>
        @endif

        <div class="detail-row">
            <span class="detail-label">Status</span>
            <span class="detail-value">
                <span style="background: #ffc107; color: #856404; padding: 5px 15px; border-radius: 20px; font-size: 0.9rem;">
                    <i class="bi bi-clock-history me-1"></i>{{ ucfirst($booking->status) }}
                </span>
            </span>
        </div>
    </div>

    <!-- Confirmation Payment Section -->
    <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 30px; border-radius: 12px; color: white; text-align: center; margin-bottom: 30px;">
        <h3 style="color: white; margin-bottom: 15px; font-weight: 700;">
            <i class="bi bi-check-circle me-2"></i>Konfirmasi Pembayaran
        </h3>
        <p style="margin-bottom: 25px; opacity: 0.95;">
            Silakan konfirmasi pembayaran Anda melalui WhatsApp untuk mempercepat proses verifikasi
        </p>
        
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            @php
                $whatsappNumber = $company->whatsapp ?? '6281234567890';
                $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
                if (substr($cleanNumber, 0, 1) === '0') {
                    $cleanNumber = '62' . substr($cleanNumber, 1);
                }
                
                $message = "Halo, saya ingin konfirmasi pembayaran booking konsultasi:\n\n";
                $message .= "Nomor Booking: #" . str_pad($booking->id, 6, '0', STR_PAD_LEFT) . "\n";
                $message .= "Nama: " . $booking->full_name . "\n";
                $message .= "Konsultan: " . $booking->consultant->name . "\n";
                $message .= "Paket: " . $booking->package_name . "\n";
                $message .= "Tanggal: " . \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') . "\n";
                $message .= "Waktu: " . $booking->booking_time . " WIB\n";
                $message .= "Harga: " . $booking->price . "\n\n";
                $message .= "Terima kasih!";
                
                $whatsappUrl = "https://wa.me/" . $cleanNumber . "?text=" . urlencode($message);
            @endphp
            
            <a href="{{ $whatsappUrl }}" target="_blank" class="whatsapp-btn" style="background: #25D366; color: white; padding: 15px 35px; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; font-size: 1.1rem;">
                <i class="bi bi-whatsapp" style="font-size: 1.8rem;"></i>
                <span>Konfirmasi via WhatsApp</span>
            </a>
        </div>
        
        <p style="margin-top: 20px; margin-bottom: 0; font-size: 0.9rem; opacity: 0.9;">
            <i class="bi bi-info-circle me-1"></i>
            WhatsApp: <strong>{{ $company->whatsapp ?? '0812-3456-7890' }}</strong>
        </p>
    </div>

    <div class="next-steps">
        <h3>Langkah Selanjutnya</h3>
        
        <div class="step">
            <div class="step-number">1</div>
            <div class="step-content">
                <strong>Konfirmasi via WhatsApp</strong>
                <p>Kirim konfirmasi pembayaran melalui WhatsApp kami di <strong>{{ $company->whatsapp ?? '0812-3456-7890' }}</strong> dengan detail booking Anda.</p>
            </div>
        </div>

        <div class="step">
            <div class="step-number">2</div>
            <div class="step-content">
                <strong>Verifikasi Tim</strong>
                <p>Tim kami akan memverifikasi pembayaran Anda dalam 1×24 jam dan mengirimkan link meeting via WhatsApp.</p>
            </div>
        </div>

        <div class="step">
            <div class="step-number">3</div>
            <div class="step-content">
                <strong>Persiapan Konsultasi</strong>
                <p>Siapkan materi atau pertanyaan yang ingin Anda diskusikan selama sesi konsultasi.</p>
            </div>
        </div>

        <div class="step">
            <div class="step-number">4</div>
            <div class="step-content">
                <strong>Meeting Online</strong>
                <p>Bergabunglah dengan meeting sesuai jadwal menggunakan link yang telah dikirimkan.</p>
            </div>
        </div>
    </div>

    <div class="contact-card">
        <h4><i class="bi bi-headset me-2"></i>Butuh Bantuan?</h4>
        <p><i class="bi bi-envelope me-2"></i>{{ $company->email ?? 'info@leveons.com' }}</p>
        <p><i class="bi bi-telephone me-2"></i>{{ $company->phone ?? '+62 21 1234 5678' }}</p>
    </div>

    <div class="actions">
        <a href="{{ route('home') }}" class="btn btn-outline">
            <i class="bi bi-house me-2"></i>Kembali ke Home
        </a>
        <a href="{{ route('consultants.index') }}" class="btn btn-primary">
            <i class="bi bi-people me-2"></i>Lihat Konsultan Lain
        </a>
    </div>
</div>
@endsection
