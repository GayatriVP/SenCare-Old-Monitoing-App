from flask import Flask, render_template, redirect, url_for
import os
from flask import Flask, request, jsonify
from detect_ellipse import predict
from threading import Thread

import multiprocessing
pool = multiprocessing.Pool()

# pool object with number of element
pool = multiprocessing.Pool(processes=2)
res2 = "not detected"
res1 = "not detected"
fl = 'no'
app = Flask(__name__)
# app.app_context().push()


@app.route('/home', methods=['GET'])
def index():
    global res1
    global res2
    args = request.args
    flag1 = str(args.get("flag1", default="None", type=str))
    flag2 = str(args.get("flag2", default="None", type=str))
    return render_template('home.html', res1=res1, res2=res2, flag1=flag1, flag2=flag2)

# @app.route('/')
# def hello():
#     d={}
#     ret='hello'
#     d['return'] = ret
#     return jsonify(d)


@app.route('/predict', methods=['GET'])
def detect():
    global res1
    global fl
    # input list
    print("inside")
    # ret1=''
    # ret2=''
    # fl = 'no'

    url1 = str(request.args['Query1'])
    url2 = str(request.args['Query2'])
    if(url2):
        t1 = Thread(target=decide, name='t1', args=(url2,))
        t1.start()

    if (url1):
        ret1 = pool.apply_async(predict, args=(url1,))
        # ret2 = pool.apply_async(predict, args=(url2,))
        res1 = ret1.get()

    # t1.join()
    # print("thread ", fl, "\n")
    # if fl == 'yes':
    #     print("in yes")
    #     z = redirect(url_for('ren', _external=True, res2=res2))
    # url = "http://127.0.0.1:5000/decide?arg="+res1

    # z = redirect(url_for('.ren',messages=res1))

    # res2 = ret2.get()
    # inputs = [url1,url2]
    # outputs = pool.map(predict, inputs)
    # print(url)
    # t1 = Thread(target=decide, name='t1', args=(url2,))
    # t2 = Thread(target=predict, name='t2', args=(url2,ret2))
    # t1.start()
    # t2.start()
    # t1.join()
    # t2.join()
    # ret=[res1,res2]
    # ret = predict(url1)
    # d['return'] = ret
    return render_template('return.html', res1=res1, res2=res2)
    # return render_template('return.html', detect=res1)
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

# @app.route('/decide', methods=['GET'])


def decide(url2):
    with app.app_context(), app.test_request_context():
        print("inside2")
        global res2
        # url2 = str(request.args['Query2'])
        ret2 = pool.apply_async(predict, args=(url2,))
        if ret2:
            res2 = ret2.get()+"2"
            print("ret2 found", res2)
        # url = "http://127.0.0.1:5000/decide?arg="+res2

        # redirect(url)
        redirect(url_for('ren', _external=True, res2=res2))
        fl = 'yes'
        # print("decide ", fl, "\n")
        return fl


@app.route('/decide')
def ren():
    global res2, res1
    if res1 == "detected" or res2 == "detected2":
        print("in if")
        return render_template('return.html', res1=res1, res2=res2)
    else:
        print("in else")
        res2 = str(request.args['res2'])
        res1 = str(request.args['res1'])
        return render_template('return.html', res1=res1, res2=res2)


if __name__ == '__main__':

    app.run(debug=True)
