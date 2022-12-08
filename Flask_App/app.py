from flask import Flask
import os
from flask import Flask,request,jsonify
app = Flask(__name__)
@app.route('/predict' ,methods=['POST'])
def predict():
    if request.method == 'POST':
    # check if the post request has the file part
        if 'file' not in request.files:
            return "No file found"
    user_file = request.files['file']
    temp = request.files['file']
    if user_file.filename == '':
        return "file name not found …"
    else:
        path=os.path.join(os.getcwd()+'//assets//static//'+user_file.filename)
        user_file.save(path)