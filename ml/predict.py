import sys
import json
import joblib
import pandas as pd
import os

ml_dir = os.path.dirname(os.path.abspath(__file__))

model    = joblib.load(os.path.join(ml_dir, 'model_kredit.pkl'))
encoders = joblib.load(os.path.join(ml_dir, 'label_encoders.pkl'))
fitur    = joblib.load(os.path.join(ml_dir, 'fitur_list.pkl'))

# Baca input dari file (solusi Windows) atau argumen biasa
if '--file' in sys.argv:
    file_path = sys.argv[sys.argv.index('--file') + 1]
    with open(file_path, 'r') as f:
        data = json.load(f)
else:
    data = json.loads(sys.argv[1])

# Encode kolom kategorikal
kolom_kategori = ['person_home_ownership', 'loan_intent', 'loan_grade', 'cb_person_default_on_file']
for col in kolom_kategori:
    data[col] = encoders[col].transform([data[col]])[0]

df_input = pd.DataFrame([[data[f] for f in fitur]], columns=fitur)

pred  = model.predict(df_input)[0]
proba = model.predict_proba(df_input)[0]
label = 'Berisiko' if pred == 1 else 'Aman'

print(json.dumps({
    'status'      : label,
    'loan_status' : int(pred),
    'probabilitas': {
        'aman'     : round(float(proba[0])*100, 2),
        'berisiko' : round(float(proba[1])*100, 2)
    }
}))