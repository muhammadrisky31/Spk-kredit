import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.metrics import accuracy_score, classification_report
from imblearn.over_sampling import SMOTE
import joblib
import os

# ── 1. Load Data ──────────────────────────────────────────
base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
df = pd.read_csv(os.path.join(base_dir, 'credit_risk_dataset.csv'))

# ── 2. Bersihkan Outlier ──────────────────────────────────
df = df[df['person_age'] <= 100].copy()

# ── 3. Isi Missing Values ─────────────────────────────────
df['loan_int_rate']     = df['loan_int_rate'].fillna(df['loan_int_rate'].median())
df['person_emp_length'] = df['person_emp_length'].fillna(df['person_emp_length'].median())
print(f"Missing values tersisa: {df.isnull().sum().sum()}")

# ── 4. Encode Kolom Kategorikal ───────────────────────────
kolom_kategori = ['person_home_ownership', 'loan_intent', 'loan_grade', 'cb_person_default_on_file']
encoders = {}
for col in kolom_kategori:
    le = LabelEncoder()
    df[col] = le.fit_transform(df[col])
    encoders[col] = le

# ── 5. Pisahkan Fitur dan Label ───────────────────────────
fitur = ['person_age', 'person_income', 'person_home_ownership',
         'person_emp_length', 'loan_intent', 'loan_grade', 'loan_amnt',
         'loan_int_rate', 'loan_percent_income', 'cb_person_default_on_file',
         'cb_person_cred_hist_length']

X = df[fitur]
y = df['loan_status']

# ── 6. Seimbangkan Data dengan SMOTE ──────────────────────
smote = SMOTE(random_state=42)
X_balanced, y_balanced = smote.fit_resample(X, y)
print(f"Sebelum SMOTE: {y.value_counts().to_dict()}")
print(f"Setelah SMOTE: {pd.Series(y_balanced).value_counts().to_dict()}")

# ── 7. Split Train/Test ───────────────────────────────────
X_train, X_test, y_train, y_test = train_test_split(
    X_balanced, y_balanced, test_size=0.2, random_state=42
)

# ── 8. Training Random Forest ─────────────────────────────
print("\nTraining Random Forest... (tunggu ~1 menit)")
model = RandomForestClassifier(
    n_estimators=100,      # jumlah pohon
    max_depth=10,          # kedalaman tiap pohon
    min_samples_split=10,
    class_weight='balanced',
    random_state=42,
    n_jobs=-1              # pakai semua CPU biar lebih cepat
)
model.fit(X_train, y_train)

# ── 9. Evaluasi ───────────────────────────────────────────
y_pred = model.predict(X_test)
print(f"\nAkurasi: {accuracy_score(y_test, y_pred)*100:.2f}%")
print("\nLaporan Detail:")
print(classification_report(y_test, y_pred, target_names=['Aman', 'Berisiko']))

# ── 10. Feature Importance ────────────────────────────────
print("\nFitur Paling Berpengaruh:")
importances = pd.Series(model.feature_importances_, index=fitur)
print(importances.sort_values(ascending=False).to_string())

# ── 11. Simpan Model ──────────────────────────────────────
ml_dir = os.path.dirname(os.path.abspath(__file__))
joblib.dump(model,    os.path.join(ml_dir, 'model_kredit.pkl'))
joblib.dump(encoders, os.path.join(ml_dir, 'label_encoders.pkl'))
joblib.dump(fitur,    os.path.join(ml_dir, 'fitur_list.pkl'))
print("\nModel Random Forest berhasil disimpan!")