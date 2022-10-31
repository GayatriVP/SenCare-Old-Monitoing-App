import torch
import numpy as np
import imutils
import cv2
from time import time
# import cvzone
# from cvzone.SelfiSegmentationModule import SelfiSegmentation


# model = torch.hub.load('ultralytics/yolov5', 'yolov5s', pretrained=True)
# classes = model.names
# coord =[]
# fgbg = cv2.createBackgroundSubtractorMOG2()

# def score_frame(frame):
#         """
#         Takes a single frame as input, and scores the frame using yolo5 model.
#         :param frame: input frame in numpy/list/tuple format.
#         :return: Labels and Coordinates of objects detected by model in the frame.
#         """
#         model.to("cpu")
#         frame = [frame]
#         results = model(frame)
#         labels, cord = results.xyxyn[0][:, -1], results.xyxyn[0][:, :-1]
        
#         return labels, cord

# def class_to_label(x):
#         """
#         For a given label value, return corresponding string label.
#         :param x: numeric label
#         :return: corresponding string label
#         """
#         return classes[int(x)]

# def plot_boxes(results, frame):
#         """
#         Takes a frame and its results as input, and plots the bounding boxes and label on to the frame.
#         :param results: contains labels and coordinates predicted by model on the given frame.
#         :param frame: Frame which has been scored.
#         :return: Frame with bounding boxes and labels ploted on it.
#         """
#         labels, cord = results
#         n = len(labels)
#         x_shape, y_shape = frame.shape[1], frame.shape[0]
#         for i in range(n):
#             if labels[i] == 0 or labels[i] == 16:
#                 row = cord[i]
#                 if row[4] >= 0.3:
#                     x1, y1, x2, y2 = int(row[0]*x_shape), int(row[1]*y_shape), int(row[2]*x_shape), int(row[3]*y_shape)
#                     bgr = (0, 255, 0)
#                     # cv2.rectangle(frame, (x1, y1), (x2, y2), bgr, 2)
#                     im2 = frame[y1:y2,x1:x2]

#                     im2 = imutils.resize(im2, width=150, height=150)


#                     img_blur = cv2.bilateralFilter(im2, d = 7,sigmaSpace = 75, sigmaColor =75)

#                     #gray image
#                     img_gray = cv2.cvtColor(im2, cv2.COLOR_BGR2GRAY)


#                     #binary thresholding
#                     ret, thresh = cv2.threshold(img_gray, 125, 255, cv2.THRESH_BINARY)
#                     cv2.imshow('gray',thresh)

#                     #contouring
#                     items = cv2.findContours(image=thresh, mode=cv2.RETR_TREE, method=cv2.CHAIN_APPROX_SIMPLE)
#                     contours = items[0] if len(items) == 2 else items[1]
#                     image_copy = im2.copy()
#                     image_copy = imutils.resize(image_copy, width=150, height=150)
                    
#                     #extreme points
#                     cnts = imutils.grab_contours(items)
#                     c = max(cnts, key=cv2.contourArea)
#                     extLeft = tuple(c[c[:, :, 0].argmin()][0])
#                     extRight = tuple(c[c[:, :, 0].argmax()][0])
#                     extTop = tuple(c[c[:, :, 1].argmin()][0])
#                     extBot = tuple(c[c[:, :, 1].argmax()][0])
#                     cv2.circle(image_copy, extLeft, 8, (0, 0, 255), -1)
#                     cv2.circle(image_copy, extRight, 8, (0, 255, 0), -1)
#                     cv2.circle(image_copy, extTop, 8, (255, 0, 0), -1)
#                     cv2.circle(image_copy, extBot, 8, (255, 255, 0), -1)
#                     cv2.drawContours(image=image_copy, contours=contours, contourIdx=-1, color=(0, 0, 255), thickness=2, lineType=cv2.LINE_AA)
#                     cv2.imshow('None approximation', image_copy)
#                     # cv2.putText(frame, class_to_label(labels[i]), (x1, y1), cv2.FONT_HERSHEY_SIMPLEX, 0.9, bgr, 2)

#         return frame



url = "videos/fall-04.mp4"
vs = cv2.VideoCapture(url)
backSub = cv2.createBackgroundSubtractorKNN()
while True:

    ret, frame = vs.read()
    if frame is None:
        break
    # assert ret
            
    # frame = imutils.resize(frame, width=1080, height=1080)

   
    fgMask = backSub.apply(frame)
    cv2.imshow('FG Mask', fgMask)
    cv2.imshow('Frame',frame)
    # segmentor = SelfiSegmentation()
    # imgOut = segmentor.removeBG(frame, (255,0,255), threshold=0.55)
    # cv2.imshow('new',imgOut)
    
#     results = score_frame(frame)
#     frame = plot_boxes(results, frame)
            
#     cv2.imshow('YOLOv5 Detection', frame)
    if cv2.waitKey(5) & 0xFF == 27:
        break
      
vs.release()