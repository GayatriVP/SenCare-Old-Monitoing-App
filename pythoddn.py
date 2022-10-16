# import required packages/modules
import numpy as np
import cv2
from scipy.spatial import distance as dist
import argparse
import imutils
import os

# SETTING UP VARIABLE
# initialize minimum probability and threshold to filter weak detection
min_confidence = 0.3
nms_thresh = 0.3

# base path to directory
base_path = "ly/yolo"

# To count the total number of people
count = True

# defining minimum distance between two people
min_distance = 50

# Set the threshold value for total violations limit.
Threshold = 20

# for recorded video, enter path else enter 0 for real time video stream
url = 0


# FUNCTION FOR DETECTION OF PEOPLE
def find(frame, net, ln, person_ID=0):
    # dimensions of frame
    (H, W) = frame.shape[:2]

    # initialize list of outputs
    outputs = []

    # construct blob from input video frame & perform YOLO object detection, by giving bounded boxes and its probability
    blob = cv2.dnn.blobFromImage(frame, 1 / 255.0, (416, 416), swapRB=True, crop=False)
    net.setInput(blob)
    layerOutputs = net.forward(ln)

    # initialize list of boxes, centroids and confidences of detected people
    boxes = []
    centroids = []
    confidences = []

    # loop with layer outputs
    for output in layerOutputs:
        # loop with detection
        for detection in output:
            # probability of current detection
            scores = detection[5:]
            classID = np.argmax(scores)
            confidence = scores[classID]

            # check object detected was person and minimum confidence is correct
            if classID == person_ID and confidence > min_confidence:
                # scale bounding box coordinates back relative to size of image
                box = detection[0:4] * np.array([W, H, W, H])
                (centerX, centerY, width, height) = box.astype("int")

                # use (x,y coordinates to define top and left center of box
                x = int(centerX - (width / 2))
                y = int(centerY - (height / 2))

                # update coordinates of box, centroids and confidence
                boxes.append([x, y, int(width), int(height)])
                centroids.append((centerX, centerY))
                confidences.append(float(confidence))

    # apply non-maxima suppression to suppress weak and overlapping bounding box
    box_id = cv2.dnn.NMSBoxes(boxes, confidences, min_confidence, nms_thresh)

    # compute the total people counter
    if count:
        human_count = "Human count: {}".format(len(box_id))
        cv2.putText(frame, human_count, (10, frame.shape[0] - 20), cv2.FONT_HERSHEY_SIMPLEX, 0.60, (0, 0, 0), 2)

    # check for at least 1 detection present
    if len(box_id) > 0:
        # loop with indexes
        for i in box_id.flatten():
            # extract box coordinates
            (x, y) = (boxes[i][0], boxes[i][1])
            (w, h) = (boxes[i][2], boxes[i][3])

            # update result with track of box coordinates, probability and centroid
            r = (confidences[i], (x, y, x + w, y + h), centroids[i])
            outputs.append(r)

    # return the list of outputs
    return outputs


# GRAB FRAMES FROM VIDEO AND MAKE PREDICTION OF DISTANCE

# construct the argument parse with arguments
z = argparse.ArgumentParser("Social Distance Detection")
z.add_argument("-i", "--input", type=str, default="", help="path to (optional) input video file")
z.add_argument("-o", "--output", type=str, default="", help="path to (optional) output video file")
z.add_argument("-d", "--display", type=int, default=1, help="whether or not output frame should be displayed")
args = vars(z.parse_args())

# load COCO class
labels_path = "ly\yolo\coco.names"
LABELS = open(labels_path).read().strip().split("\n")

# derive paths to YOLO weights and model configuration
weights_path = "ly\yolo\yolov3.weights"
config_path = "ly\yolo\yolov3.cfg"

# load detector trained on COCO dataset
net = cv2.dnn.readNetFromDarknet(config_path, weights_path)

# determine only needed output layer names
ln = net.getLayerNames()
ln = [ln[i - 1] for i in net.getUnconnectedOutLayers()]

# if a video path was not supplied, grab a reference to the camera
if not args.get("input", False):
    print("[INFO] Starting the video stream...")
    vs = cv2.VideoCapture(url)

# otherwise, grab a reference to the video file
else:
    print("[INFO] Capturing the real-time video...")
    vs = cv2.VideoCapture(url)
writer = None

# loop with frames
while True:
    # read net frame from file
    (grabbed, frame) = vs.read()

    # if the frame was not grabbed, then we have reached the end of the stream
    if not grabbed:
        break

    # resize frame and detect people
    frame = imutils.resize(frame, width=1080, height=1080)
    outputs = find(frame, net, ln, person_ID=LABELS.index("person"))

    # initialize index that violate safe distance
    ruled_out = set()

    # check if there are at least 2 people for computing pairwise distance
    if len(outputs) >= 2:
        # extract centroids and compute the distance between all pair of centroids
        centroids = np.array([r[2] for r in outputs])
        D = dist.cdist(centroids, centroids, metric="euclidean")

        # loop with upper triangular matrix
        for i in range(0, D.shape[0]):
            for j in range(i + 1, D.shape[1]):

                # check for safe distance
                if D[i, j] < min_distance:
                    # update violation set with index of centroid pairs
                    ruled_out.add(i)
                    ruled_out.add(j)

        # loop with outputs
        for (i, (prob, bbox, centroid)) in enumerate(outputs):
            # extract the bounding box and centroid coordinates, then
            # initialize the color of the annotation
            (startX, startY, endX, endY) = bbox
            (cX, cY) = centroid
            color = (0, 255, 0)

            # if violation occur, update color
            if i in ruled_out:
                color = (0, 0, 255)

            # draw box & centroid around person detected
            cv2.rectangle(frame, (startX, startY), (endX, endY), color, 2)
            cv2.circle(frame, (cX, cY), 5, color, 1)

        # display no. of violation count
        text = "Social distance violation count : {}".format(len(ruled_out))
        cv2.putText(frame, text, (10, frame.shape[0] - 55), cv2.FONT_HERSHEY_DUPLEX, 0.65, (0, 0, 255), 2)

        threshold = "Threshold limit: {}".format(Threshold)
        cv2.putText(frame, threshold, (200, frame.shape[0] - 20), cv2.FONT_HERSHEY_SIMPLEX, 0.60, (0, 0, 0), 2)

        # check if output should be displayed or not
        if args["display"] > 0:
            # show frame
            cv2.imshow("Video Frame", frame)
            key = cv2.waitKey(1) & 0xFF

        # "Q" for quit
        if key == ord("q" or "Q"):
            break

    # if o/p path is given and video writer has not initialized
    if args["output"] != "" and writer is None:
        # initialize video writer
        fourcc = cv2.VideoWriter_fourcc(*"MJPG")
        writer = cv2.VideoWriter(args["output"], fourcc, 25, (frame.shape[1], frame.shape[0]), True)

    # if the video writer is not None, write the frame to the output video file
    if writer is not None:
        writer.write(frame)

# Clean
vs.release()
cv2.destroyAllWindows()
