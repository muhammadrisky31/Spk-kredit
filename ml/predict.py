import sys
import json
import joblib
import pandas as pd
import numpy as np
import shap
import os

ml_dir = os.path.dirname(os.path.abspath(__file__))

model    = joblib.load(os.path.join(ml_dir, 'model_kredit.pkl'))
encoders = joblib.load(os.path.join(ml_dir, 'label_encoders.pkl'))
fitur    = joblib.load(os.path.join(ml_dir, 'fitur_list.pkl'))

# Baca input
if '--file' in sys.argv:
    file_path = sys.argv[sys.argv.index('--file') + 1]
    with open(file_path, 'r') as f:
        data = json.load(f)
else:
    data = json.loads(sys.argv[1])

# ── Encode kolom kategorikal ──────────────────────────────
kolom_kategori = ['person_home_ownership', 'loan_intent', 'loan_grade', 'cb_person_default_on_file']
for col in kolom_kategori:
    try:
        data[col] = encoders[col].transform([data[col].upper()])[0]
    except ValueError:
        print(json.dumps({'error': f"Nilai '{data[col]}' tidak valid untuk kolom '{col}'. "
                                   f"Pilihan valid: {list(encoders[col].classes_)}"}))
        sys.exit(1)

df_input = pd.DataFrame([[data[f] for f in fitur]], columns=fitur)

# ── Credit Scoring ────────────────────────────────────────
pred  = model.predict(df_input)[0]
proba = model.predict_proba(df_input)[0]
label = 'Berisiko' if pred == 1 else 'Aman'
risk_score = round(float(proba[1]) * 100, 2)   # skor risiko 0–100

# ── Capacity Analysis (tahap 3 arahan dosen) ─────────────
pendapatan_bulanan = data['person_income'] / 12
dsr_saat_ini       = data['loan_percent_income']          # cicilan/pendapatan
sisa_kapasitas_dsr = max(0.0, 0.35 - dsr_saat_ini)       # bank batasi max 35%
max_cicilan        = pendapatan_bulanan * sisa_kapasitas_dsr

bunga_bulanan = (data['loan_int_rate'] / 100) / 12
tenor_bulan   = 36  # asumsi tenor default 3 tahun

if bunga_bulanan > 0 and max_cicilan > 0:
    limit_kapasitas = max_cicilan * (1 - (1 + bunga_bulanan) ** -tenor_bulan) / bunga_bulanan
else:
    limit_kapasitas = max_cicilan * tenor_bulan

# ── Risk-Adjusted Limit (tahap 4 arahan dosen) ───────────
# Semakin tinggi risiko → limit semakin diturunkan
risk_penalty  = float(proba[1])                           # 0.0 – 1.0
limit_final   = limit_kapasitas * (1 - risk_penalty * 0.7)
limit_final   = max(0.0, round(limit_final, 2))
limit_kapasitas = round(limit_kapasitas, 2)

# ── SHAP – Justifikasi Keputusan (tahap 5 arahan dosen) ──
explainer   = shap.TreeExplainer(model)
shap_values = explainer.shap_values(df_input)

# shap_values[1] = kontribusi tiap fitur ke kelas Berisiko
shap_kelas_berisiko = shap_values[1][0] if isinstance(shap_values, list) else shap_values[0]

nama_fitur_indo = {
    'person_age'               : 'Usia',
    'person_income'            : 'Pendapatan',
    'person_home_ownership'    : 'Kepemilikan Rumah',
    'person_emp_length'        : 'Lama Kerja',
    'loan_intent'              : 'Tujuan Pinjaman',
    'loan_grade'               : 'Grade Pinjaman',
    'loan_amnt'                : 'Jumlah Pinjaman',
    'loan_int_rate'            : 'Suku Bunga',
    'loan_percent_income'      : 'Rasio Pinjaman/Pendapatan',
    'cb_person_default_on_file': 'Riwayat Gagal Bayar',
    'cb_person_cred_hist_length': 'Lama Riwayat Kredit',
}

faktor_risiko   = []  # fitur yang mendorong ke arah Berisiko
faktor_aman     = []  # fitur yang mendorong ke arah Aman

for fname, sval in zip(fitur, shap_kelas_berisiko):
    label_indo = nama_fitur_indo.get(fname, fname)
    entry = {'faktor': label_indo, 'nilai_shap': round(float(sval), 4)}
    if sval > 0:
        faktor_risiko.append(entry)
    elif sval < 0:
        faktor_aman.append(entry)

faktor_risiko.sort(key=lambda x: x['nilai_shap'], reverse=True)
faktor_aman.sort(key=lambda x: x['nilai_shap'])

print(json.dumps({
    'status'      : label,
    'loan_status' : int(pred),
    'skor_risiko' : risk_score,
    'probabilitas': {
        'aman'    : round(float(proba[0]) * 100, 2),
        'berisiko': risk_score
    },
    'analisis_kapasitas': {
        'pendapatan_bulanan'  : round(pendapatan_bulanan, 2),
        'dsr_saat_ini_persen' : round(dsr_saat_ini * 100, 2),
        'sisa_kapasitas_dsr'  : round(sisa_kapasitas_dsr * 100, 2),
        'limit_kemampuan_bayar': limit_kapasitas,
    },
    'limit_rekomendasi': limit_final,
    'justifikasi': {
        'faktor_risiko': faktor_risiko[:3],   # top 3 pendorong risiko
        'faktor_aman'  : faktor_aman[:3],     # top 3 pendorong aman
    }
}, ensure_ascii=False))