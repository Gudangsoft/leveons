@extends('layouts.frontend')

@section('title', 'Invoice - ' . $company->name)

@push('styles')
<style>
    .invoice-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 60px 20px;
        background: #f5f5f5;
        min-height: 100vh;
    }

    .invoice-wrapper {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 30px;
    }

    .invoice-left {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    }

    .invoice-right {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        align-self: start;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 25px;
        color: #1a1a1a;
    }

    .info-group {
        margin-bottom: 25px;
    }

    .info-label {
        font-weight: 600;
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .info-value {
        color: #1a1a1a;
        font-size: 1rem;
        padding: 10px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .info-value.highlight {
        background: #f8f9fa;
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        border-bottom: 1px solid #e9ecef;
    }

    .order-summary {
        margin-bottom: 25px;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 5px;
    }

    .item-qty {
        color: #666;
        font-size: 0.9rem;
    }

    .item-meta {
        font-size: 0.85rem;
        color: #999;
        margin-top: 8px;
    }

    .item-price {
        font-weight: 700;
        color: #1a1a1a;
        white-space: nowrap;
        margin-left: 20px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        font-size: 1rem;
    }

    .price-row.total {
        border-top: 2px solid #1a1a1a;
        margin-top: 15px;
        padding-top: 15px;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .alert-info {
        background: #fff3cd;
        border: 1px solid #ffc107;
        color: #856404;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }

    .alert-info i {
        font-size: 1.2rem;
        margin-top: 2px;
    }

    .terms-section {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid #e9ecef;
    }

    .terms-text {
        font-size: 0.9rem;
        color: #666;
        line-height: 1.6;
    }

    .terms-text a {
        color: #3b82f6;
        text-decoration: none;
    }

    .terms-text a:hover {
        text-decoration: underline;
    }

    .checkbox-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-top: 15px;
    }

    .checkbox-wrapper input[type="checkbox"] {
        margin-top: 3px;
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .checkbox-wrapper label {
        cursor: pointer;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .btn-submit {
        width: 100%;
        padding: 16px;
        background: #f97316;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.05rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .btn-submit:hover:not(:disabled) {
        background: #ea580c;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
    }

    .btn-submit:disabled {
        background: #d1d5db;
        cursor: not-allowed;
    }

    @media (max-width: 968px) {
        .invoice-wrapper {
            grid-template-columns: 1fr;
        }

        .invoice-right {
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .invoice-container {
            padding: 20px 15px;
        }

        .invoice-left,
        .invoice-right {
            padding: 25px 20px;
        }

        .section-title {
            font-size: 1.3rem;
        }
    }
</style>
@endpush

@section('content')
<div class="invoice-container">
    <div class="invoice-wrapper">
        <!-- Left Column: Detail Tagihan -->
        <div class="invoice-left">
            <h2 class="section-title">Detail Tagihan</h2>

            <div class="info-group">
                <div class="info-label">Nama depan</div>
                <div class="info-value">{{ $validated['full_name'] }}</div>
            </div>

            <div class="info-group">
                <div class="info-label">Nama belakang</div>
                <div class="info-value">-</div>
            </div>

            <div class="info-group">
                <div class="info-label">Telepon</div>
                <div class="info-value">{{ $validated['phone'] }}</div>
            </div>

            <div class="info-group">
                <div class="info-label">Alamat email</div>
                <div class="info-value highlight">{{ $validated['email'] }}</div>
            </div>

            @if(isset($validated['notes']) && $validated['notes'])
            <div class="info-group">
                <div class="info-label">Catatan Pesanan (opsional)</div>
                <div class="info-value">{{ $validated['notes'] }}</div>
            </div>
            @endif

            <div class="terms-section">
                <div class="alert-info">
                    <i class="bi bi-info-circle"></i>
                    <div>
                        <strong>Konfirmasi Pembayaran</strong>
                        <p style="margin: 5px 0 0 0;">Setelah membuat pesanan, Anda akan diarahkan ke halaman konfirmasi. Silakan konfirmasi pembayaran melalui WhatsApp atau Email ke <strong>info@leveons.id</strong> untuk mempercepat proses verifikasi.</p>
                    </div>
                </div>

                <div class="terms-text">
                    Data pribadi Anda akan digunakan untuk memproses pesanan Anda, menunjang pengalaman Anda di seluruh situs web ini, dan untuk tujuan lain yang dijelaskan dalam <a href="#">kebijakan privasi</a> kami.
                </div>

                <form action="{{ route('booking.store', $consultant->slug) }}" method="POST" id="invoiceForm">
                    @csrf
                    
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">
                            Saya sudah membaca dan setuju dengan <a href="#">syarat dan ketentuan</a> *
                        </label>
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn" disabled>
                        Buat pesanan
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column: Pesanan Anda -->
        <div class="invoice-right">
            <h3 class="section-title">Pesanan Anda</h3>

            <div class="order-summary">
                <div style="font-weight: 600; margin-bottom: 15px; display: flex; justify-content: space-between; color: #666;">
                    <span>Produk</span>
                    <span>Subtotal</span>
                </div>

                @php
                    // Handle both database objects and JSON arrays
                    $packageName = isset($packagesFromDB) && $packagesFromDB ? $selectedPackage->name : $selectedPackage['name'];
                    $packageDuration = isset($packagesFromDB) && $packagesFromDB ? $selectedPackage->duration : $selectedPackage['duration'];
                    $packagePriceDisplay = isset($packagesFromDB) && $packagesFromDB ? $selectedPackage->price_display : $selectedPackage['price_display'];
                @endphp

                <div class="order-item">
                    <div class="item-details">
                        <div class="item-name">{{ $packageName }}</div>
                        <div class="item-qty">× 1</div>
                        <div class="item-meta">
                            <strong>Appointment:</strong> 
                            {{ \Carbon\Carbon::parse($validated['booking_date'] . ' ' . $validated['booking_time'])->format('g:i A - ') }}
                            @php
                                $startTime = \Carbon\Carbon::parse($validated['booking_date'] . ' ' . $validated['booking_time']);
                                $duration = (int) filter_var($packageDuration, FILTER_SANITIZE_NUMBER_INT);
                                $endTime = $startTime->copy()->addMinutes($duration);
                            @endphp
                            {{ $endTime->format('g:i A') }}, {{ $startTime->format('d/m/Y') }}
                            <br>(Asia/Jakarta)
                        </div>
                    </div>
                    <div class="item-price">{{ $packagePriceDisplay }}</div>
                </div>
            </div>

            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e9ecef;">
                <div class="price-row">
                    <span>Subtotal</span>
                    <span>{{ $packagePriceDisplay }}</span>
                </div>

                <div class="price-row total">
                    <span>Total</span>
                    <span>{{ $packagePriceDisplay }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const termsCheckbox = document.getElementById('terms');
    const submitBtn = document.getElementById('submitBtn');
    
    termsCheckbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
    });
    
    document.getElementById('invoiceForm').addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses pesanan...';
    });
});
</script>
@endpush
@endsection
