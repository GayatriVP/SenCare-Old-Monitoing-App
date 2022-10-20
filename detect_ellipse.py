import torch
import numpy as np
import imutils
import cv2
from time import time
import cvzone
from cvzone.SelfiSegmentationModule import SelfiSegmentation


model = torch.hub.load('ultralytics/yolov5', 'yolov5s', pretrained=True)
classes = model.names
coord =[]
# fgbg = cv2.createBackgroundSubtractorMOG2()

def score_frame(frame):
        """
        Takes a single frame as input, and scores the frame using yolo5 model.
        :param frame: input frame in numpy/list/tuple format.
        :return: Labels and Coordinates of objects detected by model in the frame.
        """
        model.to("cpu")
        frame = [frame]
        results = model(frame)
        labels, cord = results.xyxyn[0][:, -1], results.xyxyn[0][:, :-1]
        
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
                    cv2.rectangle(frame, (x1, y1), (x2, y2), bgr, 2)
                    im2 = frame[y1:y2,x1:x2]

                    im2 = imutils.resize(im2, width=150, height=150)
                    heatmap = cv2.applyColorMap(im2, cv2.COLORMAP_BONE)
                    ret, thresh = cv2.threshold(heatmap, 205, 255, cv2.THRESH_BINARY)
                    # items = cv2.findContours(image=thresh, mode=cv2.RETR_TREE, method=cv2.CHAIN_APPROX_SIMPLE)
                    # contours = items[0] if len(items) == 2 else items[1]
                    # cv2.drawContours(image=heatmap, contours=contours, contourIdx=-1, color=(0, 0, 255), thickness=2, lineType=cv2.LINE_AA)
                    # cv2.imshow('thresh', thresh)
                    cv2.imshow('heatmap', heatmap)
                    # center = (centerX,centerY)
                    # imell = cv2.ellipse(frame, center, (width,height),0, 0, 360, (0, 0, 255), 5)
                    # cv2.imshow("ellipse",imell)
        return frame

url = "videos/fall-05.mp4"
vs = cv2.VideoCapture(url)

while True:

    ret, frame = vs.read()
    # assert ret
            
    frame = imutils.resize(frame, width=720, height=720)

    # segmentor = SelfiSegmentation()
    # imgOut = segmentor.removeBG(frame, (255,0,255), threshold=0.55)
    # cv2.imshow('new',imgOut)
    
    results = score_frame(frame)
    frame = plot_boxes(results, frame)
            
    # cv2.imshow('YOLOv5 Detection', frame)
    if cv2.waitKey(5) & 0xFF == 27:
        break
      
vs.release()