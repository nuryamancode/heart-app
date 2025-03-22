@extends('admin.base.layout', ['title' => 'Test Manual'])

@section('page-content')
    <div class="container">
        <div class="form-container">
            <form action="/submit" method="POST">
                <h2 class="form-title">Test Manual</h2>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama Anda">
                </div>
                <div class="form-group">
                    <label for="age">Umur</label>
                    <input type="number" id="age" name="age" placeholder="Masukkan umur Anda">
                </div>
                <div class="form-group">
                    <label for="dropdown">Jenis Kelamin</label>
                    <select id="dropdown" name="dropdown">
                        <option value="" disabled selected>Pilih salah satu</option>
                        <option value="1">Laki - Laki</option>
                        <option value="0">Perempuan</option>
                    </select>
                </div>
                <h3 class="fw-bold mb-3 text-primary">Pertanyaan</h3>
                <div class="group mb-3">
                    <label class="title-label">Tekanan Darah (Sistole) > 140</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="tekanan_darah"
                                id="ya_tekanan_darah" value="1">
                            <label class="form-check-label" for="ya_tekanan_darah">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="tekanan_darah" id="tidak_tekanan_darah"
                                value="0">
                            <label class="form-check-label" for="tidak_tekanan_darah">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Kegemukan</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="kegemukan"
                                id="ya_kegemukan" value="1">
                            <label class="form-check-label" for="ya_kegemukan">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="kegemukan" id="tidak_kegemukan"
                                value="0">
                            <label class="form-check-label" for="tidak_kegemukan">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Perokok</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="perokok"
                                id="ya_perokok" value="1">
                            <label class="form-check-label" for="ya_perokok">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="perokok" id="tidak_perokok"
                                value="0">
                            <label class="form-check-label" for="tidak_perokok">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Mempunyai Riwayat Penyakit Jantung</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="riwayat_penyakit_jantung"
                                id="ya_riwayat_penyakit_jantung" value="2">
                            <label class="form-check-label" for="ya_riwayat_penyakit_jantung">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="riwayat_penyakit_jantung" id="tidak_riwayat_penyakit_jantung"
                                value="0">
                            <label class="form-check-label" for="tidak_riwayat_penyakit_jantung">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Mempunyai Riwayat Penyakit Hiperkolesterol</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="riwayat_penyakit_hiperkolestrol"
                                id="ya_riwayat_penyakit_hiperkolestrol" value="1">
                            <label class="form-check-label" for="ya_riwayat_penyakit_hiperkolestrol">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="riwayat_penyakit_hiperkolestrol" id="tidak_riwayat_penyakit_hiperkolestrol"
                                value="0">
                            <label class="form-check-label" for="tidak_riwayat_penyakit_hiperkolestrol">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Mempunyai Riwayat Kencing Manis</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="riwayat_kencing_manis"
                                id="ya_riwayat_kencing_manis" value="1">
                            <label class="form-check-label" for="ya_riwayat_kencing_manis">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="riwayat_kencing_manis" id="tidak_riwayat_kencing_manis"
                                value="0">
                            <label class="form-check-label" for="tidak_riwayat_kencing_manis">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Mempunyai Riwayat Stroke</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="riwayat_stroke"
                                id="ya_riwayat_stroke" value="1">
                            <label class="form-check-label" for="ya_riwayat_stroke">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="riwayat_stroke" id="tidak_riwayat_stroke"
                                value="0">
                            <label class="form-check-label" for="tidak_riwayat_stroke">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Mempunyai Riwayat Keluhan Nyeri Dada Khas Angina</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="riwayat_keluhan_nyeri_dada"
                                id="ya_riwayat_keluhan_nyeri_dada" value="1">
                            <label class="form-check-label" for="ya_riwayat_keluhan_nyeri_dada">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="riwayat_keluhan_nyeri_dada" id="tidak_riwayat_keluhan_nyeri_dada"
                                value="0">
                            <label class="form-check-label" for="tidak_riwayat_keluhan_nyeri_dada">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Nyeri Dada Menjalar Punggung Leher Bahu dan Epigastrium</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="nyeri_dada_menjalar"
                                id="ya_nyeri_dada_menjalar" value="5">
                            <label class="form-check-label" for="ya_nyeri_dada_menjalar">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="nyeri_dada_menjalar" id="tidak_nyeri_dada_menjalar"
                                value="0">
                            <label class="form-check-label" for="tidak_nyeri_dada_menjalar">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Keringat Dingin Tanpa Sebab</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="keringat_dingin"
                                id="ya_keringat_dingin" value="2">
                            <label class="form-check-label" for="ya_keringat_dingin">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="keringat_dingin" id="tidak_keringat_dingin"
                                value="0">
                            <label class="form-check-label" for="tidak_keringat_dingin">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Mudah Lelah</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="mudah_lelah"
                                id="ya_mudah_lelah" value="2">
                            <label class="form-check-label" for="ya_mudah_lelah">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="mudah_lelah" id="tidak_mudah_lelah"
                                value="0">
                            <label class="form-check-label" for="tidak_mudah_lelah">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="group mb-3">
                    <label class="title-label">Nyeri Epigastrium</label>
                    <div class="choice mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="nyeri_epigastrium"
                                id="ya_nyeri_epigastrium" value="2">
                            <label class="form-check-label" for="ya_nyeri_epigastrium">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input border-secondary" type="radio" name="nyeri_epigastrium" id="tidak_nyeri_epigastrium"
                                value="0">
                            <label class="form-check-label" for="tidak_nyeri_epigastrium">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-btn">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
