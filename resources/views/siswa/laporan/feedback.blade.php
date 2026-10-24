<div class="feedback-section-modern mb-4 p-4 rounded-3 border" 
     style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border: 1px solid #e2e8f0;">

    <div class="text-muted small mb-3 d-flex align-items-center gap-2">
        <i class="bi bi-star-fill text-warning"></i>
        Feedback Kepuasan
    </div>

    @if ($laporan->aspirasi?->feedback)

        {{-- ✅ SUDAH FEEDBACK --}}
        <div class="feedback-completed-modern p-4 rounded-2xl bg-white shadow-sm border-start border-4 border-success">
            <div class="d-flex align-items-center gap-3 mb-2">
                <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-1 fw-semibold text-success">Feedback Telah Diberikan</h6>
                    <small class="text-muted">Terima kasih atas penilaian Anda</small>
                </div>
            </div>
            <div class="feedback-result-modern">
                <div class="d-flex align-items-center gap-3">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi {{ $i <= $laporan->aspirasi?->feedback ? 'bi-star-fill text-warning' : 'bi-star text-muted' }} fs-4"></i>
                    @endfor
                </div>
                <div class="mt-2 fw-semibold text-dark fs-5">
                    {{ [
                        1 => 'Tidak Puas',
                        2 => 'Kurang Puas', 
                        3 => 'Cukup Puas',
                        4 => 'Puas',
                        5 => 'Sangat Puas',
                    ][$laporan->aspirasi?->feedback] ?? '-' }}
                </div>
            </div>
        </div>

    @else

        {{-- ⭐ FORM FEEDBACK --}}
        <form action="{{ route('siswa.laporan.feedback', $laporan->aspirasi->id) }}" method="POST" id="feedbackForm">
            @csrf

            {{-- Rating Stars --}}
            <div class="rating-stars-modern mb-4">
                <div class="stars-container d-flex justify-content-center gap-1 mb-3">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" 
                               name="feedback" 
                               id="star{{ $i }}" 
                               value="{{ $i }}" 
                               class="star-input"
                               hidden>
                        
                        <label for="star{{ $i }}" class="star-label">
                            <i class="bi bi-star star-icon"></i>
                        </label>
                    @endfor
                </div>

                {{-- Rating Text --}}
                <div id="ratingDisplay" 
                     class="text-center transition-all">
                    <span id="ratingEmoji" style="font-size: 2.5rem; line-height: 1;">⭐</span>
                    <div id="ratingText" class="fw-semibold text-muted mt-2 fs-5">
                        Pilih rating kepuasan Anda
                    </div>
                </div>
            </div>

            @error('feedback')
                <div class="alert alert-danger alert-modern py-2 mb-3 small" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ $message }}
                </div>
            @enderror

            {{-- Submit Button --}}
            <button type="submit" 
                    class="btn btn-primary-modern w-100 fw-semibold py-3 rounded-2xl position-relative overflow-hidden"
                    id="submitFeedbackBtn"
                    disabled>
                <span class="btn-text">
                    <i class="bi bi-send-fill me-2"></i>
                    Kirim Feedback
                </span>
                <span class="btn-loading d-none">
                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                    Mengirim...
                </span>
            </button>
        </form>

    @endif
</div>

{{-- Modern Styles --}}
<style>
.feedback-section-modern {
    border-radius: 20px;
    transition: all 0.3s ease;
}

.feedback-section-modern:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

/* Star Rating Modern */
.rating-stars-modern {
    padding: 1.5rem;
    background: rgba(255,255,255,0.6);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.3);
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.stars-container {
    direction: rtl;
}

.star-label {
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 12px;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
}

.star-label:hover {
    background: rgba(251,191,36,0.1);
    transform: scale(1.1);
}

.star-icon {
    font-size: 2rem;
    color: #d1d5db;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.star-input:checked ~ .star-label .star-icon,
.star-input:checked ~ .star-label:hover .star-icon,
.star-label:hover .star-icon {
    color: #fbbf24;
    text-shadow: 0 2px 8px rgba(251,191,36,0.4);
}

.star-input:checked ~ .star-label .star-icon {
    color: #facc15;
}

/* Button Modern */
.btn-primary-modern {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border: none;
    box-shadow: 0 6px 20px rgba(59,130,246,0.3);
    position: relative;
    overflow: hidden;
}

.btn-primary-modern:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(59,130,246,0.4);
}

.btn-primary-modern:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Completed Feedback */
.feedback-completed-modern {
    border-radius: 20px;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
}

.feedback-result-modern {
    margin-top: 1.5rem;
    padding: 1.5rem;
    background: rgba(255,255,255,0.7);
    border-radius: 16px;
    border: 1px solid rgba(16,185,129,0.2);
}

/* Animations */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.ratingDisplay {
    animation: pulse 2s infinite;
}

/* Responsive */
@media (max-width: 576px) {
    .stars-container {
        gap: 0.25rem;
    }
    
    .star-icon {
        font-size: 1.75rem;
    }
}
</style>

{{-- Enhanced Script --}}
<script>
const ratingData = {
    1: { emoji: '😡', text: 'Tidak Puas', color: '#ef4444' },
    2: { emoji: '😕', text: 'Kurang Puas', color: '#f59e0b' },
    3: { emoji: '😐', text: 'Cukup Puas', color: '#6b7280' },
    4: { emoji: '🙂', text: 'Puas', color: '#10b981' },
    5: { emoji: '😍', text: 'Sangat Puas', color: '#059669' }
};

document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star-input');
    const ratingDisplay = document.getElementById('ratingDisplay');
    const ratingEmoji = document.getElementById('ratingEmoji');
    const ratingText = document.getElementById('ratingText');
    const submitBtn = document.getElementById('submitFeedbackBtn');
    const form = document.getElementById('feedbackForm');

    // Star rating functionality
    stars.forEach(star => {
        star.addEventListener('change', function() {
            const rating = this.value;
            const data = ratingData[rating];
            
            // Update display
            ratingEmoji.textContent = data.emoji;
            ratingEmoji.style.color = data.color;
            ratingText.textContent = data.text;
            
            // Enable submit button
            submitBtn.disabled = false;
            submitBtn.classList.add('btn-primary-modern');
            
            // Visual feedback
            ratingDisplay.style.transform = 'scale(1.05)';
            setTimeout(() => {
                ratingDisplay.style.transform = 'scale(1)';
            }, 200);
        });
    });

    // Form submission
    form?.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.querySelector('.btn-text').classList.add('d-none');
        submitBtn.querySelector('.btn-loading').classList.remove('d-none');
    });

    // Reset rating on page load if no selection
    const selectedRating = document.querySelector('input[name="feedback"]:checked');
    if (!selectedRating) {
        ratingEmoji.textContent = '⭐';
        ratingText.textContent = 'Pilih rating kepuasan Anda';
        submitBtn.disabled = true;
    }
});
</script>