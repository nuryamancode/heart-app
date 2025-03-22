@extends('user.test.components.base-test', ['title' => 'Soal 1'])
@section('content-test')
    <section id="test-sec" style="margin-bottom: -50px">
        <div class="test-first-sec">
            <form id="testForm" action="{{ route('soal-2', ['test' => $test]) }}" method="GET">
                <div class="question-sec" style="padding: 20px 0;">
                    <h2 class="question-sec-title">Umur</h2>
                </div>
                <div class="answer-sec" style="padding: 20px 0;">
                    <div class="container">
                        <div class="age-answer">
                            <div class="age-control">
                                <button type="button" id="decrement" class="btn">-</button>
                                <input type="text" name="age" id="age" value="0" readonly>
                                <button type="button" id="increment" class="btn">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="question-sec" style="padding: 20px 0;">
                    <h2 class="question-sec-title">Jenis Kelamin</h2>
                </div>
                <div class="answer-sec" style="padding: 20px 0;">
                    <div class="container">
                        <div class="gender-selection">
                            <label class="gender-option">
                                <input type="radio" name="gender" value="wanita">
                                <div class="gender-icon">
                                    <img src="{{ asset('/') }}assets/image-new/female.svg" alt="Wanita">
                                    <span>Wanita</span>
                                </div>
                            </label>
                            <label class="gender-option">
                                <input type="radio" name="gender" value="laki-laki">
                                <div class="gender-icon">
                                    <img src="{{ asset('/') }}assets/image-new/male.svg" alt="Laki-Laki">
                                    <span>Laki - Laki</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="tutorial-btn-que">
                    <button type="submit">Lanjut</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ageInput = document.getElementById('age');
            const incrementBtn = document.getElementById('increment');
            const decrementBtn = document.getElementById('decrement');
            const form = document.getElementById('testForm');

            // Increment and decrement age value
            incrementBtn.addEventListener('click', function() {
                ageInput.value = parseInt(ageInput.value) + 1;
            });

            decrementBtn.addEventListener('click', function() {
                if (parseInt(ageInput.value) > 0) {
                    ageInput.value = parseInt(ageInput.value) - 1;
                }
            });

            // Form validation before submission
            form.addEventListener('submit', function(event) {
                const genderSelected = document.querySelector('input[name="gender"]:checked');
                const ageValue = parseInt(ageInput.value);

                // Validasi umur
                if (ageValue === 0) {
                    event.preventDefault(); // Prevent form submission
                    alert('Umur tidak boleh 0. Silakan masukkan umur yang valid.');
                    return;
                }

                // Validasi jenis kelamin
                if (!genderSelected) {
                    event.preventDefault(); // Prevent form submission
                    alert('Silakan pilih jenis kelamin terlebih dahulu.');
                }
            });
        });
    </script>
@endsection
