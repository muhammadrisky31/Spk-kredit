import subprocess
import json

data = {
    "person_age": 25,
    "person_income": 50000,
    "person_home_ownership": "RENT",
    "person_emp_length": 3.0,
    "loan_intent": "PERSONAL",
    "loan_grade": "C",
    "loan_amnt": 10000,
    "loan_int_rate": 13.5,
    "loan_percent_income": 0.2,
    "cb_person_default_on_file": "N",
    "cb_person_cred_hist_length": 3
}

result = subprocess.run(
    ['python', 'ml/predict.py', json.dumps(data)],
    capture_output=True, text=True
)

print("Hasil Prediksi:")
print(result.stdout)
if result.stderr:
    print("Error:", result.stderr)