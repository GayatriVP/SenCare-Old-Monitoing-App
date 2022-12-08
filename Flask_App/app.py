from flask import Flask
import os
from flask import Flask,request,jsonify
from detect_ellipse import predict 
app = Flask(__name__)
@app.route('/')
def hello():
    print("hello world")
    return 'hello world'

@app.route('/predict', methods=['GET'])
def detect():
    print("inside")
    d = {}
    url = str(request.args['Query'])
    print(url)
    ret = predict(url)
    d['return'] = ret
    return jsonify(d)
    # if request.method == 'POST':
    # # check if the post request has the file part
    #     if 'file' not in request.files:
    #         return "No file found"
    # user_file = request.files['file']
    # temp = request.files['file']
    # if user_file.filename == '':
    #     return "file name not found …"
    # else:
    #     path=os.path.join(os.getcwd()+'//assets//static//'+user_file.filename)
    #     user_file.save(path)

if __name__ == '__main__':
    
	app.run()