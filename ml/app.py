from flask import Flask, request, jsonify
import joblib
import pandas as pd
import numpy as np
import os

app    = Flask(__name__)
ml_dir = os.path.dirname(os.path.abspath(__file__))

model    = joblib.load(os.path.join(ml_dir, 'model_kredit.pkl'))
encoders = joblib.load(os.path.join(ml_dir, 'label_encoders.pkl'))
fitur    = joblib.load(os.path.join(ml_dir, 'fitur_list.pkl'))

VALID_HOME_OWNERSHIP = ['RENT', 'OWN', 'MORTGAGE', 'OTHER']
VALID_LOAN_INTENT    = ['PERSONAL', 'EDUCATION', 'MEDICAL', 'VENTURE', 'HOMEIMPROVEMENT', 'DEBTCONSOLIDATION']
VALID_LOAN_GRADE     = ['A', 'B', 'C', 'D', 'E', 'F', 'G']
VALID_DEFAULT_FILE   = ['Y', 'N']

@app.route('/')
def root():
    return jsonify({"status": "SPK Kredit API Running ✅", "version": "2.0"})

@app.route('/predict', methods=['POST'])
def predict():
    data = request.get_json()

    if not data:
        return jsonify({'error': 'Data tidak ditemukan'}), 400

    # ── Validasi input ────────────────────────────────────
    required = ['person_age', 'person_income', 'person_home_ownership',
                'person_emp_length', 'loan_intent', 'loan_grade', 'loan_amnt',
                'loan_int_rate', 'loan_percent_income', 'cb_person_default_on_file',
                'cb_person_cred_hist_length']

    for field in required:
        if field not in data:
            return jsonify({'error': f'Field {field} wajib diisi'}), 400

    # uppercase string fields
    data['person_home_ownership']    = str(data['person_home_ownership']).upper()
    data['loan_intent']              = str(data['loan_intent']).upper()
    data['loan_grade']               = str(data['loan_grade']).upper()
    data['cb_person_default_on_file']= str(data['cb_person_default_on_file']).upper()

    if data['person_home_ownership'] not in VALID_HOME_OWNERSHIP:
        return jsonify({'error': f"person_home_ownership harus salah satu dari {VALID_HOME_OWNERSHIP}"}), 422
    if data['loan_intent'] not in VALID_LOAN_INTENT:
        return jsonify({'error': f"loan_intent harus salah satu dari {VALID_LOAN_INTENT}"}), 422
    if data['loan_grade'] not in VALID_LOAN_GRADE:
        return jsonify({'error': f"loan_grade harus salah satu dari {VALID_LOAN_GRADE}"}), 422
    if data['cb_person_default_on_file'] not in VALID_DEFAULT_FILE:
        return jsonify({'error': f"cb_person_default_on_file harus salah satu dari {VALID_DEFAULT_FILE}"}), 422

    # ── Encode kolom kategorikal ──────────────────────────
    kolom_kategori = ['person_home_ownership', 'loan_intent', 'loan_grade', 'cb_person_default_on_file']
    for col in kolom_kategori:
        data[col] = encoders[col].transform([data[col]])[0]

    df_input = pd.DataFrame([[data[f] for f in fitur]], columns=fitur)

    # ── Credit Scoring ────────────────────────────────────
    pred       = model.predict(df_input)[0]
    proba      = model.predict_proba(df_input)[0]
    label      = 'Berisiko' if pred == 1 else 'Aman'
    risk_score = round(float(proba[1]) * 100, 2)

    # ── Capacity Analysis ─────────────────────────────── ──
    pendapatan_bulanan = float(data['person_income']) / 12
    dsr_saat_ini       = float(data['loan_percent_income'])
    sisa_kapasitas_dsr = max(0.0, 0.35 - dsr_saat_ini)
    max_cicilan        = pendapatan_bulanan * sisa_kapasitas_dsr

    bunga_bulanan = (float(data['loan_int_rate']) / 100) / 12
    tenor_bulan   = 36

    if bunga_bulanan > 0 and max_cicilan > 0:
        limit_kapasitas = max_cicilan * (1 - (1 + bunga_bulanan) ** -tenor_bulan) / bunga_bulanan
    else:
        limit_kapasitas = max_cicilan * tenor_bulan

    # ── Risk-Adjusted Limit ───────────────────────────────
    risk_penalty = float(proba[1])
    limit_final  = max(0.0, limit_kapasitas * (1 - risk_penalty * 0.7))

    return jsonify({
        'status'      : label,
        'loan_status' : int(pred),
        'skor_risiko' : risk_score,
        'probabilitas': {
            'aman'    : round(float(proba[0]) * 100, 2),
            'berisiko': risk_score,
        },
        'analisis_kapasitas': {
            'pendapatan_bulanan'   : round(pendapatan_bulanan, 2),
            'dsr_saat_ini_persen'  : round(dsr_saat_ini * 100, 2),
            'sisa_kapasitas_dsr'   : round(sisa_kapasitas_dsr * 100, 2),
            'limit_kemampuan_bayar': round(limit_kapasitas, 2),
        },
        'limit_rekomendasi': round(limit_final, 2),
        'justifikasi'      : None,
    })

if __name__ == '__main__':
  app.run(host='127.0.0.1', port=8001, debug=False)