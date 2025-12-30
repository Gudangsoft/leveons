@extends('layouts.frontend')

@section('title', 'Book ' . $consultant->name . ' - ' . $company->name)

@push('styles')
<style>
    .booking-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .booking-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .consultant-mini {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .consultant-mini-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e9ecef;
    }

    .package-summary {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .calendar-wrapper {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .calendar-header h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
    }

    .calendar-nav {
        display: flex;
        gap: 10px;
    }

    .calendar-nav button {
        background: white;
        border: 2px solid #e9ecef;
        padding: 8px 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .calendar-nav button:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }

    .calendar-day-header {
        text-align: center;
        font-weight: 600;
        color: #666;
        padding: 10px 0;
        font-size: 0.9rem;
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .calendar-day:hover:not(.disabled):not(.past) {
        border-color: var(--primary-color);
        background: #f0f7ff;
    }

    .calendar-day.selected {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .calendar-day.disabled {
        color: #ccc;
        cursor: not-allowed;
        background: #f8f9fa;
    }

    .calendar-day.past {
        color: #ccc;
        cursor: not-allowed;
    }

    .calendar-day.today {
        border-color: var(--secondary-color);
        font-weight: 700;
    }

    .time-slots {
        margin-top: 30px;
    }

    .time-slots h4 {
        margin-bottom: 20px;
        font-weight: 700;
    }

    .time-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 10px;
    }

    .time-slot {
        padding: 15px;
        text-align: center;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .time-slot:hover:not(.disabled) {
        border-color: var(--primary-color);
        background: #f0f7ff;
    }

    .time-slot.selected {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .time-slot.disabled {
        color: #ccc;
        cursor: not-allowed;
        background: #f8f9fa;
    }

    .btn-next {
        background: var(--primary-color);
        color: white;
        padding: 15px 40px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 30px;
    }

    .btn-next:hover:not(:disabled) {
        background: #1a5c96;
        transform: translateY(-2px);
    }

    .btn-next:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .calendar-grid {
            gap: 5px;
        }

        .calendar-day {
            font-size: 0.9rem;
        }

        .time-grid {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        }
    }
</style>
@endpush

@section('content')
<div class="booking-container">
    <div class="booking-header">
        <div class="consultant-mini">
            @if($consultant->avatar)
                <img src="{{ asset('storage/' . $consultant->avatar) }}" 
                     alt="{{ $consultant->name }}" 
                     class="consultant-mini-avatar">
            @else
                <div class="consultant-mini-avatar bg-light d-flex align-items-center justify-content-center">
                    <i class="bi bi-person"></i>
                </div>
            @endif
            <div>
                <h2 style="margin: 0; font-size: 1.5rem;">{{ $consultant->name }}</h2>
                <p style="margin: 0; color: #666;">{{ $consultant->title }}</p>
            </div>
        </div>
    </div>

    @if($selectedPackage)
        @php
            // Handle both database objects and JSON arrays
            if (is_object($selectedPackage)) {
                $packageName = $selectedPackage->name;
                $packageDuration = $selectedPackage->duration;
                $packagePlatform = $selectedPackage->platform;
                $packagePriceDisplay = $selectedPackage->price_display;
            } else {
                $packageName = $selectedPackage['name'];
                $packageDuration = $selectedPackage['duration'];
                $packagePlatform = $selectedPackage['platform'];
                $packagePriceDisplay = $selectedPackage['price_display'];
            }
        @endphp
        
        <div class="package-summary">
            <h4 style="margin-bottom: 10px; font-weight: 700;">{{ $packageName }}</h4>
            <div style="display: flex; gap: 20px; flex-wrap: wrap; color: #666;">
                <span><i class="bi bi-clock me-2"></i>{{ $packageDuration }}</span>
                <span><i class="bi bi-camera-video me-2"></i>{{ $packagePlatform }}</span>
                <span><i class="bi bi-cash-coin me-2"></i>{{ $packagePriceDisplay }}</span>
            </div>
        </div>
    @endif

    <div class="calendar-wrapper">
        <div class="calendar-header">
            <h3>Pilih Tanggal & Waktu</h3>
            <div class="calendar-nav">
                <button onclick="previousMonth()"><i class="bi bi-chevron-left"></i></button>
                <button onclick="nextMonth()"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>

        <div class="calendar-grid" id="calendarGrid">
            <!-- Will be populated by JavaScript -->
        </div>

        <div class="time-slots" id="timeSlots" style="display: none;">
            <h4>Pilih Waktu</h4>
            <div class="time-grid" id="timeGrid">
                <!-- Will be populated by JavaScript -->
            </div>
        </div>

        <button class="btn-next" id="nextBtn" disabled onclick="goToDetails()">
            Lanjut ke Detail
        </button>
    </div>
</div>

@push('scripts')
<script>
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let selectedDate = null;
let selectedTime = null;

const timeSlots = [
    '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
    '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00'
];

function renderCalendar() {
    const firstDay = new Date(currentYear, currentMonth, 1);
    const lastDay = new Date(currentYear, currentMonth + 1, 0);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    const grid = document.getElementById('calendarGrid');
    grid.innerHTML = '';
    
    // Day headers
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    days.forEach(day => {
        const header = document.createElement('div');
        header.className = 'calendar-day-header';
        header.textContent = day;
        grid.appendChild(header);
    });
    
    // Empty cells for days before month starts
    for (let i = 0; i < firstDay.getDay(); i++) {
        const empty = document.createElement('div');
        empty.className = 'calendar-day disabled';
        grid.appendChild(empty);
    }
    
    // Days of month
    for (let day = 1; day <= lastDay.getDate(); day++) {
        const date = new Date(currentYear, currentMonth, day);
        date.setHours(0, 0, 0, 0);
        
        const dayCell = document.createElement('div');
        dayCell.className = 'calendar-day';
        dayCell.textContent = day;
        
        if (date < today) {
            dayCell.classList.add('past');
        } else if (date.getTime() === today.getTime()) {
            dayCell.classList.add('today');
        }
        
        if (date >= today && date.getDay() !== 0 && date.getDay() !== 6) {
            dayCell.onclick = () => selectDate(date, dayCell);
        } else if (date >= today) {
            // Weekend
            dayCell.classList.add('disabled');
        }
        
        grid.appendChild(dayCell);
    }
}

function selectDate(date, element) {
    // Remove previous selection
    document.querySelectorAll('.calendar-day.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection
    element.classList.add('selected');
    selectedDate = date.toISOString().split('T')[0];
    selectedTime = null;
    
    // Show time slots
    document.getElementById('timeSlots').style.display = 'block';
    renderTimeSlots();
    
    // Disable next button until time is selected
    document.getElementById('nextBtn').disabled = true;
}

function renderTimeSlots() {
    const grid = document.getElementById('timeGrid');
    grid.innerHTML = '';
    
    timeSlots.forEach(time => {
        const slot = document.createElement('div');
        slot.className = 'time-slot';
        slot.textContent = time;
        slot.onclick = () => selectTime(time, slot);
        grid.appendChild(slot);
    });
}

function selectTime(time, element) {
    // Remove previous selection
    document.querySelectorAll('.time-slot.selected').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Add selection
    element.classList.add('selected');
    selectedTime = time;
    
    // Enable next button
    document.getElementById('nextBtn').disabled = false;
}

function previousMonth() {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    renderCalendar();
}

function nextMonth() {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderCalendar();
}

function goToDetails() {
    if (selectedDate && selectedTime) {
        const url = new URL('{{ route("booking.details", $consultant->slug) }}', window.location.origin);
        url.searchParams.append('date', selectedDate);
        url.searchParams.append('time', selectedTime);
        url.searchParams.append('package', '{{ request()->get("package", 0) }}');
        window.location.href = url.toString();
    }
}

// Initialize calendar
document.addEventListener('DOMContentLoaded', () => {
    renderCalendar();
});
</script>
@endpush
@endsection
