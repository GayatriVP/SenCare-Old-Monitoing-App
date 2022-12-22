import torch
import numpy as np
import imutils
import math
import cv2
from time import time
import cvzone
from cvzone.SelfiSegmentationModule import SelfiSegmentation


model = torch.hub.load('ultralytics/yolov5', 'yolov5s', pretrained=True)
classes = model.names
coord =[]
backSub = cv2.createBackgroundSubtractorKNN()
count = 0
# fgbg = cv2.createBackgroundSubtractorMOG2()

def score_frame(frame):
        """
        Takes a single frame as input, and scores the frame using yolo5 model.
        :param frame: input frame in numpy/list/tuple format.
        :return: Labels and Coordinates of objects detected by model in the frame.
        """
        model.to("cpu")
        # print("in score")
        frame = [frame]
        # print("in frame")
        # cv2.imshow('frame',frame)
        results = model(frame)
        # print("yes")
        # print("results: ",results)
        labels, cord = results.xyxyn[0][:, -1], results.xyxyn[0][:, :-1]
        # print("no")
        return labels, cord

def class_to_label(x):
        """
        For a given label value, return corresponding string label.
        :param x: numeric label
        :return: corresponding string label
        """
        return classes[int(x)]

def plot_boxes(results, frame):
        """
        Takes a frame and its results as input, and plots the bounding boxes and label on to the frame.
        :param results: contains labels and coordinates predicted by model on the given frame.
        :param frame: Frame which has been scored.
        :return: Frame with bounding boxes and labels ploted on it.
        """
        
        labels, cord = results
        n = len(labels)
        global count
        x_shape, y_shape = frame.shape[1], frame.shape[0]
        for i in range(n):
            if labels[i] == 0 or labels[i] == 16:
                row = cord[i]
                if row[4] >= 0.3:
                    x1, y1, x2, y2 = int(row[0]*x_shape), int(row[1]*y_shape), int(row[2]*x_shape), int(row[3]*y_shape)
                    bgr = (0, 255, 0)
                    centerX = int((x1+x2)/2)
                    centerY = int((y1+y2)/2)
                    width = int(abs(x1-x2)/2)
                    height = int(abs(y1-y2)/2)
                    ratio = width/height
                #     center = (centerX,centerY)
                #     cv2.rectangle(frame, (x1, y1), (x2, y2), bgr, 2)
                    im2 = frame[y1:y2,x1:x2]
                    fgMask = backSub.apply(frame)
                    fgMask = fgMask[y1:y2,x1:x2]

                #     im2 = imutils.resize(im2, width=150, height=150)
                #     heatmap = cv2.applyColorMap(im2, cv2.COLORMAP_BONE)
                #     ret, thresh = cv2.threshold(heatmap, 205, 255, cv2.THRESH_BINARY)
                    items = cv2.findContours(image=fgMask, mode=cv2.RETR_TREE, method=cv2.CHAIN_APPROX_SIMPLE)
                    cnts = imutils.grab_contours(items)
                #     contours = items[0] if len(items) == 2 else items[1]
                #     for c in cnts:
                    M = cv2.moments(fgMask)
                    cX = int(M["m10"] / M["m00"])
                    cY = int(M["m01"] / M["m00"])
                    center = (cX,cY)    #b
                    xaxis = (0,cY)      #a
                    c = max(cnts, key=cv2.contourArea)
                    extTop = tuple(c[c[:, :, 1].argmin()][0])   #c
                #     extBot = tuple(c[c[:, :, 1].argmax()][0])
                    cv2.circle(im2, extTop, 8, (255, 0, 0), -1)
                #     cv2.circle(im2, extBot, 8, (255, 255, 0), -1)
                    cv2.circle(im2, center, 8, (0, 255, 255), -1)
                    cv2.line(im2,center,extTop,(0,255,0),2)
                    cv2.line(im2,center,xaxis,(0,255,0),2)
                    A = math.degrees(math.atan2(extTop[1]-cY, extTop[0]-cX) - math.atan2(cY-cY,0-cX))
                    if A < 0: A = A + 360
                    if ratio>1:
                        if A<75 or A>100:
                                count+=1
                    
                    cv2.imshow('frame', im2)       
        return frame

def predict(url): 
    # url1 = "Flask_App/videos/fall-01.mp4"
    # print("in predict")
    vs = cv2.VideoCapture(url)
    # print("capture")

    while vs.isOpened():
        # print("in while")

        ret, frame = vs.read()
        # cv2.imshow('yes',frame)
        # print("frame read")
        
        results = score_frame(frame)
        # print("results: ",results)
        frame = plot_boxes(results, frame)
        if count > 5:
            print("Fall Detected")
            ret = "detected"
            vs.release()
            return ret
        if cv2.waitKey(5) & 0xFF == 27:
            break
        
    vs.release()

# predict()